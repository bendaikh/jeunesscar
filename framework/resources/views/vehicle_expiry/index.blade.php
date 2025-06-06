@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('fleet.vehicle_contract_expiry')</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
<style>
    .filter-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .filter-section:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .form-group label {
        font-weight: bold;
        color: #495057;
    }
    
    .btn-filter {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        color: white;
        box-shadow: 0 3px 6px rgba(0,123,255,0.2);
        transition: all 0.3s;
    }
    
    .btn-filter:hover {
        background: linear-gradient(135deg, #218838, #1aa179);
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(0,123,255,0.3);
    }
    
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
    
    .card-header {
        background: linear-gradient(135deg, #343a40, #495057);
        color: white;
        border-radius: 10px 10px 0 0;
    }
    
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: #495057;
    }
    
    /* تصميم الترقيم */
    .pagination {
        display: flex;
        justify-content: center;
        margin-bottom: 0;
    }
    
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        border-radius: 30px;
        padding: 8px 15px;
        margin: 0 5px;
        font-size: 14px;
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        color: white;
        box-shadow: 0 3px 10px rgba(32, 201, 151, 0.3);
    }
    
    .pagination .page-item .page-link {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 4px;
        font-weight: 500;
        border: none;
        color: #555;
        transition: all 0.2s ease;
    }
    
    .pagination .page-item .page-link:hover {
        background-color: #e9fff4;
        color: #28a745;
        transform: translateY(-2px);
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        box-shadow: 0 5px 15px rgba(32, 201, 151, 0.4);
    }
    
    /* أنماط معلومات الترقيم */
    .pagination-info {
        padding: 8px 15px;
        background-color: #f9f9f9;
        border-radius: 20px;
        font-size: 0.85rem;
        color: #666;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
    }

    /* أنماط جديدة للمعلومات الإضافية */
    .vehicle-image-container {
        width: 45px;
        height: 45px;
        overflow: hidden;
    }

    .avatar-sm {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }

    ul.list-unstyled li {
        padding: 3px 0;
        font-size: 0.85rem;
        color: #555;
    }

    ul.list-unstyled li i {
        color: #28a745;
        width: 18px;
    }

    .table td {
        vertical-align: middle;
    }

    /* تحسين مظهر الأزرار */
    .btn-group .btn {
        margin-right: 3px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.2s;
    }

    .btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    /* تحسين عرض صورة السيارة */
    .img-circle {
        border-radius: 50%;
        border: 2px solid #f8f9fa;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="filter-section">
                <h4 class="mb-3">@lang('fleet.filter_expiry_date')</h4>
                <form id="filter-form" method="GET" action="{{ route('vehicle_expiry.index') }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selected_date">@lang('fleet.select_date')</label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control datepicker" name="selected_date" id="selected_date" 
                                           value="{{ $selected_date->format('Y-m-d') }}" 
                                           placeholder="@lang('fleet.select_date')" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-md-6">
                            
                        <div class="form-group text-right">
                                <button type="submit" class="btn btn-secondary btn-filter">
                                    <i class="fa fa-search mr-1"></i> @lang('fleet.show_vehicles')
                                </button>
                                <!-- <a href="{{ route('vehicle_expiry.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-redo-alt mr-1"></i> @lang('fleet.reset')
                                </a> -->
                            </div>
                            </div>
                            
                        
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_select">@lang('fleet.quick_select')</label>
                                <select id="quick-date-selector" class="form-control">
                                    <option value="today" {{ $selected_date->isToday() ? 'selected' : '' }}>@lang('fleet.today')</option>
                                    <option value="tomorrow" {{ $selected_date->isTomorrow() ? 'selected' : '' }}>@lang('fleet.tomorrow')</option>
                                    <option value="next_week" {{ $selected_date->diffInDays(now()) == 7 ? 'selected' : '' }}>@lang('fleet.next_7_days')</option>
                                </select>
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-filter">
                                    <i class="fa fa-search mr-1"></i> @lang('fleet.show_vehicles')
                                </button>
                                 <a href="{{ route('vehicle_expiry.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-redo-alt mr-1"></i> @lang('fleet.reset')
                                </a> 
                            </div>
                        </div>
                    </div> -->
                </form>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-calendar-check mr-2"></i>
                        @lang('fleet.vehicles_returning_on') <span id="selected-date-display">{{ $formattedDate }}</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="expiry-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('fleet.vehicle')</th>  
                                    <th>@lang('fleet.vehicle_details')</th> <!-- عمود جديد للمعلومات الإضافية -->
                                    <th>@lang('fleet.client')</th>
                                    <th>@lang('fleet.contract_number')</th>
                                    <th>@lang('fleet.start_date')</th>
                                    <th>@lang('fleet.end_date')</th>
                                  
                                    <th>@lang('fleet.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($contracts) > 0)
                                    @foreach($contracts as $contract)
                                    <tr>
                                        <td>
                                            @if($contract->vehicle)
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3 vehicle-image-container">
                                                        @if($contract->vehicle->vehicle_image)
                                                            <img src="{{ asset('uploads/'.$contract->vehicle->vehicle_image) }}" alt="Vehicle" class="img-circle" style="width: 45px; height: 45px; object-fit: cover;">
                                                        @else
                                                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-car text-white"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">{{ $contract->vehicle->make_name }} {{ $contract->vehicle->model_name }}</span>
                                                        <br>
                                                        <small class="text-muted">{{ $contract->vehicle->license_plate }}</small>
                                                    </div>
                                                </div>
                                            @else
                                                @lang('fleet.vehicleDeleted')
                                            @endif
                                        </td>
                                        <td>
                                            @if($contract->vehicle)
                                                <ul class="list-unstyled mb-0">
                                                    <li><i class="fas fa-palette mr-2"></i>{{ $contract->vehicle->color ?? '-' }}</li>
                                                    <li><i class="fas fa-calendar mr-2"></i>{{ $contract->vehicle->year ?? '-' }}</li>
                                                    @if($contract->vehicle->int_mileage)
                                                        <li><i class="fas fa-tachometer-alt mr-2"></i>{{ $contract->vehicle->int_mileage }} {{ Hyvikk::get('dis_format') }}</li>
                                                    @endif
                                                    @if($contract->vehicle->getMeta('insurance_number'))
                                                        <li><i class="fas fa-shield-alt mr-2"></i>{{ $contract->vehicle->getMeta('insurance_number') }}</li>
                                                    @endif
                                                </ul>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($contract->client)
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded-circle mr-2 d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <span>{{ $contract->client->getMeta('first_name') ? 
                                                            $contract->client->getMeta('first_name') . ' ' . $contract->client->getMeta('last_name') : 
                                                            $contract->client->name }}</span>
                                                        @if($contract->client->getMeta('phone'))
                                                            <br><small><i class="fas fa-phone-alt mr-1"></i>{{ $contract->client->getMeta('phone') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                @lang('fleet.clientDeleted')
                                            @endif
                                        </td>
                                        <td>{{ $contract->contract_number }}</td>
                                        <td>{{ date($date_format, strtotime($contract->start_date)) }}</td>
                                        <td>{{ date($date_format, strtotime($contract->end_date)) }}</td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('contract.show', $contract->id) }}" class="btn btn-sm btn-info" title="@lang('fleet.view')">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                
                                                @if(Auth::user()->can('Vehicles edit'))
                                                <a href="{{ route('contract.edit', $contract->id) }}" class="btn btn-sm btn-primary" title="@lang('fleet.edit')">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endif
                                                
                                               
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">@lang('fleet.no_vehicles_returning')</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <span class="pagination-info">
                                <i class="fas fa-list-ol mr-1"></i> @lang('fleet.showing') 
                                <span class="font-weight-bold">{{ $contracts->firstItem() ?? 0 }} - {{ $contracts->lastItem() ?? 0 }}</span> 
                                @lang('fleet.of') 
                                <span class="font-weight-bold">{{ $contracts->total() }}</span> 
                                @lang('fleet.entries')
                            </span>
                        </div>
                        <div class="mt-2 mt-sm-0">
                            {{ $contracts->appends(['selected_date' => $selected_date->format('Y-m-d')])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // تهيئة منتقي التواريخ
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
        
        // مُحدِّدات التاريخ السريع
        $('#quick-date-selector').on('change', function() {
            let today = moment().format('YYYY-MM-DD');
            
            switch($(this).val()) {
                case 'today':
                    $('#selected_date').val(today);
                    break;
                    
                case 'tomorrow':
                    $('#selected_date').val(moment().add(1, 'days').format('YYYY-MM-DD'));
                    break;
                    
                case 'next_week':
                    $('#selected_date').val(moment().add(7, 'days').format('YYYY-MM-DD'));
                    break;
            }
            
            // تقديم النموذج تلقائياً عند تغيير التاريخ السريع
            $('#filter-form').submit();
        });
    });
</script>
@endsection