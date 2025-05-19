{{-- resources/views/admin/contracts/edit.blade.php --}}
@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('contract') }}">@lang('fleet.contracts')</a></li>
<li class="breadcrumb-item active">@lang('fleet.edit_contract')</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">@lang('fleet.edit_contract') - {{ $contract->contract_number }}</h3>
    </div>
    <form action="{{ route('contract.update', $contract->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('fleet.client')</label>
                        <select name="client_id" class="form-control" required>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $contract->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('fleet.vehicle')</label>
                        <select name="vehicle_id" class="form-control" required>
                            @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ $contract->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->make_name }} ({{ $vehicle->license_plate }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('fleet.start_date')</label>
                        <input type="date" name="start_date" class="form-control" 
                               value="{{ $contract->start_date->format('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('fleet.end_date')</label>
                        <input type="date" name="end_date" class="form-control" 
                               value="{{ $contract->end_date->format('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('fleet.daily_rate')</label>
                        <input type="number" step="0.01" name="daily_rate" class="form-control" 
                               value="{{ $contract->daily_rate }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('fleet.advance_payment')</label>
                        <input type="number" step="0.01" name="advance_payment" class="form-control" 
                               value="{{ $contract->advance_payment }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('fleet.status')</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $contract->status == 'pending' ? 'selected' : '' }}>@lang('fleet.pending')</option>
                            <option value="active" {{ $contract->status == 'active' ? 'selected' : '' }}>@lang('fleet.active')</option>
                            <option value="completed" {{ $contract->status == 'completed' ? 'selected' : '' }}>@lang('fleet.completed')</option>
                            <option value="cancelled" {{ $contract->status == 'cancelled' ? 'selected' : '' }}>@lang('fleet.cancelled')</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('fleet.payment_method')</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="cash" {{ $contract->payment_method == 'cash' ? 'selected' : '' }}>@lang('fleet.cash')</option>
                            <option value="check" {{ $contract->payment_method == 'check' ? 'selected' : '' }}>@lang('fleet.check')</option>
                            <option value="other" {{ $contract->payment_method == 'other' ? 'selected' : '' }}>@lang('fleet.other')</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>@lang('fleet.notes')</label>
                <textarea name="notes" class="form-control" rows="3">{{ $contract->notes }}</textarea>
            </div>

            <!-- بداية قسم السائق الإضافي -->
            <div class="card mt-4">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4>@lang('fleet.additional_driver')</h4>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="hasAdditionalDriver" 
                               {{ $contract->additionalDrivers->isNotEmpty() ? 'checked' : '' }}>
                        <label class="form-check-label text-white">@lang('fleet.has_additional_driver')</label>
                    </div>
                </div>
                <div class="card-body" id="additionalDriverSection" style="{{ $contract->additionalDrivers->isNotEmpty() ? '' : 'display:none;' }}">
                    @php
                        $driver = $contract->additionalDrivers->isNotEmpty() ? $contract->additionalDrivers->first() : null;
                    @endphp
                    <input type="hidden" name="additional_driver_id" value="{{ $driver ? $driver->id : '' }}">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.last_name')</label>
                                <input type="text" name="additional_driver[last_name]" class="form-control" 
                                       value="{{ $driver ? $driver->last_name : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.first_name')</label>
                                <input type="text" name="additional_driver[first_name]" class="form-control" 
                                       value="{{ $driver ? $driver->first_name : '' }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>@lang('fleet.address')</label>
                        <input type="text" name="additional_driver[address]" class="form-control" 
                               value="{{ $driver ? $driver->address : '' }}">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('fleet.id_number')</label>
                                <input type="text" name="additional_driver[id_number]" class="form-control" 
                                       value="{{ $driver ? $driver->id_number : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('fleet.id_expiry_date')</label>
                                <input type="date" name="additional_driver[id_expiry_date]" class="form-control" 
                                       value="{{ $driver && $driver->id_expiry_date ? $driver->id_expiry_date : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('fleet.mobile')</label>
                                <input type="text" name="additional_driver[mobile]" class="form-control" 
                                       value="{{ $driver ? $driver->mobile : '' }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.license_number')</label>
                                <input type="text" name="additional_driver[license_number]" class="form-control" 
                                       value="{{ $driver ? $driver->license_number : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.license_issue_date')</label>
                                <input type="date" name="additional_driver[license_issue_date]" class="form-control" 
                                       value="{{ $driver && $driver->license_issue_date ? $driver->license_issue_date : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- نهاية قسم السائق الإضافي -->

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                @lang('fleet.update')
            </button>
            <a href="{{ route('contract') }}" class="btn btn-secondary">
                @lang('fleet.cancel')
            </a>
        </div>
    </form>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        // تبديل عرض قسم السائق الإضافي
        $('#hasAdditionalDriver').change(function() {
            if($(this).is(':checked')) {
                $('#additionalDriverSection').show();
            } else {
                $('#additionalDriverSection').hide();
            }
        });
        
        // حساب المدة والمبالغ عند تغيير التواريخ
        $('input[name="start_date"], input[name="end_date"], input[name="daily_rate"], input[name="advance_payment"]').change(function() {
            calculateValues();
        });
        
        function calculateValues() {
            var startDate = new Date($('input[name="start_date"]').val());
            var endDate = new Date($('input[name="end_date"]').val());
            var dailyRate = parseFloat($('input[name="daily_rate"]').val()) || 0;
            var advancePayment = parseFloat($('input[name="advance_payment"]').val()) || 0;
            
            if(!isNaN(startDate) && !isNaN(endDate)) {
                // حساب الفرق بالأيام
                var timeDiff = endDate.getTime() - startDate.getTime();
                var dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1; // بما في ذلك يوم البدء
                
                if(dayDiff > 0) {
                    // عرض المدة (لا يوجد حقل لها في النموذج الحالي، يمكنك إضافته)
                    console.log('Duration: ' + dayDiff);
                    
                    // حساب المبالغ (لا توجد حقول لها في النموذج الحالي، يمكنك إضافتها)
                    var totalAmount = dailyRate * dayDiff;
                    var remainingAmount = totalAmount - advancePayment;
                    
                    console.log('Total: ' + totalAmount);
                    console.log('Remaining: ' + remainingAmount);
                }
            }
        }
    });
</script>
@endsection

