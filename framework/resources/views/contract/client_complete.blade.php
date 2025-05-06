@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">@lang('fleet.complete_client_info')</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('client.complete', $client->id) }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.id_number') <span class="text-danger">*</span></label>
                                <input type="text" name="id_number" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.id_expiry_date')</label>
                                <input type="date" name="id_expiry_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.license_number')</label>
                                <input type="text" name="license_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.license_issue_date')</label>
                                <input type="date" name="license_issue_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.passport_number')</label>
                                <input type="text" name="passport_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('fleet.passport_issue_date')</label>
                                <input type="date" name="passport_issue_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>@lang('fleet.mobile')</label>
                        <input type="text" name="mobile" class="form-control">
                    </div>
                    
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">
                            @lang('fleet.save_and_continue')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection