{{-- resources/views/admin/contracts/show.blade.php --}}
@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('contract') }}">@lang('fleet.contracts')</a></li>
<li class="breadcrumb-item active">@lang('fleet.contract_details')</li>
@endsection

@section('styles')
<style>
    .contract-detail-card {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* To ensure border-radius applies to header */
    }

    .contract-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); /* Modern blue gradient */
        color: white;
        padding: 25px 30px;
        border-bottom: 5px solid #004085; /* Darker shade for depth */
    }

    .contract-header h3 {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 0;
        display: flex;
        align-items: center;
    }

    .contract-header .fas {
        margin-right: 12px;
        font-size: 1.5rem;
    }

    .status-badge {
        font-size: 0.8rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        margin-left: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Status-specific badge colors */
    .status-badge.badge-pending { background-color: #ffc107; color: #333; }
    .status-badge.badge-active { background-color: #28a745; color: white; }
    .status-badge.badge-completed { background-color: #17a2b8; color: white; }
    .status-badge.badge-cancelled { background-color: #dc3545; color: white; }
    .status-badge.badge-default { background-color: #6c757d; color: white; } /* Fallback */


    .header-actions .btn {
        border-radius: 8px;
        font-weight: 500;
        padding: 10px 20px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .header-actions .btn-light {
        background-color: rgba(255, 255, 255, 0.9);
        color: #0056b3;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .header-actions .btn-light:hover {
        background-color: white;
        color: #004085;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .header-actions .btn .fas {
        margin-right: 8px;
        font-size: 0.9rem; /* Adjusted icon size within button */
    }

    /* Styles for the rest of the page content can be added here */
    .contract-body {
        padding: 30px;
    }

    .info-section {
        margin-bottom: 30px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .info-section h5 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #0056b3;
        margin-bottom: 15px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
    }
    .info-section h5 .fas {
        margin-right: 10px;
        color: #007bff;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
    }

    .info-item {
        font-size: 0.95rem;
    }
    .info-item strong {
        color: #495057;
        min-width: 120px; /* Adjust as needed for alignment */
        display: inline-block;
    }
    .info-item span {
        color: #212529;
    }

    /* Driver table specific styles */
    .table-drivers {
        margin-top: 20px;
        border-radius: 8px;
        overflow: hidden; /* For border-radius on table */
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .table-drivers thead th {
        background-color: #e9ecef; /* Light grey for header */
        color: #495057;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }
    .table-drivers tbody td {
        vertical-align: middle;
    }
    .table-drivers tbody tr:hover {
        background-color: #f8f9fa;
    }

</style>
@endsection

@section('content')
<div class="container">
    <div class="contract-detail-card card mb-4">
        <div class="contract-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <h3 class="text-white mb-2 mb-md-0">
                    <i class="fas fa-file-alt"></i> {{-- Changed icon for variety --}}
                    <span>@lang('fleet.contract') #{{ $contract->contract_number }}</span>
                    @php
                        $statusClass = 'default'; // Fallback class
                        if ($contract->status == 'pending') $statusClass = 'pending';
                        elseif ($contract->status == 'active') $statusClass = 'active';
                        elseif ($contract->status == 'completed') $statusClass = 'completed';
                        elseif ($contract->status == 'cancelled') $statusClass = 'cancelled';
                    @endphp
                    <span class="status-badge badge-{{ $statusClass }}">
                        {{-- Assuming you have a way to get translated status text, e.g., $contract->status_text --}}
                        {{ $contract->status_text ?? Str::ucfirst($contract->status) }}
                    </span>
                </h3>
                <div class="header-actions mt-2 mt-md-0">
                    @can('Contracts edit') {{-- Assuming you use Spatie Permissions --}}
                    <a href="{{ route('contract.edit', $contract->id) }}" class="btn btn-light">
                        <i class="fas fa-edit"></i> @lang('fleet.edit')
                    </a>
                    @endcan
                    <a href="{{ route('contract.generatePDF', ['id' => $contract->id]) }}" class="btn btn-light ml-md-2">
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