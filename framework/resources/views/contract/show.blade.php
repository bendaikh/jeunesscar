{{-- resources/views/admin/contracts/show.blade.php --}}
@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('contract') }}">@lang('fleet.contracts')</a></li>
<li class="breadcrumb-item active">@lang('fleet.contract_details')</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">@lang('fleet.contract_details') - {{ $contract->contract_number }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>@lang('fleet.client_information')</h4>
                <p><strong>@lang('fleet.name'):</strong> {{ $contract->client->name }}</p>
                <p><strong>@lang('fleet.address'):</strong> {{ $contract->client->address }}</p>
                <p><strong>@lang('fleet.phone'):</strong> {{ $contract->client->mobno }}</p>
            </div>
            <div class="col-md-6">
                <h4>@lang('fleet.vehicle_information')</h4>
                <p><strong>@lang('fleet.brand'):</strong> {{ $contract->vehicle->make_name }}</p>
                <p><strong>@lang('fleet.plate_number'):</strong> {{ $contract->vehicle->license_plate }}</p>
                <p><strong>@lang('fleet.start_km'):</strong> {{ $contract->vehicle->start_km }}</p>
            </div>
        </div>

        <hr>

        <div class="row mt-3">
            <div class="col-md-6">
                <h4>@lang('fleet.rental_information')</h4>
                <p><strong>@lang('fleet.start_date'):</strong> {{ $contract->start_date->format('Y-m-d') }}</p>
                <p><strong>@lang('fleet.end_date'):</strong> {{ $contract->end_date->format('Y-m-d') }}</p>
                <p><strong>@lang('fleet.duration'):</strong> {{ $contract->duration }} @lang('fleet.days')</p>
            </div>
            <div class="col-md-6">
                <h4>@lang('fleet.financial_information')</h4>
                <p><strong>@lang('fleet.daily_rate'):</strong> {{ number_format($contract->daily_rate, 2) }}</p>
                <p><strong>@lang('fleet.total_amount'):</strong> {{ $contract->formatted_total_amount }}</p>
                <p><strong>@lang('fleet.remaining_amount'):</strong> {{ number_format($contract->remaining_amount, 2) }}</p>
            </div>
        </div>

        @if($contract->additionalDrivers->count())
        <hr>
        <h4>@lang('fleet.additional_drivers')</h4>
        <div class="table-responsive">
            <table class="table table-bordered">
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
        @endif

        @if($contract->client_signature)
        <hr>
        <h4>@lang('fleet.signatures')</h4>
        <div class="row">
            <div class="col-md-6">
                <p><strong>@lang('fleet.client_signature'):</strong></p>
                <img src="{{ $contract->client_signature }}" style="max-width: 200px; border: 1px solid #ddd;">
            </div>
            @if($contract->witness_signature)
            <div class="col-md-6">
                <p><strong>@lang('fleet.witness_signature'):</strong></p>
                <img src="{{ $contract->witness_signature }}" style="max-width: 200px; border: 1px solid #ddd;">
            </div>
            @endif
        </div>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('contract') }}" class="btn btn-secondary">
            @lang('fleet.back')
        </a>
        <a href="{{ route('contract.edit', $contract->id) }}" class="btn btn-primary">
            @lang('fleet.edit')
        </a>
        <a href="{{ route('contract.generatePDF', ['id' => $contract->id]) }}" class="btn btn-info">
            <i class="fas fa-file-pdf"></i> @lang('fleet.download_pdf')
        </a>
    </div>
</div>
@endsection