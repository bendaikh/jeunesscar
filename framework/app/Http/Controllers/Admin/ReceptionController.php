<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReceptionRequest;
use App\Model\VehicleModel;
use App\Model\ReceptionModel;
use App\Model\ReceptionMediaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;
use DB;


class ReceptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Reception list', ['only' => ['index', 'show']]);
        $this->middleware('permission:Reception add', ['only' => ['create', 'store']]);
        $this->middleware('permission:Reception edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Reception delete', ['only' => ['destroy', 'bulkDelete']]);
    }

    /**
     * Display a listing of vehicle receptions
     */
    public function index()
    {
        $user = Auth::user();
        
        $query = ReceptionModel::with(['vehicle', 'user', 'media']);
        
        // Apply group filter if user is not super admin
        if ($user->group_id != null && $user->user_type != "S") {
            $query->whereHas('vehicle', function($q) use ($user) {
                $q->where('group_id', $user->group_id);
            });
        }
        
        $data = $query->get();
        
        return view('reception.index', compact('data'));
    }

    /**
     * Process datatables ajax request
     */
    public function fetchData(Request $request)
    {
        $user = Auth::user();
        
        $query = ReceptionModel::with(['vehicle', 'user', 'media'])
            ->select('vehicle_receptions.*');
        
        // Apply group filter if user is not super admin
        if ($user->group_id != null && $user->user_type != "S") {
            $query->whereHas('vehicle', function($q) use ($user) {
                $q->where('group_id', $user->group_id);
            });
        }

        return DataTables::eloquent($query)
            ->addColumn('check', function ($reception) {
                return '<input type="checkbox" name="ids[]" value="' . $reception->id . '" class="checkbox" id="chk' . $reception->id . '" onclick="checkcheckbox();">';
            })
            ->addColumn('vehicle', function ($reception) {
                if ($reception->vehicle) {
                    return $reception->vehicle->make_name . ' ' . $reception->vehicle->model_name . ' (' . $reception->vehicle->license_plate . ')';
                }
                return 'N/A';
            })
            ->addColumn('km_difference', function ($reception) {
                if ($reception->previous_km) {
                    return $reception->km_in - $reception->previous_km;
                }
                return 'N/A';
            })
            ->addColumn('media_count', function ($reception) {
                return $reception->media->count();
            })
            ->addColumn('action', function ($reception) {
                return view('reception.list-actions', ['row' => $reception]);
            })
            ->rawColumns(['action', 'check'])
            ->make(true);
    }

    /**
     * Show the form for creating a new reception
     */
    public function create()
    {
        $user = Auth::user();
        $currentDate = now();
        
        // Get vehicles based on user permissions
        if ($user->group_id == null || $user->user_type == "S") {
            // Obtener todos los vehículos activos
            $allVehicles = VehicleModel::where('in_service', 1)->get();
        } else {
            // Filtrar por grupo para usuarios normales
            $allVehicles = VehicleModel::where('in_service', 1)
                        ->where('group_id', $user->group_id)
                        ->get();
        }
        
        // Verificar disponibilidad de cada vehículo
        $vehicles = [];
        $test = [];
        foreach ($allVehicles as $vehicle) {
            // Comprobar si el vehículo está actualmente alquilado
            $isRented = $this->check_booking($currentDate, $vehicle->id);
            $test[]= ($isRented);
            
            // Añadir indicador de disponibilidad al objeto del vehículo
            $vehicle->is_rented = $isRented;
            
            // Obtener información del contrato activo si existe
            if ($isRented) {
                $vehicles[] = $vehicle;
            }
            
           
        }
        
        // Convertir array a collection
       // $vehicles = collect($vehicles);


        
        
        return view('reception.create', compact('vehicles'));
    }

    /**
     * Store a newly created reception
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'vehicle_id' => 'required|exists:vehicles,id',
            'reception_date' => 'required|date',
            'km_in' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240',
        ]);

        // Get previous km from vehicle
        $vehicle = VehicleModel::find($request->vehicle_id);
        $previousKm = $vehicle->int_mileage;

        // Buscar contrato activo si existe
        $contract = Contract::where('vehicle_id', $request->vehicle_id)
                    ->where('end_date', '>=', now())
                    ->first();

        // Determinar el user_id (cliente o usuario actual)
        $userId = $contract ? $contract->client_id : Auth::id();
        
        // Create reception record
        $reception = ReceptionModel::create([
            'vehicle_id' => $request->vehicle_id,
            'reception_date' => $request->reception_date,
            'km_in' => $request->km_in,
            'previous_km' => $previousKm,
            'notes' => $request->notes,
            'status' => 'active',
            'user_id' => $userId,
            'created_by' => Auth::id(),
        ]);

        // Update vehicle mileage
        $vehicle->int_mileage = $request->km_in;
        $vehicle->save();

        // Handle uploaded media files
        if ($request->hasFile('media')) {
            $mediaFiles = $request->file('media');
            
            foreach ($mediaFiles as $file) {
                // Verificar que el archivo es válido
                if ($file->isValid()) {
                    // Determinar el tipo de archivo
                    $fileType = strpos($file->getMimeType(), 'video') !== false ? 'video' : 'image';
                    
                    // Generar un nombre de archivo único
                    $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    
                    // Almacenar el archivo
                    $filePath = $file->storeAs('reception_media', $fileName, 'public');
                    
                    // Crear registro en la base de datos
                    ReceptionMediaModel::create([
                        'reception_id' => $reception->id,
                        'file_path' => $filePath,
                        'file_type' => $fileType
                    ]);
                }
            }
        }

        return redirect()->route('reception.index')
                         ->with('message', 'La recepción se ha guardado correctamente con ' . 
                                 count($request->hasFile('media') ? $request->file('media') : []) . ' archivos multimedia');
    }

    /**
     * Display the specified reception
     */
    public function show($id)
    {
        $reception = ReceptionModel::with(['vehicle', 'user', 'media'])->findOrFail($id);
        return view('reception.show', compact('reception'));
    }

    /**
     * Show the form for editing the specified reception
     */
    public function edit($id)
    {
        $user = Auth::user();
        $reception = ReceptionModel::findOrFail($id);
        
        // Get vehicles based on user permissions
        if ($user->group_id == null || $user->user_type == "S") {
            $vehicles = VehicleModel::where('in_service', 1)->get();
        } else {
            $vehicles = VehicleModel::where('in_service', 1)
                        ->where('group_id', $user->group_id)
                        ->get();
        }
        
        return view('reception.edit', compact('reception', 'vehicles'));
    }

    /**
     * Update the specified reception
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vehicle_id' => 'required|exists:vehicles,id',
            'reception_date' => 'required|date',
            'km_in' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240',
        ]);

        $reception = ReceptionModel::findOrFail($id);
        
        // Update reception data
        $reception->update([
            'vehicle_id' => $request->vehicle_id,
            'reception_date' => $request->reception_date,
            'km_in' => $request->km_in,
            'notes' => $request->notes,
        ]);

        // Handle uploaded media files
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $fileType = strpos($file->getMimeType(), 'video') !== false ? 'video' : 'image';
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('reception_media', $fileName, 'public');
                
                ReceptionMediaModel::create([
                    'reception_id' => $reception->id,
                    'file_path' => $path,
                    'file_type' => $fileType
                ]);
            }
        }

        // Update vehicle mileage if needed
        if ($request->update_vehicle_km) {
            $vehicle = VehicleModel::find($reception->vehicle_id);
            $vehicle->int_mileage = $request->km_in;
            $vehicle->save();
        }

        return redirect()->route('reception.index')->with('message', 'Reception updated successfully');
    }

    /**
     * Remove the specified reception
     */
    public function destroy(Request $request)
    {
        $reception = ReceptionModel::findOrFail($request->id);
        
        // Delete media files
        foreach ($reception->media as $media) {
            if (Storage::disk('public')->exists($media->file_path)) {
                Storage::disk('public')->delete($media->file_path);
            }
        }
        
        $reception->delete();
        return redirect()->route('reception.index')->with('message', 'Reception deleted successfully');
    }

    /**
     * Delete media file
     */
    public function deleteMedia($id)
    {
        $media = ReceptionMediaModel::findOrFail($id);
        
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }
        
        $media->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Bulk delete receptions
     */
    public function bulkDelete(Request $request)
    {
        $receptions = ReceptionModel::whereIn('id', $request->ids)->get();
        
        foreach ($receptions as $reception) {
            foreach ($reception->media as $media) {
                if (Storage::disk('public')->exists($media->file_path)) {
                    Storage::disk('public')->delete($media->file_path);
                }
            }
            $reception->delete();
        }
        
        return redirect()->route('reception.index')->with('message', 'Selected receptions deleted successfully');
    }

    protected function check_booking($currentDate, $vehicle_id) {
        // Simplificar para verificar solo si el vehículo está en uso en la fecha actual
        
        // Verificar si hay contratos activos en la fecha actual
        $hasActiveContract = DB::table("contracts")
            ->where("vehicle_id", $vehicle_id)
           
            ->where("start_date", "<=", $currentDate)
            ->where("end_date", ">=", $currentDate)
            ->exists();
        
        // Verificar si hay reservas activas en la fecha actual
       
        
        // Devolver true si el vehículo está actualmente alquilado
        return $hasActiveContract ;
    }
}
