<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\VehicleModel;
use App\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Model\Hyvikk;
use DataTables;
use Yajra\DataTables\DataTables as DataTablesDataTables;

class ContractExpiryController extends Controller
{
    public function __construct()
    {
        // تعريف الصلاحيات المطلوبة
        $this->middleware('permission:Vehicles list');
    }

    /**
     * عرض صفحة متابعة انتهاء عقود السيارات
     */
    public function index(Request $request)
    {
        // إعداد التاريخ الافتراضي (اليوم)
        $defaultDate = Carbon::today()->format('Y-m-d');
        
        // الحصول على التاريخ المحدد (الافتراضي: اليوم)
        $selected_date = $request->get('selected_date') ? 
            Carbon::parse($request->get('selected_date')) : 
            Carbon::today();
        
        // الحصول على العقود التي تنتهي في التاريخ المحدد مع التقسيم إلى صفحات
        $contracts = Contract::whereDate('end_date', $selected_date)
            ->with(['vehicle', 'client'])
            ->orderBy('contract_number', 'asc')
            ->paginate(10); // تقسيم النتائج إلى 10 عقود في كل صفحة
            
        // تنسيق التاريخ
        $date_format = Hyvikk::get('date_format') ?: 'd-m-Y';
        
        // تحويل التاريخ المحدد إلى التنسيق المطلوب للعرض
        $formattedDate = $selected_date->format('d/m/Y');
        
        // إزالة echo من الكود
        // echo $selected_date; // ⬅️ حذف هذه السطر
        
        return view('vehicle_expiry.index', compact(
            'defaultDate', 
            'contracts', 
            'selected_date', 
            'formattedDate', 
            'date_format'
        ));
    }

    /**
     * الحصول على بيانات السيارات التي تنتهي عقودها في تاريخ محدد
     */
    public function ajax(Request $request)
    {
        if ($request->ajax()) {
            // تنسيق التاريخ
            $date_format = Hyvikk::get('date_format') ?: 'd-m-Y';
            
            // الحصول على التاريخ المحدد (الافتراضي: اليوم)
            $selected_date = $request->get('selected_date') ? 
                Carbon::createFromFormat('Y-m-d', $request->get('selected_date'))->startOfDay() : 
                Carbon::today()->startOfDay();
            
            // الحصول على العقود التي تنتهي في التاريخ المحدد
            $contracts = Contract::whereDate('end_date', $selected_date)
                ->with(['vehicle', 'client'])
                ->orderBy('contract_number', 'asc');
                
            return DataTablesDataTables::eloquent($contracts)
                ->addColumn('vehicle', function ($contract) {
                    if ($contract->vehicle) {
                        return $contract->vehicle->make_name . ' ' . $contract->vehicle->model_name . 
                               '<br><small>(' . $contract->vehicle->license_plate . ')</small>';
                    }
                    return __('fleet.vehicleDeleted');
                })
                ->addColumn('client', function ($contract) {
                    if ($contract->client) {
                        $name = $contract->client->getMeta('first_name') ? 
                            $contract->client->getMeta('first_name') . ' ' . $contract->client->getMeta('last_name') : 
                            $contract->client->name;
                        
                        return '<div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light rounded-circle mr-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    ' . $name . '
                                </div>';
                    }
                    return __('fleet.clientDeleted');
                })
                ->addColumn('start_date', function ($contract) use ($date_format) {
                    return date($date_format, strtotime($contract->start_date));
                })
                ->addColumn('end_date', function ($contract) use ($date_format) {
                    return date($date_format, strtotime($contract->end_date));
                })
                ->addColumn('status', function ($contract) {
                    $status_classes = [
                        'pending' => 'warning',
                        'active' => 'success',
                        'completed' => 'info',
                        'cancelled' => 'danger'
                    ];
                    
                    return '<span class="badge badge-' . ($status_classes[$contract->status] ?? 'secondary') . '">' . 
                            $contract->status . '</span>';
                })
                ->addColumn('action', function ($contract) {
                    $buttons = '<div class="btn-group">';
                    $buttons .= '<a href="' . route('contract.show', $contract->id) . '" class="btn btn-sm btn-info" title="' . __('fleet.view') . '">
                                    <i class="fa fa-eye"></i>
                                </a>';
                    
                    if (Auth::user()->can('Vehicles edit')) {
                        $buttons .= '<a href="' . route('contract.edit', $contract->id) . '" class="btn btn-sm btn-primary" title="' . __('fleet.edit') . '">
                                        <i class="fa fa-edit"></i>
                                    </a>';
                    }
                    
                    $buttons .= '</div>';
                    return $buttons;
                })
                ->rawColumns(['vehicle', 'client', 'status', 'action'])
                ->make(true);
        }
        
        // Si no es una solicitud AJAX, devolver error
        return response()->json(['error' => 'Not an ajax request'], 400);
    }
}
