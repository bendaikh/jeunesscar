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
        <form action="{{ route('reception.bulk_delete_direct') }}" method="POST" id="bulk_delete_form">
          @csrf
          <input type="hidden" name="ids" id="bulk_hidden_ids">
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
                    </button>
                    <div class="dropdown-menu custom" role="menu">
                      <a class="dropdown-item" href="{{ route('reception.show', $row->id) }}">
                        <span aria-hidden="true" class="fa fa-eye" style="color: #3a7cfd;"></span> @lang('fleet.view')
                      </a>
                      <a class="dropdown-item" href="{{ route('reception.edit', $row->id) }}">
                        <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> @lang('fleet.edit')
                      </a>
                      <!-- Aquí usamos un enlace directo para eliminar -->
                      <a class="dropdown-item" href="{{ route('reception.delete', $row->id) }}" 
                         onclick="return confirm('@lang('fleet.confirmDelete')');">
                        <span aria-hidden="true" class="fa fa-trash" style="color: #ff0000;"></span> @lang('fleet.delete')
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>@if($data->count() > 0) 
                  <button class="btn btn-danger" id="direct_bulk_delete" type="button" disabled>@lang('fleet.delete')</button> 
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
            </tfoot>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    // Destruir DataTable si ya existe
    if ($.fn.DataTable.isDataTable('#data_table')) {
      $('#data_table').DataTable().destroy();
    }
    
    // Inicializar DataTable con los datos ya cargados en la tabla
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
        $('#direct_bulk_delete').removeAttr('disabled');
      } else {
        $('#direct_bulk_delete').attr('disabled', true);
      }
    });

    // Enable/disable bulk delete button based on checkbox selection
    $(document).on('click', '.checkbox', function() {
      if($('.checkbox:checked').length > 0) {
        $('#direct_bulk_delete').removeAttr('disabled');
      } else {
        $('#direct_bulk_delete').attr('disabled', true);
      }
    });

    // Función de eliminación masiva directa
    $('#direct_bulk_delete').on('click', function() {
      if ($('.checkbox:checked').length > 0) {
        if (confirm('@lang("fleet.confirmBulkDelete")')) {
          var ids = [];
          $('.checkbox:checked').each(function() {
            ids.push($(this).val());
          });
          $('#bulk_hidden_ids').val(ids.join(','));
          $('#bulk_delete_form').submit();
        }
      }
    });
  });

  function checkcheckbox() {
    if($('.checkbox:checked').length > 0) {
      $('#direct_bulk_delete').removeAttr('disabled');
    } else {
      $('#direct_bulk_delete').attr('disabled', true);
    }
  }
</script>
@endsection