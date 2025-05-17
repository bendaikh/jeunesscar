@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">@lang('menu.receptionVehicles')</h3>
      </div>

      <div class="card-body table-responsive">
        <table id="data_table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>@lang('fleet.id')</th>
              <th>@lang('fleet.make')</th>
              <th>@lang('fleet.model')</th>
              <th>@lang('fleet.type')</th>
              <th>@lang('fleet.year')</th>
              <th>@lang('fleet.license_plate')</th>
              <th>@lang('fleet.color')</th>
              <th>@lang('fleet.status')</th>
              <th>@lang('fleet.action')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($vehicles as $vehicle)
            <tr>
              <td>{{ $vehicle->id }}</td>
              <td>{{ $vehicle->make_name }}</td>
              <td>{{ $vehicle->model_name }}</td>
              <td>{{ $vehicle->type }}</td>
              <td>{{ $vehicle->year }}</td>
              <td>{{ $vehicle->license_plate }}</td>
              <td>{{ $vehicle->color }}</td>
              <td>
                @if($vehicle->in_service == 1)
                <span class="badge badge-success">@lang('fleet.active')</span>
                @else
                <span class="badge badge-danger">@lang('fleet.inactive')</span>
                @endif
              </td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-gear"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu custom" role="menu">
                    <a class="dropdown-item" href="{{ route('vehicles.edit', $vehicle->id) }}"> <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> @lang('fleet.edit')</a>
                    <a class="dropdown-item" href="{{ route('vehicles.show', $vehicle->id) }}"> <span aria-hidden="true" class="fa fa-eye" style="color: #3a7cfd;"></span> @lang('fleet.view')</a>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>@lang('fleet.id')</th>
              <th>@lang('fleet.make')</th>
              <th>@lang('fleet.model')</th>
              <th>@lang('fleet.type')</th>
              <th>@lang('fleet.year')</th>
              <th>@lang('fleet.license_plate')</th>
              <th>@lang('fleet.color')</th>
              <th>@lang('fleet.status')</th>
              <th>@lang('fleet.action')</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('#data_table').DataTable({
      "language": {
        "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
      },
      columnDefs: [ { orderable: false, targets: [8] } ],
    });
  });
</script>
@endsection