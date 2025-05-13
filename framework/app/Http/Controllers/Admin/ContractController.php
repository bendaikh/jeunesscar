<?php

namespace App\Http\Controllers\Admin;

use App\AdditionalDriver;
use App\Contract;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\IncomeModel;
use App\Model\User;
use App\Model\UserClinet;

use App\Model\VehicleModel;


use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Log;
use setasign\Fpdi\Fpdi;

    
class ContractController extends Controller
{
   
public function __construct()
{
    $this->middleware('permission:Contracts add', ['only' => ['create', 'store']]);
    $this->middleware('permission:Contracts edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:Contracts delete', ['only' => ['destroy', 'bulk_delete']]);
    $this->middleware('permission:Contracts list', ['only' => ['index', 'show']]);
}
    // public function index()
    // {
    //   // جلب جميع العقود مع علاقاتها
    // $contracts = Contract::with(['client', 'vehicle', 'creator'])
    // ->orderBy('created_at', 'desc')
    // ->paginate(10); // 10 عقود لكل صفحة

    //    return view('contract.index', compact('contracts'));
    // }


    public function create()
    {

        $clientSelect = User::with('userclient')->
        where("user_type", "C")
        // ->has('userclient')
        -> get();
 
        
        //return $clientSelect;
        // return $clientSelect;
        $vehicles = VehicleModel::where('in_service', 1)
        ->select('id', 'make_name', 'license_plate', 'fuel_type', 'start_km', 'int_mileage')
        ->get();

        $models = VehicleModel::groupBy('model_name')
        ->pluck('model_name')
        ->toArray();
    
       return view("contract.create", compact('clientSelect', 'vehicles' , 'models'));
    
 
     //return view("contract.index", compact('clientSelect'));
    }



    public function destroy($id)
    {
        $contract = Contract::findOrFail($id);
    
        try {
            $contract->delete();
            return redirect()->route('contract')->with('success', __('fleet.contract_deleted'));
        } catch (\Exception $e) {
            return redirect()->route('contract')->with('error', __('fleet.contract_delete_failed'));
        }
    }


    public function index()
    {   
    if(Auth::user()->user_type=="S"){
        $contracts = Contract::with(['client', 'vehicle', 'creator'])
        ->has('client')->has('vehicle')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('contract.index', compact('contracts'));
    }else{
        $contracts = Contract::with(['client', 'vehicle', 'creator'])
        ->has('client')->has('vehicle')
            ->orderBy('created_at', 'desc')
            ->where('created_by', Auth::user()->id)
            ->paginate(10);
        return view('contract.index', compact('contracts'));
}

        
    }
    
    public function show($id)
    {
        $contract = Contract::with(['client', 'vehicle', 'additionalDrivers', 'creator'])->findOrFail($id);
        return view('contract.show', compact('contract'));
    }
    
    public function edit($id)
    {
        $contract = Contract::with(['client', 'vehicle', 'additionalDrivers'])->findOrFail($id);
        $clients = User::where('user_type', 'C')->get();
        $vehicles = VehicleModel::where('in_service', 1)->get();
        
        return view('contract.edit', compact('contract', 'clients', 'vehicles'));
    }
    
    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);
        
        $validated = $request->validate([
            'client_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:pending,active,completed,cancelled'
        ]);
    
        // حساب المدة والمبالغ تلقائياً
        $start = new \DateTime($request->start_date);
        $end = new \DateTime($request->end_date);
        $duration = $start->diff($end)->days + 1;
        
        $totalAmount = $request->daily_rate * $duration;
        $remainingAmount = $totalAmount - ($request->advance_payment ?? 0);
    
        $contract->update([
            'duration' => $duration,
            'total_amount' => $totalAmount,
            'remaining_amount' => $remainingAmount,
            ...$validated
        ]);
    
        return redirect()->route('contract')
            ->with('success', __('fleet.contract_updated'));
    }















    public function store(Request $request)
    {
        if ($request->client_id == '') {
            // تحقق من وجود بيانات العميل الجديد
            if (empty($request->client['first_name']) || empty($request->client['last_name'])) {
                return redirect()->back()->with('error', __('fleet.client_required_fields'));
            }
            
            // إنشاء العميل الجديد
            $user = User::create([
                "name" => $request->client['first_name'] . " " . $request->client['last_name'],
                "email" => $request->client['email'] ?? ($request->client['first_name'].$request->client['last_name'].rand(100,999).'@gmail.com'),
                "password" => bcrypt("password"),
                "user_type" => "C",
                "first_name" => $request->client['first_name'],
                "last_name" => $request->client['last_name'],
                "address" => $request->client['address'],
                "mobno" => $request->client['phone'],
                "api_token" => str_random(60),
            ]);

            
            $user_data = User::find($user->id);
            $user_data->user_id = Auth::user()->id;
            $user_data->first_name = $request->client['first_name'];
            $user_data->last_name = $request->client['last_name'];
            $user_data->address = $request->client['address'];
            $user_data->mobno = $request->client['phone'];
            $user_data->gender = $request->get('gender');
            $user_data->save();
            $user_data->givePermissionTo(['Bookings add', 'Bookings edit', 'Bookings list', 'Bookings delete']);
            
            // إنشاء بيانات العميل الإضافية
            UserClinet::create([
                'user_clients_id' => $user->id,
                'id_number' => $request->client['id_number'],
                'id_expiry_date' => $request->client['id_expiry_date'],
                'license_number' => $request->client['license_number'],
                'license_issue_date' => $request->client['license_issue_date'],
                'passport_number' => $request->client['passport_number'],
                'passport_issue_date' => $request->client['passport_issue_date'],
                'mobile' => $request->client['phone'],
            ]);
            
            $clientId = $user->id;



      
            
            // إنشاء كائن $client للعميل الجديد
            $client = (object)[
                'first_name' => $request->client['first_name'],
                'last_name' => $request->client['last_name'],
                'address' => $request->client['address'],
                'mobno' => $request->client['phone'],
                'userclient' => (object)[
                    'mobile' => $request->client['phone'],
                    'id_number' => $request->client['id_number'],
                    'id_expiry_date' => $request->client['id_expiry_date'],
                    'license_number' => $request->client['license_number'],
                    'license_issue_date' => $request->client['license_issue_date'],
                    'passport_number' => $request->client['passport_number'],
                    'passport_issue_date' => $request->client['passport_issue_date']
                ]
            ];
        } else {
            $clientId = $request->client_id;
            
            // التحقق من وجود بيانات العميل في user_clients
            $client = User::with('userclient')->find($clientId);

            
           
            
            if (!$client || !$client->userclient) {
                return redirect()->route('client.complete.form', $client)
                    ->with('redirect_to_contract', true)
                    ->with('contract_data', $request->except('_token'));
            }
        }
        
       // معالجة بيانات السيارة
    if ($request->vehicle_id == '') {
       
        // إنشاء سيارة جديدة مع كافة البيانات الضرورية
        $vehicle = VehicleModel::create([
            'make_name' => $request->vehicle['brand'],
            'license_plate' => $request->vehicle['plate_number'],
            'fuel_type' => $request->vehicle['fuel_type'],
            'start_km' => $request->vehicle['start_km'],
            'int_mileage' => $request->vehicle['start_km'],
            'in_service' => 1,
            // بيانات افتراضية إضافية
            'model_name' => $request->vehicle['brand'], // يمكن تغييرها إذا كان لديك حقل model منفصل
            'color_name' => 'Unknown',
            'year' => date('Y'),
            'engine_type' => 'Unknown',
            'horse_power' => '0',
            'vin' => 'TBD',
            'group_id' => 1, // يمكن تغييرها حسب احتياجاتك
            'type_id' => 1, // يمكن تغييرها حسب احتياجاتك
            'lic_exp_date' => now()->addYear(),
            'reg_exp_date' => now()->addYear()
        ]);
        
        $vehicleId = $vehicle->id;
    } else {
        $vehicleId = $request->vehicle_id;
        $vehicle = VehicleModel::findOrFail($vehicleId);
        
        // تحديث عدد الكيلومترات إذا تم تقديمه
        if (isset($request->vehicle['start_km'])) {
            $vehicle->update([
                'start_km' => $request->vehicle['start_km'],
                'int_mileage' => $request->vehicle['start_km']
            ]);
        }
    }

        // إعداد بيانات العميل للعقد
        $data = $request->all();
        $data['client'] = [
            'first_name' => $client->first_name?$client->first_name:$client->name,
            'last_name' => $client->last_name?$client->last_name:"",
            'address' => $client->address,
            'phone' => $client->mobno,
            'mobile' => $client->mobno,
            'id_number' => $client->userclient->id_number,
            'id_expiry_date' => $client->userclient->id_expiry_date,
            'license_number' => $client->userclient->license_number,
            'license_issue_date' => $client->userclient->license_issue_date,
            'passport_number' => $client->userclient->passport_number,
            'passport_issue_date' => $client->userclient->passport_issue_date,
        ];

         // إضافة بيانات السيارة إلى بيانات العقد
    $data['vehicle'] = [
        'brand' => $vehicle->make_name,
        'plate_number' => $vehicle->license_plate,
        'fuel_type' => $vehicle->fuel_type,
        'start_km' => $vehicle->start_km ?? $vehicle->int_mileage
    ];
        
        // حساب مدة الإيجار إذا لم يتم تقديمها
        if (empty($data['rental']['duration']) && !empty($data['rental']['start_date']) && !empty($data['rental']['end_date'])) {
            $start = new \DateTime($data['rental']['start_date']);
            $end = new \DateTime($data['rental']['end_date']);
            $diff = $start->diff($end);
            $data['rental']['duration'] = $diff->days + 1; // Including the start day
        }
        
        // حساب المبلغ الإجمالي إذا لم يتم تقديمه
        if (empty($data['rental']['total_amount']) && !empty($data['rental']['daily_rate']) && !empty($data['rental']['duration'])) {
            $data['rental']['total_amount'] = $data['rental']['daily_rate'] * $data['rental']['duration'];
        }
        
        // حساب المبلغ المتبقي إذا لم يتم تقديمه
        if (empty($data['rental']['remaining_amount']) && !empty($data['rental']['total_amount'])) {
            $advancePayment = !empty($data['rental']['advance_payment']) ? $data['rental']['advance_payment'] : 0;
            $data['rental']['remaining_amount'] = $data['rental']['total_amount'] - $advancePayment;
        }
        
        $data['client_id'] = $clientId;
        
        session()->put("contracts", $data);
        return redirect()->route('contract.view');
    }
    public function view(Request $request)
    {

        


         $data = session("contracts", []);

         if (!$data) {
            return redirect()->route('contract')->with('error', 'Aucune donnée de contrat disponible.');
        }

        
        // Extract data for view
        $client = isset($data['client']) ? (object)$data['client'] : null;
        $vehicle = isset($data['vehicle']) ? (object)$data['vehicle'] : null;
        $rental = isset($data['rental']) ? (object)$data['rental'] : null;
        $additional_driver = isset($data['additional_driver']) ? (object)$data['additional_driver'] : null;
        $vehicle_change = isset($data['vehicle_change']) ? (object)$data['vehicle_change'] : null;
        $payment_method = isset($data['payment_method']) ? $data['payment_method'] : 'cash';
        
        // Create a contract number
        $contract = new \stdClass();
        $contract->number = 'N' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        $contract->dossier_number = 'D' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Use absolute paths for assets
    $logoPath = public_path('images/jeunesse-car-logo.png');
    if (!file_exists($logoPath)) {
        $logoPath = 'https://via.placeholder.com/150x50?text=Logo+Missing';
    }

        $hideButton = false;

        
        return view('contract.test', compact(
            'client', 
            'vehicle', 
            'rental', 
            'additional_driver', 
            'vehicle_change', 
            'payment_method',
            'contract',
            
            'logoPath',
            'hideButton' 
        ));
    }
    public function generatePDF(Request $request)
    {
        $id = $request->query('id');
        $data = [];
    
        if ($id) {
            // عرض عقد محفوظ
            $contract = Contract::with(['client', 'vehicle', 'additionalDrivers'])->findOrFail($id);
            
            IncomeModel::create([
                "vehicle_id" => $contract->vehicle_id,
                "amount" => $contract->total_amount,
                "user_id" => Auth::id(),
                "date" => now(),
                "mileage" => $contract->vehicle->start_km ?? $contract->vehicle->int_mileage,
                "income_cat" => 'Contract Revenue',
                "tax_percent" => 0, // Ajusta según necesites
                "tax_charge_rs" => 0, // Ajusta según necesites
            ]);
            // تحضير بيانات العميل
            $clientData = [
                'first_name' => $contract->client->getMeta('first_name') ?? $contract->client->name,
                'last_name' => $contract->client->getMeta('last_name') ?? '',
                'address' => $contract->client->getMeta('address') ?? '',
                'phone' => $contract->client->getMeta('mobno') ?? '',
                'mobile' => $contract->client->getMeta('mobno') ?? '',
                'id_number' => $contract->client->getMeta('id_number') ?? '',
                'id_expiry_date' => $contract->client->getMeta('id_expiry_date') ?? '',
                'license_number' => $contract->client->getMeta('license_number') ?? '',
                'license_issue_date' => $contract->client->getMeta('license_issue_date') ?? '',
                'passport_number' => $contract->client->getMeta('passport_number') ?? '',
                'passport_issue_date' => $contract->client->getMeta('passport_issue_date') ?? '',
            ];
            

            
    
            // تحضير بيانات المركبة
            $vehicleData = [
                'brand' => $contract->vehicle->make_name,
                'plate_number' => $contract->vehicle->license_plate,
                'start_km' => $contract->vehicle->start_km ?? $contract->vehicle->int_mileage,
                'fuel_type' => $contract->vehicle->fuel_type,
            ];
    
            // تحضير بيانات الإيجار
            $rentalData = [
                'start_date' => $contract->start_date->format('Y-m-d'),
                'end_date' => $contract->end_date->format('Y-m-d'),
                'start_time' => $contract->start_time,
                'end_time' => $contract->end_time,
                'start_location' => $contract->start_location,
                'end_location' => $contract->end_location,
                'duration' => $contract->duration,
                'daily_rate' => $contract->daily_rate,
                'total_amount' => $contract->total_amount,
                'remaining_amount' => $contract->remaining_amount,
                'advance_payment' => $contract->advance_payment,
                'remarks' => $contract->notes,
                'franchise' => $contract->franchise,
            ];
    
            // تحضير بيانات السائق الإضافي إذا وجد
            $additionalDriverData = [];
            if ($contract->additionalDrivers->isNotEmpty()) {
                $driver = $contract->additionalDrivers->first();
                $additionalDriverData = [
                    'first_name' => $driver->first_name,
                    'last_name' => $driver->last_name,
                    'address' => $driver->address,
                    'id_number' => $driver->id_number,
                    'id_expiry_date' => $driver->id_expiry_date,
                    'license_number' => $driver->license_number,
                    'license_issue_date' => $driver->license_issue_date,
                    'mobile' => $driver->mobile,
                ];
            }
    
            $data = [
                'client' => $clientData,
                'vehicle' => $vehicleData,
                'rental' => $rentalData,
                'additional_driver' => $additionalDriverData,
                'vehicle_change' => [], // يمكنك ملء هذه البيانات إذا كانت متوفرة
                'payment_method' => $contract->payment_method,
                'signature' => $contract->client_signature,
                'signature2' => $contract->witness_signature,
                'client_id' => $contract->client_id,
                'vehicle_id' => $contract->vehicle_id,
            ];
            
            session()->put("contracts", $data);
        } else {
            $data = session("contracts", []);
        }
    
        $signature = $data['signature'] ?? null;
        $signature2 = $data['signature2'] ?? null;
    
        // Prepare data with default values
        $client = (object)array_merge([
            'last_name' => '',
            'first_name' => '',
            'address' => '',
            'id_number' => '',
            'id_expiry_date' => '',
            'license_number' => '',
            'license_issue_date' => '',
            'passport_number' => '',
            'passport_issue_date' => '',
            'phone' => '',
            'mobile' => ''
        ], $data['client'] ?? []);
    
        $vehicle = (object)array_merge([
            'brand' => '',
            'start_km' => '',
            'plate_number' => '',
            'fuel_type' => ''
        ], $data['vehicle'] ?? []);
    
        $rental = (object)array_merge([
            'start_date' => '',
            'end_date' => '',
            'start_time' => '',
            'end_time' => '',
            'start_location' => '',
            'end_location' => '',
            'duration' => '',
            'daily_rate' => '',
            'total_amount' => '',
            'remaining_amount' => '',
            'advance_payment' => '',
            'remarks' => '',
            'franchise' => ''
        ], $data['rental'] ?? []);
    
        $additional_driver = (object)array_merge([
            'last_name' => '',
            'first_name' => '',
            'address' => '',
            'id_number' => '',
            'id_expiry_date' => '',
            'license_number' => '',
            'license_issue_date' => '',
            'mobile' => ''
        ], $data['additional_driver'] ?? []);
    
        $vehicle_change = (object)array_merge([
            'brand' => '',
            'type' => '',
            'plate_number' => '',
            'fuel_type' => '',
            'start_date' => '',
            'end_date' => '',
            'start_time' => '',
            'end_time' => '',
            'start_location' => '',
            'end_location' => ''
        ], $data['vehicle_change'] ?? []);
    
        $payment_method = $data['payment_method'] ?? 'cash';
    
        // استخدام رقم العقد الحالي إذا كان متوفراً أو إنشاء رقم جديد
        $contractNumber = $id ? $data['contract_number'] ?? 'N' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT) 
                              : 'N' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    
        $contract = (object)[
            'number' => $contractNumber,
            'dossier_number' => 'D' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT)
        ];
    
        // Configure PDF
        $pdf = app('dompdf.wrapper');
        
        // Critical PDF settings
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'dejavu sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'dpi' => 110,
            'isFontSubsettingEnabled' => true,
            'margin-top'    => 10,
            'margin-bottom' => 10,
            'margin-left'   => 10,
            'margin-right'  => 10,
        ]);
    
        // Handle logo path
        $logoPath = public_path('/assets/images/logo.png');
        if (!file_exists($logoPath)) {
            $logoPath = null;
        }
    
        $html = view('contract.test', [
            'client' => $client,
            'vehicle' => $vehicle,
            'rental' => $rental,
            'additional_driver' => $additional_driver,
            'vehicle_change' => $vehicle_change,
            'payment_method' => $payment_method,
            'contract' => $contract,
            'logoPath' => $logoPath,
            'hideButton' => true,
            'signature' => $signature,
            'signature2' => $signature2,
        ])->render();
        
        // Load HTML with precise settings
        $pdf->loadHTML($html);
        
        $tempPath = storage_path('app/temp_contract.pdf');
        file_put_contents($tempPath, $pdf->output());
    
        // قص أول صفحتين فقط باستخدام FPDI
        $fpdi = new \setasign\Fpdi\Fpdi();
        $pageCount = $fpdi->setSourceFile($tempPath);
    
        $pagesToKeep = min(2, $pageCount);
        for ($pageNo = 1; $pageNo <= $pagesToKeep; $pageNo++) {
            $templateId = $fpdi->importPage($pageNo);
            $size = $fpdi->getTemplateSize($templateId);
    
            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $fpdi->useTemplate($templateId);
        }
    
        // مسح الملف المؤقت
        unlink($tempPath);
    
        // حفظ العقد إذا كان جديداً
        if (!$id) {
            try {
                $savedContract = $this->saveContractToDatabase($data, $contract->number);

                IncomeModel::create([
                    "vehicle_id" => $savedContract->vehicle_id,
                    "amount" => $savedContract->total_amount,
                    "user_id" => Auth::id(),
                    "date" => now(),
                    "mileage" => isset($data['vehicle']['start_km']) ? $data['vehicle']['start_km'] : 0,
                    "income_cat" => 'Contract Revenue',
                    "tax_percent" => 0, // Ajusta según necesites
                    "tax_charge_rs" => 0, // Ajusta según necesites
                ]);
                
            } catch (\Exception $e) {
                Log::error('Failed to save contract: ' . $e->getMessage());
            }
        }
    

        return response($fpdi->Output('S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="contract-' . $contract->number . '.pdf"',
        ]);
        
        // return response($fpdi->Output('S'), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="contract-' . $contract->number . '.pdf"',
        // ]);
    }
    public function saveSignature(Request $request)
    {
        $request->validate([
            'signature' => 'required|string',
        ]);
        
        echo $request;
        session()->put('contracts.signature', $request->input('signature'));
    
        return response()->json(['message' => 'Signature saved successfully.']);
    }
    

    public function saveSignature2(Request $request)
{
    $request->validate([
        'signature' => 'required|string',
    ]);
    
    session()->put('contracts.signature2', $request->input('signature'));

    return response()->json(['message' => 'Signature 2 saved successfully.']);
}



    
    public function showCompleteForm($id)
    {
        $client = User::findOrFail($id);
        return view('contract.client_complete', compact('client'));
    }
    
    public function completeClientInfo(Request $request, $id)
    {
        $request->validate([
            'id_number' => 'required',
            'mobile' => 'required',
        ]);
    
        UserClinet::create([
            'user_clients_id' => $id,
            'id_number' => $request->id_number,
            'id_expiry_date' => $request->id_expiry_date,
            'license_number' => $request->license_number,
            'license_issue_date' => $request->license_issue_date,
            'passport_number' => $request->passport_number,
            'passport_issue_date' => $request->passport_issue_date,
            'mobile' => $request->mobile,
        ]);
    
        return redirect()->route('contract')->with('success', __('fleet.client_info_completed'));
    }






    private function saveContractToDatabase($data, $contractNumber)
{
    // التحقق من وجود البيانات الأساسية
    if (!isset($data['client_id']) || !isset($data['vehicle_id']) || !isset($data['rental'])) {
        throw new \Exception('Missing required contract data');
    }

    // حساب مدة الإيجار إذا لم تكن موجودة
    $duration = $data['rental']['duration'] ?? 0;
    if ($duration == 0 && isset($data['rental']['start_date']) && isset($data['rental']['end_date'])) {
        $start = new \DateTime($data['rental']['start_date']);
        $end = new \DateTime($data['rental']['end_date']);
        $duration = $start->diff($end)->days + 1;
    }

    // حساب المبالغ المالية إذا لم تكن موجودة
    $totalAmount = $data['rental']['total_amount'] ?? 0;
    if ($totalAmount == 0 && isset($data['rental']['daily_rate']) && $duration > 0) {
        $totalAmount = $data['rental']['daily_rate'] * $duration;
    }

    $advancePayment = $data['rental']['advance_payment'] ?? 0;
    $remainingAmount = $data['rental']['remaining_amount'] ?? ($totalAmount - $advancePayment);

    // إنشاء العقد في قاعدة البيانات
    $contract = Contract::create([
        'client_id' => $data['client_id'],
        'vehicle_id' => $data['vehicle_id'],
        'contract_number' => $contractNumber,
        'start_date' => $data['rental']['start_date'],
        'end_date' => $data['rental']['end_date'],
        'duration' => $duration,
        'daily_rate' => $data['rental']['daily_rate'],
        'total_amount' => $totalAmount,
        'advance_payment' => $advancePayment,
        'remaining_amount' => $remainingAmount,
        'status' => 'pending',
        'notes' => $data['rental']['remarks'] ?? null,
        'start_location' => $data['rental']['start_location'] ?? null,
        'end_location' => $data['rental']['end_location'] ?? null,
        'start_time' => $data['rental']['start_time'] ?? null,
        'end_time' => $data['rental']['end_time'] ?? null,
        'payment_method' => $data['payment_method'] ?? 'cash',
        'franchise' => $data['rental']['franchise'] ?? null,
        'created_by' => auth()->id(),
    ]);




   
    // حفظ بيانات السائق الإضافي إذا وجد
    if (
        isset(
            $contract->id,
            $data['additional_driver']['first_name'],
            $data['additional_driver']['last_name'],
            
            $data['additional_driver']['id_number'],
           
            $data['additional_driver']['mobile']
        )
    ) {
        AdditionalDriver::create([
            'contract_id' => $contract->id,
            'first_name' => $data['additional_driver']['first_name'],
            'last_name' => $data['additional_driver']['last_name'],
            'address' => $data['additional_driver']['address'],
            'id_number' => $data['additional_driver']['id_number'],
            'id_expiry_date' => $data['additional_driver']['id_expiry_date'],
            'license_number' => $data['additional_driver']['license_number'],
            'license_issue_date' => $data['additional_driver']['license_issue_date'],
            'mobile' => $data['additional_driver']['mobile'],
        ]);
    }

    // حفظ توقيعات العقد إذا وجدت
    if (isset($data['signature'])) {
        $contract->update([
            'client_signature' => $data['signature'],
            'witness_signature' => $data['signature2'] ?? null,
            'signed_at' => now(),
        ]);
    }

    return $contract;
}
   

}


