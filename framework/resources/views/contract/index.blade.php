{{-- resources/views/admin/contracts/index.blade.php --}}
@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('fleet.contracts')</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">@lang('fleet.contracts_list')</h3>
        <div class="card-tools">
            <a href="{{ route('contract.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> @lang('fleet.new_contract')
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>@lang('fleet.contract_number')</th>
                        <th>@lang('fleet.client')</th>
                        <th>@lang('fleet.vehicle')</th>
                        <th>@lang('fleet.start_date')</th>
                        <th>@lang('fleet.end_date')</th>
                        <th>@lang('fleet.total_amount')</th>
                        <th>@lang('fleet.status')</th>
                        <th>@lang('fleet.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contracts as $contract)
                    <tr>
                        <td>{{ $contract->contract_number }}</td>
                        <td>{{ $contract->client->name }}</td>
                        <td>{{ $contract->vehicle->make_name }} ({{ $contract->vehicle->license_plate }})</td>
                        <td>{{ $contract->start_date->format('Y-m-d') }}</td>
                        <td>{{ $contract->end_date->format('Y-m-d') }}</td>
                        <td>{{ $contract->formatted_total_amount }}</td>
                        <td>
                            <span class="badge badge-{{ [
                                'pending' => 'warning',
                                'active' => 'success',
                                'completed' => 'info',
                                'cancelled' => 'danger'
                            ][$contract->status] }}">
                                {{ $contract->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('contract.show', $contract->id) }}" 
                                   class="btn btn-info btn-sm" title="@lang('fleet.view')">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('contract.edit', $contract->id) }}" 
                                   class="btn btn-primary btn-sm" title="@lang('fleet.edit')">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('contract.generatePDF', ['id' => $contract->id]) }}" 
                                   class="btn btn-secondary btn-sm" title="@lang('fleet.download_pdf')">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $contracts->links() }}
        </div>
    </div>
</div>
@endsection