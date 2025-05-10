{{-- resources/views/admin/contracts/show.blade.php --}}
@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('contract') }}">@lang('fleet.contracts')</a></li>
<li class="breadcrumb-item active">@lang('fleet.contract_details')</li>
@endsection

@section('styles')
<style>
    .contract-detail-card {
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        overflow: hidden;
    }
    .contract-header {
        background: linear-gradient(135deg, #28a745, #20c997);
        padding: 20px;
    }
    .info-section {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        border-left: 4px solid #28a745;
        transition: all 0.3s ease;
    }
    .info-section:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .info-section h4 {
        color: #28a745;
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 20px;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 10px;
    }
    .info-item {
        margin-bottom: 15px;
    }
    .info-item strong {
        display: block;
        color: #495057;
        font-size: 0.85rem;
        margin-bottom: 5px;
    }
    .info-item p {
        margin: 0;
        font-weight: 500;
        color: #212529;
    }
    .signature-box {
        border: 1px dashed #dee2e6;
        border-radius: 5px;
        padding: 15px;
        text-align: center;
        background-color: #fff;
    }
    .signature-box img {
        max-width: 100%;
        height: auto;
    }
    .contract-footer {
        padding: 15px 20px;
        background-color: #f8f9fa;
    }
    .contract-footer .btn {
        border-radius: 30px;
        padding: 8px 20px;
        font-weight: 500;
    }
    .contract-footer .btn i {
        margin-right: 5px;
    }
    .status-badge {
        font-size: 14px;
        padding: 8px 15px;
        border-radius: 30px;
        margin-left: 15px;
        font-weight: 500;
    }
    .table-drivers {
        border-radius: 8px;
        overflow: hidden;
    }
    .table-drivers thead th {
        background-color: #f1f8e9;
        border-color: #c5e1a5;
        color: #33691e;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="contract-detail-card card mb-4">
        <div class="contract-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-white mb-0">
                    <i class="fas fa-file-contract mr-2"></i>
                    {{ $contract->contract_number }}
                    <span class="status-badge badge badge-{{ [
                        'pending' => 'warning',
                        'active' => 'success',
                        'completed' => 'info',
                        'cancelled' => 'danger'
                    ][$contract->status] }}">
                        {{ $contract->status_text }}
                    </span>
                </h3>
                <div>
                    <a href="{{ route('contract.edit', $contract->id) }}" class="btn btn-light">
                        <i class="fas fa-edit"></i> @lang('fleet.edit')
                    </a>
                    <a href="{{ route('contract.generatePDF', ['id' => $contract->id]) }}" class="btn btn-light ml-2">
                        <i class="fas fa-file-pdf"></i> @lang('fleet.download_pdf')
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="info-section">
                        <h4>
                            <i class="fas fa-user-tie mr-2"></i>
                            @lang('fleet.client_information')
                        </h4>
                        <div class="info-item">
                            <strong>@lang('fleet.name')</strong>
                            <p>{{ $contract->client->name }}</p>
                        </div>
                        <div class="info-item">
                            <strong>@lang('fleet.address')</strong>
                            <p>{{ $contract->client->address }}</p>
                        </div>
                        <div class="info-item">
                            <strong>@lang('fleet.phone')</strong>
                            <p>{{ $contract->client->mobno }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="info-section">
                        <h4>
                            <i class="fas fa-car mr-2"></i>
                            @lang('fleet.vehicle_information')
                        </h4>
                        <div class="info-item">
                            <strong>@lang('fleet.brand')</strong>
                            <p>{{ $contract->vehicle->make_name }}</p>
                        </div>
                        <div class="info-item">
                            <strong>@lang('fleet.plate_number')</strong>
                            <p>{{ $contract->vehicle->license_plate }}</p>
                        </div>
                        <div class="info-item">
                            <strong>@lang('fleet.start_km')</strong>
                            <p>{{ $contract->vehicle->start_km }} km</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="info-section">
                        <h4>
                            <i class="far fa-calendar-alt mr-2"></i>
                            @lang('fleet.rental_information')
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>@lang('fleet.start_date')</strong>
                                    <p>{{ $contract->start_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>@lang('fleet.end_date')</strong>
                                    <p>{{ $contract->end_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <strong>@lang('fleet.duration')</strong>
                            <p>{{ $contract->duration }} @lang('fleet.days')</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="info-section">
                        <h4>
                            <i class="fas fa-money-bill-wave mr-2"></i>
                            @lang('fleet.financial_information')
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>@lang('fleet.daily_rate')</strong>
                                    <p>{{ number_format($contract->daily_rate, 2) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <strong>@lang('fleet.total_amount')</strong>
                                    <p class="text-success font-weight-bold">{{ $contract->formatted_total_amount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <strong>@lang('fleet.remaining_amount')</strong>
                            <p class="text-danger">{{ number_format($contract->remaining_amount, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($contract->additionalDrivers->count())
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="info-section">
                        <h4>
                            <i class="fas fa-users mr-2"></i>
                            @lang('fleet.additional_drivers')
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-drivers">
                                <thead>
                                    <tr>
                                        <th>@lang('fleet.name')</th>
                                        <th>@lang('fleet.license_number')</th>
                                        <th>@lang('fleet.mobile')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contract->additionalDrivers as $driver)
                                    <tr>
                                        <td>{{ $driver->first_name }} {{ $driver->last_name }}</td>
                                        <td>{{ $driver->license_number }}</td>
                                        <td>{{ $driver->mobile }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($contract->client_signature)
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="info-section">
                        <h4>
                            <i class="fas fa-signature mr-2"></i>
                            @lang('fleet.signatures')
                        </h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong class="d-block mb-2">@lang('fleet.client_signature')</strong>
                                <div class="signature-box">
                                    <img src="{{ $contract->client_signature }}" alt="Client Signature">
                                </div>
                            </div>
                            @if($contract->witness_signature)
                            <div class="col-md-6 mb-3">
                                <strong class="d-block mb-2">@lang('fleet.witness_signature')</strong>
                                <div class="signature-box">
                                    <img src="{{ $contract->witness_signature }}" alt="Witness Signature">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <div class="contract-footer d-flex justify-content-between align-items-center">
            <a href="{{ route('contract') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> @lang('fleet.back')
            </a>
            
            <div>
                <a href="{{ route('contract.edit', $contract->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> @lang('fleet.edit')
                </a>
                <a href="{{ route('contract.generatePDF', ['id' => $contract->id]) }}" class="btn btn-success ml-2">
                    <i class="fas fa-file-pdf"></i> @lang('fleet.download_pdf')
                </a>
            </div>
        </div>
    </div>
</div>
@endsection