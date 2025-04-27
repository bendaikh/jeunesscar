<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Contract;
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
        return view("contract.index");
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        // Process the data as needed
        // For instance, calculate rental duration if not provided
        if (empty($data['rental']['duration']) && !empty($data['rental']['start_date']) && !empty($data['rental']['end_date'])) {
            $start = new \DateTime($data['rental']['start_date']);
            $end = new \DateTime($data['rental']['end_date']);
            $diff = $start->diff($end);
            $data['rental']['duration'] = $diff->days + 1; // Including the start day
        }
        
        // Calculate total amount if not provided
        if (empty($data['rental']['total_amount']) && !empty($data['rental']['daily_rate']) && !empty($data['rental']['duration'])) {
            $data['rental']['total_amount'] = $data['rental']['daily_rate'] * $data['rental']['duration'];
        }
        
        // Calculate remaining amount if not provided
        if (empty($data['rental']['remaining_amount']) && !empty($data['rental']['total_amount'])) {
            $advancePayment = !empty($data['rental']['advance_payment']) ? $data['rental']['advance_payment'] : 0;
            $data['rental']['remaining_amount'] = $data['rental']['total_amount'] - $advancePayment;
        }
        
        // You can save to database here if needed
        // $contract = new Contract();
        // $contract->fill($data);
        // $contract->save();

        session()->put("contracts", $data);
        
        return redirect()->route('contract.view')->with('contract_data', $data);
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
        $logoPath = public_path('/assets/images/jeunesse-car-logo.png');
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
            'hideButton' => true
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

// public function generatePDF()
// {
//     // Récupérer les données du contrat depuis la session
//     $data = session('contract_data');
    
//     // if (!$data) {
//     //     return redirect()->route('contract')->with('error', 'Aucune donnée de contrat disponible.');
//     // }
    
//     // Préparer les données pour le PDF avec des valeurs par défaut pour éviter les erreurs
//     $client = (object)array_merge([
//         'last_name' => '', 'first_name' => '', 'address' => '', 'id_number' => '',
//         'id_expiry_date' => '', 'license_number' => '', 'license_issue_date' => '',
//         'passport_number' => '', 'passport_issue_date' => '', 'phone' => '', 'mobile' => ''
//     ], isset($data['client']) ? $data['client'] : []);
    
//     $vehicle = (object)array_merge([
//         'brand' => '', 'start_km' => '', 'plate_number' => '', 'fuel_type' => ''
//     ], isset($data['vehicle']) ? $data['vehicle'] : []);
    
//     $rental = (object)array_merge([
//         'start_date' => '', 'end_date' => '', 'start_time' => '', 'end_time' => '',
//         'start_location' => '', 'end_location' => '', 'duration' => '', 'daily_rate' => '',
//         'total_amount' => '', 'remaining_amount' => '', 'advance_payment' => '',
//         'remarks' => '', 'franchise' => ''
//     ], isset($data['rental']) ? $data['rental'] : []);
    
//     $additional_driver = isset($data['additional_driver']) ? (object)$data['additional_driver'] : (object)[];
//     $vehicle_change = isset($data['vehicle_change']) ? (object)$data['vehicle_change'] : (object)[];
//     $payment_method = isset($data['payment_method']) ? $data['payment_method'] : 'cash';
    
//     // Générer un numéro de contrat unique
//     $contract = new \stdClass();
//     $contract->number = 'N' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
//     $contract->dossier_number = 'D' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    
//     // Configurer DomPDF avec des options avancées
//     $pdf = app('dompdf.wrapper');
//     $pdf->setPaper('A4', 'portrait');
//     $pdf->setOptions([
//         'defaultFont' => 'sans-serif',
//         'isHtml5ParserEnabled' => true,
//         'isRemoteEnabled' => true,
//         'isPhpEnabled' => true,
//         'debugCss' => false,
//         'dpi' => 96,
//         'defaultMediaType' => 'screen',
//         'isFontSubsettingEnabled' => true
//     ]);
    
//     // Indiquer à la vue que nous sommes en mode PDF
//     $isPdfMode = true;
//     $hideButton = true;
    
//     // Charger la vue avec les données
//     $html = view('contract.test', compact(
//         'client', 'vehicle', 'rental', 'additional_driver',
//         'vehicle_change', 'payment_method', 'contract',
//         'isPdfMode', 'hideButton'
//     ))->render();
    
//     // Charger le HTML dans DomPDF
//     $pdf->loadHTML($html);
    
//     // Générer et retourner le PDF
//     return $pdf->stream('contract-' . $contract->number . '.pdf');
//   // return $pdf->download('contract-' . $contract->number . '.pdf');



//     }
   

}


