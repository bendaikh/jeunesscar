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

            <!-- قسم استقبال المركبة (Vehicle Reception) -->
            <div class="card mt-4 border-info">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fa fa-car"></i> @lang('fleet.vehicle_reception')
                        <small class="ml-2">(@lang('fleet.optional'))</small>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i>
                        @lang('fleet.reception_info_message')
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reception_km">
                                    @lang('fleet.current_km') 
                                    <span class="text-muted">@lang('fleet.km_at_reception')</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" 
                                           name="reception_km" 
                                           id="reception_km"
                                           class="form-control" 
                                           min="{{ $contract->vehicle->int_mileage ?? 0 }}"
                                           placeholder="@lang('fleet.example_km'): {{ ($contract->vehicle->int_mileage ?? 0) + 100 }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang('fleet.km_unit')</span>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    @lang('fleet.last_recorded_km'): {{ $contract->vehicle->int_mileage ?? __('fleet.not_specified') }} @lang('fleet.km_unit')
                                </small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reception_date">@lang('fleet.reception_date')</label>
                                <input type="date" 
                                       name="reception_date" 
                                       id="reception_date"
                                       class="form-control" 
                                       value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="reception_notes">@lang('fleet.reception_notes')</label>
                        <textarea name="reception_notes" 
                                  id="reception_notes"
                                  class="form-control" 
                                  rows="3" 
                                  placeholder="@lang('fleet.vehicle_condition_notes')"></textarea>
                    </div>
                    
                    <!-- عرض الفرق في الكيلومترات -->
                    <div id="km_difference_display" class="alert alert-secondary" style="display: none;">
                        <strong>@lang('fleet.distance_during_rental'): </strong>
                        <span id="km_difference_value">0</span> @lang('fleet.km_unit')
                    </div>
                </div>
            </div>

            <!-- بداية قسم السائق الإضافي -->
            <div class="card mt-4">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
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
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-save"></i> @lang('fleet.update')
            </button>
            <a href="{{ route('contract') }}" class="btn btn-secondary btn-lg">
                <i class="fa fa-times"></i> @lang('fleet.cancel')
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
        
        // حساب فرق الكيلومترات عند تغيير قيمة reception_km
        $('#reception_km').on('input', function() {
            calculateKmDifference();
        });
        
        function calculateValues() {
            var startDate = new Date($('input[name="start_date"]').val());
            var endDate = new Date($('input[name="end_date"]').val());
            var dailyRate = parseFloat($('input[name="daily_rate"]').val()) || 0;
            var advancePayment = parseFloat($('input[name="advance_payment"]').val()) || 0;
            
            if(!isNaN(startDate) && !isNaN(endDate)) {
                var timeDiff = endDate.getTime() - startDate.getTime();
                var dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
                
                if(dayDiff > 0) {
                    console.log('Duration: ' + dayDiff);
                    var totalAmount = dailyRate * dayDiff;
                    var remainingAmount = totalAmount - advancePayment;
                    console.log('Total: ' + totalAmount);
                    console.log('Remaining: ' + remainingAmount);
                }
            }
        }
        
        function calculateKmDifference() {
            var currentKm = parseFloat($('#reception_km').val()) || 0;
            var previousKm = {{ $contract->vehicle->int_mileage ?? 0 }};
            
            if (currentKm > 0 && currentKm > previousKm) {
                var difference = currentKm - previousKm;
                $('#km_difference_value').text(difference.toLocaleString());
                $('#km_difference_display').show();
            } else {
                $('#km_difference_display').hide();
            }
        }
        
        // التحقق من صحة البيانات قبل الإرسال
        $('form').on('submit', function(e) {
            var receptionKm = parseFloat($('#reception_km').val()) || 0;
            var previousKm = {{ $contract->vehicle->int_mileage ?? 0 }};
            
            if (receptionKm > 0 && receptionKm < previousKm) {
                e.preventDefault();
                alert('@lang("fleet.km_cannot_be_less") (' + previousKm + ' @lang("fleet.km_unit"))');
                $('#reception_km').focus();
                return false;
            }
            
            // تأكيد إنشاء Reception إذا تم ملء الكيلومترات
            if (receptionKm > 0) {
                if (!confirm('@lang("fleet.confirm_reception_creation") ' + receptionKm + '. @lang("fleet.do_you_want_to_continue")')) {
                    e.preventDefault();
                    return false;
                }
            }
        });
    });
</script>
@endsection

@section('extra_css')
<style>
    .border-info {
        border-color: #17a2b8 !important;
    }
    
    .alert-secondary {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
    }
    
    .form-text {
        font-size: 0.875em;
    }
</style>
@endsection

