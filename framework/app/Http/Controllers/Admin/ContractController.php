<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Contract;
use App\Model\User;
use App\Model\UserClinet;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

    
class ContractController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['role:Admin']);
		$this->middleware('permission:Customer add', ['only' => ['create']]);
		$this->middleware('permission:Customer edit', ['only' => ['edit']]);
		$this->middleware('permission:Customer delete', ['only' => ['bulk_delete', 'destroy']]);
		$this->middleware('permission:Customer list');
		$this->middleware('permission:Customer import', ['only' => ['importCutomers']]);
    }

    public function index()
    {
        $clientSelect = User::with('userclient')
        ->where("user_type", "C")
        ->has('userclient')
        ->get();

       // return $clientSelect;

    return view("contract.index", compact('clientSelect'));
    }
    public function store(Request $request)
    {
        if ($request->client_id == 'new') {
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
                'mobile' => $request->client['mobile'],
            ]);
            
            $clientId = $user->id;



      
            
            // إنشاء كائن $client للعميل الجديد
            $client = (object)[
                'first_name' => $request->client['first_name'],
                'last_name' => $request->client['last_name'],
                'address' => $request->client['address'],
                'mobno' => $request->client['phone'],
                'userclient' => (object)[
                    'mobile' => $request->client['mobile'],
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
                return redirect()->route('client.complete.form', $clientId)
                    ->with('redirect_to_contract', true)
                    ->with('contract_data', $request->except('_token'));
            }
        }
    
        // إعداد بيانات العميل للعقد
        $data = $request->all();
        $data['client'] = [
            'first_name' => $client->first_name,
            'last_name' => $client->last_name,
            'address' => $client->address,
            'phone' => $client->mobno,
            'mobile' => $client->userclient->mobile,
            'id_number' => $client->userclient->id_number,
            'id_expiry_date' => $client->userclient->id_expiry_date,
            'license_number' => $client->userclient->license_number,
            'license_issue_date' => $client->userclient->license_issue_date,
            'passport_number' => $client->userclient->passport_number,
            'passport_issue_date' => $client->userclient->passport_issue_date,
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

    public function generatePDF()
    {
        $data = session("contracts");
        $signature = $data['signature'] ?? null;

    
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
    
        // Generate contract numbers
        $contract = (object)[
            'number' => 'N' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT),
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
            'dpi' => 110, // زيادة دقة الطباعة
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

        ])->render();
    
        // Load HTML with precise settings
        $pdf->loadHtml($html, 'UTF-8');
        
        // Force two pages exactly
        $pdf->setCallbacks([
            'event' => 'page_count',
            'f' => function($infos) use ($pdf) {
                if ($infos['page_count'] > 2) {
                    $pdf->setPaper('A4', 'portrait', 'adjust');
                }
            }
        ]);
    
        return $pdf->stream('contract-' . $contract->number . '.pdf');
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
   

}


