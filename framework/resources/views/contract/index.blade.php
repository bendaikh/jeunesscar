@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('fleet.contracts')</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">@lang('fleet.create_contract')</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('contract.store') }}" id="contractForm">
                    @csrf
                    
                   <!-- Client Information -->
                   <div class="form-group" id="client-select-group">
                    <label for="existing_client">@lang('fleet.select_client')</label>
                    <div class="input-group">
                        <select class="form-control" name="client_id" id="existing_client">
                            <option value="">-- @lang('fleet.select_client') --</option>
                            @foreach($clientSelect as $client)
                                @if($client->userclient)
                                    <option value="{{ $client->id }}">
                                        {{ $client->first_name ? $client->first_name . ' ' . $client->last_name : $client->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-success" id="add-new-client">@lang('fleet.add_new_client')</button>
                        </div>
                    </div>
                </div>
                

<div id="new-client-form" style="display: none;">
    <div class="card mb-3">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h4>@lang('fleet.client_information')</h4>
            <button type="button" class="btn btn-sm btn-warning" id="cancel-new-client">
                @lang('fleet.cancel')
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('fleet.last_name') <span class="text-danger">*</span></label>
                        <input type="text" name="client[last_name]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('fleet.first_name') <span class="text-danger">*</span></label>
                        <input type="text" name="client[first_name]" class="form-control" required>
                    </div>
                </div>
            </div>
                                
                                <div class="form-group">
                                    <label>@lang('fleet.address') <span class="text-danger">*</span></label>
                                    <input type="text" name="client[address]" class="form-control" required>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('fleet.id_number') <span class="text-danger">*</span></label>
                                            <input type="text" name="client[id_number]" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('fleet.id_expiry_date')</label>
                                            <input type="date" name="client[id_expiry_date]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('fleet.phone')</label>
                                            <input type="text" name="client[phone]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('fleet.license_number')</label>
                                            <input type="text" name="client[license_number]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('fleet.license_issue_date')</label>
                                            <input type="date" name="client[license_issue_date]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('fleet.mobile')</label>
                                            <input type="text" name="client[mobile]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('fleet.passport_number')</label>
                                            <input type="text" name="client[passport_number]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('fleet.passport_issue_date')</label>
                                            <input type="date" name="client[passport_issue_date]" class="form-control">
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>

                    </div>









                    
                   <!-- Vehicle Information -->
<div class="card mb-3">
    <div class="card-header bg-info text-white">
        <h4>@lang('fleet.vehicle_information')</h4>
    </div>
    <div class="card-body">
        <div class="form-group" id="vehicle-select-group">
            <label>@lang('fleet.select_vehicle')</label>
            <div class="input-group">
                <select class="form-control" name="vehicle_id" id="existing_vehicle">
                    <option value="">-- @lang('fleet.select_vehicle') --</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" 
                            data-brand="{{ $vehicle->make_name }}"
                            data-plate="{{ $vehicle->license_plate }}"
                            data-fuel="{{ $vehicle->fuel_type }}"
                            data-km="{{ $vehicle->start_km ?? $vehicle->int_mileage }}">
                            {{ $vehicle->make_name }} - {{ $vehicle->license_plate }}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button type="button" class="btn btn-success" id="add-new-vehicle">@lang('fleet.add_new_vehicle')</button>
                </div>
            </div>
        </div>
        

        <div id="new-vehicle-form" style="display: none;">

            <div class="card mb-3">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4>@lang('fleet.vehicle_information')</h4>
                    <button type="button" class="btn btn-sm btn-warning" id="cancel-new-vehicle">
                        @lang('fleet.cancel')
                    </button>
                </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('fleet.brand') <span class="text-danger">*</span></label>
                        <input type="text" name="vehicle[brand]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('fleet.plate_number') <span class="text-danger">*</span></label>
                        <input type="text" name="vehicle[plate_number]" class="form-control" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('fleet.start_km') <span class="text-danger">*</span></label>
                        <input type="number" name="vehicle[start_km]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('fleet.fuel_type') <span class="text-danger">*</span></label>
                        <select name="vehicle[fuel_type]" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="Essence">Essence</option>
                            <option value="Diesel">Diesel</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>@lang('fleet.color')</label>
                        <input type="text" name="vehicle[color]" class="form-control">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('fleet.year')</label>
                        <input type="text" name="vehicle[year]" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('fleet.engine_type')</label>
                        <input type="text" name="vehicle[engine_type]" class="form-control">
                    </div>
                </div>
            </div>









        </div>
        </div>
    </div>
</div>



                    <!-- Rental Information -->
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white">
                            <h4>@lang('fleet.rental_information')</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('fleet.start_date') <span class="text-danger">*</span></label>
                                        <input type="date" name="rental[start_date]" id="startDate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('fleet.start_time') <span class="text-danger">*</span></label>
                                        <input type="time" name="rental[start_time]" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('fleet.end_date') <span class="text-danger">*</span></label>
                                        <input type="date" name="rental[end_date]" id="endDate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('fleet.end_time') <span class="text-danger">*</span></label>
                                        <input type="time" name="rental[end_time]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('fleet.start_location')</label>
                                        <input type="text" name="rental[start_location]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('fleet.end_location')</label>
                                        <input type="text" name="rental[end_location]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('fleet.daily_rate') <span class="text-danger">*</span></label>
                                        <input type="number" name="rental[daily_rate]" id="dailyRate" class="form-control calculation" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('fleet.duration') (Jours)</label>
                                        <input type="number" name="rental[duration]" id="duration" class="form-control calculation" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('fleet.total_amount') (DH)</label>
                                        <input type="number" name="rental[total_amount]" id="totalAmount" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('fleet.advance_payment') (DH)</label>
                                        <input type="number" name="rental[advance_payment]" id="advancePayment" class="form-control calculation">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('fleet.remaining_amount') (DH)</label>
                                        <input type="number" name="rental[remaining_amount]" id="remainingAmount" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('fleet.franchise') (DH) <span class="text-danger">*</span></label>
                                        <input type="number" name="rental[franchise]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>@lang('fleet.remarks')</label>
                                <textarea name="rental[remarks]" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Driver Information -->
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                            <h4>@lang('fleet.additional_driver')</h4>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="hasAdditionalDriver">
                                <label class="form-check-label text-white">@lang('fleet.has_additional_driver')</label>
                            </div>
                        </div>
                        <div class="card-body" id="additionalDriverSection" style="display:none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('fleet.last_name')</label>
                                        <input type="text" name="additional_driver[last_name]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('fleet.first_name')</label>
                                        <input type="text" name="additional_driver[first_name]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>@lang('fleet.address')</label>
                                <input type="text" name="additional_driver[address]" class="form-control">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('fleet.id_number')</label>
                                        <input type="text" name="additional_driver[id_number]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('fleet.id_expiry_date')</label>
                                        <input type="date" name="additional_driver[id_expiry_date]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>@lang('fleet.mobile')</label>
                                        <input type="text" name="additional_driver[mobile]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('fleet.license_number')</label>
                                        <input type="text" name="additional_driver[license_number]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('fleet.license_issue_date')</label>
                                        <input type="date" name="additional_driver[license_issue_date]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white">
                            <h4>@lang('fleet.payment_method')</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash" checked>
                                    <label class="form-check-label" for="cash">@lang('fleet.cash')</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_method" id="check" value="check">
                                    <label class="form-check-label" for="check">@lang('fleet.check')</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="payment_method" id="other" value="other">
                                    <label class="form-check-label" for="other">@lang('fleet.other')</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fa fa-file-pdf"></i> @lang('fleet.generate_contract')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection



@section('script')
<script type="text/javascript">

   // عند الضغط على زر إضافة عميل جديد
$('#add-new-client').click(function() {
    $('#new-client-form').show();
    $('#client-select-group').hide();
    $('#existing_client').prop('required', false);
    $('#new-client-form input[required]').prop('required', true);
});

// عند الضغط على زر إضافة سيارة جديدة
$('#add-new-vehicle').click(function() {
    $('#new-vehicle-form').show();
    $('#vehicle-select-group').hide();
    $('#existing_vehicle').prop('required', false);
    $('#new-vehicle-form input[required], #new-vehicle-form select[required]').prop('required', true);
});


$('#cancel-new-vehicle').click(function() {
            $('#new-vehicle-form').hide();
            $('#vehicle-select-group').show();
            $('#existing_vehicle').val('').trigger('change');
            $('#existing_vehicle').prop('required', true);
            $('#new-vehicle-form input[required]').prop('required', false);
        });






    $(document).ready(function() {
        // Toggle additional driver section
        $('#hasAdditionalDriver').change(function() {
            if($(this).is(':checked')) {
                $('#additionalDriverSection').show();
            } else {
                $('#additionalDriverSection').hide();
            }
        });
        
         // Handle client selection
         $('#existing_client').change(function() {
            if($(this).val() === 'new') {
                $('#new-client-form').show();
                $('#client-select-group').hide();
                // Make select not required when adding new client
                $('#existing_client').prop('required', false);
                // Make new client fields required
                $('#new-client-form input[required]').prop('required', true);
            } else {
                $('#new-client-form').hide();
                $('#client-select-group').show();
                // Make select required when selecting existing client
                $('#existing_client').prop('required', true);
                // Make new client fields not required
                $('#new-client-form input[required]').prop('required', false);
            }
        });

        // Cancel adding new client
        $('#cancel-new-client').click(function() {
            $('#new-client-form').hide();
            $('#client-select-group').show();
            $('#existing_client').val('').trigger('change');
            $('#existing_client').prop('required', true);
            $('#new-client-form input[required]').prop('required', false);
        });

        // Calculate duration when dates change
        $('#startDate, #endDate').change(function() {
            calculateDuration();
            calculateTotal();
        });
        
        // Calculate total amount and remaining amount when values change
        $('.calculation').change(function() {
            calculateTotal();
        });



          // في قسم JavaScript
$('#existing_vehicle').change(function() {
    if($(this).val() === 'new') {
        $('#new-vehicle-form').show();
        $('#existing_vehicle').prop('required', false);
        // جعل حقول السيارة الجديدة مطلوبة
        $('#new-vehicle-form input[required], #new-vehicle-form select[required]').prop('required', true);
    } else {
        $('#new-vehicle-form').hide();
        $('#existing_vehicle').prop('required', true);
        // إزالة الإلزام من حقول السيارة الجديدة
        $('#new-vehicle-form input[required], #new-vehicle-form select[required]').prop('required', false);
        
        // تعبئة البيانات تلقائياً
        var selected = $(this).find('option:selected');
        if (selected.data('brand')) {
            $('input[name="vehicle[brand]"]').val(selected.data('brand'));
            $('input[name="vehicle[plate_number]"]').val(selected.data('plate'));
            $('select[name="vehicle[fuel_type]"]').val(selected.data('fuel')).trigger('change');
            $('input[name="vehicle[start_km]"]').val(selected.data('km'));
        }
    }
});
       
        
        function calculateDuration() {
            var startDate = new Date($('#startDate').val());
            var endDate = new Date($('#endDate').val());
            
            if(startDate && endDate) {
                var timeDiff = endDate.getTime() - startDate.getTime();
                var dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
                
                if(dayDiff > 0) {
                    $('#duration').val(dayDiff);
                } else {
                    $('#duration').val('');
                }
            }
        }
        
        function calculateTotal() {
            var dailyRate = parseFloat($('#dailyRate').val()) || 0;
            var duration = parseInt($('#duration').val()) || 0;
            var advancePayment = parseFloat($('#advancePayment').val()) || 0;
            
            var totalAmount = dailyRate * duration;
            var remainingAmount = totalAmount - advancePayment;
            
            $('#totalAmount').val(totalAmount.toFixed(2));
            $('#remainingAmount').val(remainingAmount.toFixed(2));
        }
    });
</script>
@endsection

{{-- 
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        // Toggle additional driver section
        $('#hasAdditionalDriver').change(function() {
            if($(this).is(':checked')) {
                $('#additionalDriverSection').show();
            } else {
                $('#additionalDriverSection').hide();
            }
        });
        
        // Calculate duration when dates change
        $('#startDate, #endDate').change(function() {
            calculateDuration();
            calculateTotal();
        });
        
        // Calculate total amount and remaining amount when values change
        $('.calculation').change(function() {
            calculateTotal();
        });
        
        function calculateDuration() {
            var startDate = new Date($('#startDate').val());
            var endDate = new Date($('#endDate').val());
            
            if(startDate && endDate) {
                // Calculate difference in days
                var timeDiff = endDate.getTime() - startDate.getTime();
                var dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1; // Including start day
                
                if(dayDiff > 0) {
                    $('#duration').val(dayDiff);
                } else {
                    $('#duration').val('');
                }
            }
        }
        
        function calculateTotal() {
            var dailyRate = parseFloat($('#dailyRate').val()) || 0;
            var duration = parseInt($('#duration').val()) || 0;
            var advancePayment = parseFloat($('#advancePayment').val()) || 0;
            
            var totalAmount = dailyRate * duration;
            var remainingAmount = totalAmount - advancePayment;
            
            $('#totalAmount').val(totalAmount.toFixed(2));
            $('#remainingAmount').val(remainingAmount.toFixed(2));
        }
    });
</script>
@endsection --}}