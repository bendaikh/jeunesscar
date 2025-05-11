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

