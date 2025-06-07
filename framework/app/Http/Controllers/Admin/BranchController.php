<?php
// filepath: /home/ouknik/Desktop/brahim_projects/j/j v2/jeunesscar/framework/app/Http/Controllers/Admin/BranchController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Branch;
use App\Model\User;
use App\Model\VehicleModel;
use App\Contract;
use App\Model\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function __construct()
    {
        // تعديل الصلاحيات للفروع
        $this->middleware('permission:Branches list', ['only' => ['index']]);
        $this->middleware('permission:Branches add', ['only' => ['create', 'store']]);
        $this->middleware('permission:Branches edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Branches delete', ['only' => ['destroy', 'bulk_delete']]);
    }

    /**
     * عرض قائمة الفروع
     */
    public function index()
    {
        $branches = Branch::orderBy('name')->get();
        
        // إضافة معلومات إضافية لكل فرع
        foreach ($branches as $branch) {
            $branch->vehicle_count = VehicleModel::where('branch_id', $branch->id)->count();
            $branch->user_count = User::where('branch_id', $branch->id)->count();
            $branch->contract_count = Contract::where('branch_id', $branch->id)
                                     ->orWhere('pickup_branch_id', $branch->id)
                                     ->orWhere('dropoff_branch_id', $branch->id)
                                     ->count();
        }
        
        return view('branches.index', compact('branches'));
    }

    /**
     * عرض نموذج إنشاء فرع جديد
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * حفظ فرع جديد
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:branches,name',
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'zipcode' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'contact_person' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'details' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $branch = new Branch;
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->city = $request->city;
        $branch->state = $request->state;
        $branch->country = $request->country;
        $branch->zipcode = $request->zipcode;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->contact_person = $request->contact_person;
        $branch->latitude = $request->latitude;
        $branch->longitude = $request->longitude;
        $branch->details = $request->details;
        $branch->is_active = 1;
        $branch->save();
        
        return redirect()->route('branches.index')
            ->with('success', __('fleet.branch_added'));
    }

    /**
     * عرض نموذج تعديل الفرع
     */
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.edit', compact('branch'));
    }

    /**
     * تحديث بيانات الفرع
     */
    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:branches,name,' . $id,
            'address' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'zipcode' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'contact_person' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'details' => 'nullable',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->city = $request->city;
        $branch->state = $request->state;
        $branch->country = $request->country;
        $branch->zipcode = $request->zipcode;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->contact_person = $request->contact_person;
        $branch->latitude = $request->latitude;
        $branch->longitude = $request->longitude;
        $branch->details = $request->details;
        $branch->is_active = $request->is_active;
        $branch->save();
        
        return redirect()->route('branches.index')
            ->with('success', __('fleet.branch_updated'));
    }

    /**
     * حذف الفرع
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        
        // التحقق من وجود مركبات أو مستخدمين مرتبطين بالفرع
        $vehicleCount = VehicleModel::where('branch_id', $id)->count();
        $userCount = User::where('branch_id', $id)->count();
        
        if ($vehicleCount > 0 || $userCount > 0) {
            return back()->with('error', __('fleet.branch_delete_error'));
        }
        
        $branch->delete();
        
        return redirect()->route('branches.index')
            ->with('success', __('fleet.branch_deleted'));
    }
}