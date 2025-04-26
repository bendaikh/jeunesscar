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
        
        return redirect()->route('contract.view')->with('contract_data', $data);
    }

    public function view(Request $request)
    {
        $data = session('contract_data') ?: $request->all();
        
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
        
        return view('contract.view', compact(
            'client', 
            'vehicle', 
            'rental', 
            'additional_driver', 
            'vehicle_change', 
            'payment_method',
            'contract'
        ));
    }
    public function generatePDF(Request $request)
    {
        $data = session('contract_data') ?: $request->all();
        
        // Extract data for PDF
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
    
        // 📝 توليد الـ HTML من View Laravel
        $html = view('contract.view', compact(
            'client', 
            'vehicle', 
            'rental', 
            'additional_driver', 
            'vehicle_change', 
            'payment_method',
            'contract'
        ))->render();
    
        // 🖨️ توليد PDF باستخدام Dompdf مباشرة
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        // 📦 إرجاع الملف كـ response
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="contract-' . $contract->number . '.pdf"');
    }
    
}