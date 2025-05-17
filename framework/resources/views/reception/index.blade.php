@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">@lang('fleet.vehicleReceptions')</h3>
        <div class="card-tools">
          <a href="{{ route('reception.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> @lang('fleet.addReception')
          </a>
        </div>
      </div>

      <div class="card-body table-responsive">
        <table id="data_table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>
                @if(isset($data) && $data->count() > 0)
                <input type="checkbox" id="select_all" />
                @endif
              </th>
              <th>@lang('fleet.id')</th>
              <th>@lang('fleet.vehicle')</th>
              <th>@lang('fleet.receptionDate')</th>
              <th>@lang('fleet.kmIn')</th>
              <th>@lang('fleet.previousKm')</th>
              <th>@lang('fleet.kmDifference')</th>
              <th>@lang('fleet.photos')</th>
              <th>@lang('fleet.action')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $row)
            <tr>
              <td>
                <input type="checkbox" name="ids[]" value="{{ $row->id }}" class="checkbox" id="chk{{ $row->id }}" onclick="checkcheckbox();">
              </td>
              <td>{{ $row->id }}</td>
              <td>
                @if($row->vehicle)
                  {{ $row->vehicle->make_name }} {{ $row->vehicle->model_name }}
                  <br>
                  <small>{{ $row->vehicle->license_plate }}</small>
                @else
                  @lang('fleet.vehicleDeleted')
                @endif
              </td>
              <td>{{ date('d-m-Y H:i', strtotime($row->reception_date)) }}</td>
              <td>{{ $row->km_in }} km</td>
              <td>{{ $row->previous_km ?? '-' }} km</td>
              <td>
                @if($row->previous_km)
                  {{ $row->km_in - $row->previous_km }} km
                @else
                  -
                @endif
              </td>
              <td>
                <span class="badge badge-info">{{ count($row->media) }}</span>
              </td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-gear"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu custom" role="menu">
                    <a class="dropdown-item" href="{{ route('reception.show', $row->id) }}">
                      <span aria-hidden="true" class="fa fa-eye" style="color: #3a7cfd;"></span> @lang('fleet.view')
                    </a>
                    <a class="dropdown-item" href="{{ route('reception.edit', $row->id) }}">
                      <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> @lang('fleet.edit')
                    </a>
                    <a class="dropdown-item delete_reception" data-id="{{ $row->id }}" data-toggle="modal" data-target="#deleteModal">
                      <span aria-hidden="true" class="fa fa-trash" style="color: #ff0000;"></span> @lang('fleet.delete')
                    </a>
                  </div>
                </div>
                {!! Form::open(['url' => 'admin/reception/'.$row->id, 'method' => 'DELETE', 'class' => 'form-horizontal', 'id' => 'form_'.$row->id]) !!}
                {!! Form::hidden('id', $row->id) !!}
                {!! Form::close() !!}
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>@if($data->count() > 0) <button class="btn btn-danger" id="bulk_delete" data-toggle="modal" data-target="#bulkModal" disabled>@lang('fleet.delete')</button> @endif</th>
              <th>@lang('fleet.id')</th>
              <th>@lang('fleet.vehicle')</th>
              <th>@lang('fleet.receptionDate')</th>
              <th>@lang('fleet.kmIn')</th>
              <th>@lang('fleet.previousKm')</th>
              <th>@lang('fleet.kmDifference')</th>
              <th>@lang('fleet.photos')</th>
              <th>@lang('fleet.action')</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal for bulk delete confirmation -->
<div id="bulkModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('fleet.delete')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>@lang('fleet.confirmBulkDelete')</p>
      </div>
      <div class="modal-footer">
        <form action="{{ route('reception.bulk_delete') }}" method="POST" id="form_delete">
          @csrf
          <input type="hidden" name="ids" id="bulk_hidden_ids" >
          <button class="btn btn-danger" type="submit" data-submit>@lang('fleet.delete')</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal for delete confirmation -->
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('fleet.delete')</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>@lang('fleet.confirmDelete')</p>
      </div>
      <div class="modal-footer">
        <button id="del_btn" class="btn btn-danger" type="button" data-submit>@lang('fleet.delete')</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('fleet.close')</button>
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
      "columnDefs": [
        { "orderable": false, "targets": [0,8] }
      ],
      "order": [[1, 'desc']]
    });

    // Select all checkbox functionality
    $("#select_all").on('click', function() {
      if(this.checked) {
        $('.checkbox').each(function() {
          this.checked = true;
        });
      } else {
        $('.checkbox').each(function() {
          this.checked = false;
        });
      }
      if($('.checkbox:checked').length > 0) {
        $('#bulk_delete').removeAttr('disabled');
      } else {
        $('#bulk_delete').attr('disabled', true);
      }
    });

    // Enable/disable bulk delete button based on checkbox selection
    $(document).on('click', '.checkbox', function() {
      if($('.checkbox:checked').length > 0) {
        $('#bulk_delete').removeAttr('disabled');
      } else {
        $('#bulk_delete').attr('disabled', true);
      }
    });

    // Handle bulk delete form submission
    $('#bulk_delete').on('click', function() {
      var ids = [];
      $('.checkbox:checked').each(function() {
        ids.push($(this).val());
      });
      $('#bulk_hidden_ids').val(ids.join(','));
    });
    
    // Handle single delete
    $('.delete_reception').on('click', function() {
      var id = $(this).data('id');
      $('#del_btn').data('id', id);
    });
    
    $('#del_btn').on('click', function() {
      var id = $(this).data('id');
      $('#form_' + id).submit();
    });
  });

  // Function to check/uncheck all checkboxes
  function checkcheckbox() {
    if($('.checkbox:checked').length > 0) {
      $('#bulk_delete').removeAttr('disabled');
    } else {
      $('#bulk_delete').attr('disabled', true);
    }
  }
</script>
@endsection