<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\Model\Hyvikk;
use App\Model\User;
use App\Model\VehicleGroupModel;
use Auth;
use DataTables;
use Illuminate\Support\Str;
use Redirect;
use Spatie\Permission\Models\Role;


class ContractController extends Controller
{
    public function __construct()
    {

        // $this->middleware(['role:Admin']);
        $this->middleware('permission:Users add', ['only' => ['create']]);
        $this->middleware('permission:Users edit', ['only' => ['edit']]);
        $this->middleware('permission:Users delete', ['only' => ['bulk_delete', 'destroy']]);
        $this->middleware('permission:Users list');
    }
    public function index()
    {
        return view("contract.index");
    }

    public function view()
    {

        $contract = new \stdClass();
        $contract->client = null;
        $contract->vehicle = null;
        $contract->additionalDriver = null;
        $contract->vehicleChange = null;
        $contract->payment_method = null;

        return view('contract.view', [
            'contract' => $contract,
            'client' => $contract->client,
            'vehicle' => $contract->vehicle,
            'rental' => $contract,
            'additional_driver' => $contract->additionalDriver,
            'vehicle_change' => $contract->vehicleChange,
            'payment_method' => $contract->payment_method,
        ]);
        return view("contract.view");
    }
}
