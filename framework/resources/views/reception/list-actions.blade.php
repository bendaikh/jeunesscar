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
    <a class="dropdown-item" data-id="{{ $row->id }}" data-toggle="modal" data-target="#deleteModal">
      <span aria-hidden="true" class="fa fa-trash" style="color: #ff0000;"></span> @lang('fleet.delete')
    </a>
  </div>
</div>

{!! Form::open(['url' => 'admin/reception/'.$row->id, 'method' => 'DELETE', 'class' => 'form-horizontal', 'id' => 'form_'.$row->id]) !!}
{!! Form::hidden('id', $row->id) !!}
{!! Form::close() !!}

<script>
  $('#deleteModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    $("#deleteForm").attr('action', 'reception/'+id);
  });
</script>