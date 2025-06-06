@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('branches.index') }}">@lang('fleet.branches')</a></li>
<li class="breadcrumb-item active">@lang('fleet.addBranch')</li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">@lang('fleet.addBranch')</h3>
      </div>

      <div class="card-body">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {!! Form::open(['route' => 'branches.store','method'=>'post']) !!}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('name', __('fleet.branchName'), ['class' => 'form-label required']) !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('fleet.branchName')]) !!}
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('contact_person', __('fleet.branchContact'), ['class' => 'form-label']) !!}
              {!! Form::text('contact_person', null, ['class' => 'form-control', 'placeholder' => __('fleet.branchContact')]) !!}
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('address', __('fleet.branchAddress'), ['class' => 'form-label']) !!}
              {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('fleet.branchAddress')]) !!}
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('city', __('fleet.branchCity'), ['class' => 'form-label']) !!}
              {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('fleet.branchCity')]) !!}
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('state', __('fleet.state'), ['class' => 'form-label']) !!}
              {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('fleet.state')]) !!}
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('country', __('fleet.country'), ['class' => 'form-label']) !!}
              {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => __('fleet.country')]) !!}
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('zipcode', __('fleet.postal_code'), ['class' => 'form-label']) !!}
              {!! Form::text('zipcode', null, ['class' => 'form-control', 'placeholder' => __('fleet.postal_code')]) !!}
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('phone', __('fleet.branchPhone'), ['class' => 'form-label']) !!}
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => __('fleet.branchPhone')]) !!}
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('email', __('fleet.branchEmail'), ['class' => 'form-label']) !!}
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('fleet.branchEmail')]) !!}
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('latitude', __('fleet.latitude'), ['class' => 'form-label']) !!}
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                </div>
                {!! Form::text('latitude', null, ['class' => 'form-control', 'placeholder' => __('fleet.latitude')]) !!}
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('longitude', __('fleet.longitude'), ['class' => 'form-label']) !!}
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                </div>
                {!! Form::text('longitude', null, ['class' => 'form-control', 'placeholder' => __('fleet.longitude')]) !!}
              </div>
            </div>
          </div>
          
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('details', __('fleet.details'), ['class' => 'form-label']) !!}
              {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('fleet.details')]) !!}
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col-md-12">
            {!! Form::submit(__('fleet.save'), ['class' => 'btn btn-success']) !!}
            <a href="{{ route('branches.index') }}" class="btn btn-default">@lang('fleet.back')</a>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    // إضافة أي تهيئة للصفحة
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
@endsection