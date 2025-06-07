@extends('layouts.app')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
<style type="text/css">
  .custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
  }
  .image-preview-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
  }
  .image-preview {
    position: relative;
    width: 100px;
    height: 100px;
    border: 1px solid #ddd;
    border-radius: 4px;
    overflow: hidden;
  }
  .image-preview img,
  .image-preview video {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .remove-btn {
    position: absolute;
    top: 0;
    right: 0;
    background: rgba(255,0,0,0.7);
    color: white;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    line-height: 20px;
    text-align: center;
    cursor: pointer;
  }
  .media-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    grid-gap: 10px;
    margin-top: 15px;
  }
  .media-item {
    position: relative;
    height: 150px;
    overflow: hidden;
    border-radius: 4px;
    border: 1px solid #ddd;
  }
  .media-item img,
  .media-item video {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">@lang('fleet.editReception') #{{ $reception->id }}</h3>
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

        <form method="POST" action="{{ route('reception.update', $reception->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="vehicle_id">@lang('fleet.selectVehicle')</label>
                <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                  <option value="">@lang('fleet.selectVehicle')</option>
                  @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" data-km="{{ $vehicle->int_mileage }}" @if($reception->vehicle_id == $vehicle->id) selected @endif>
                      {{ $vehicle->make_name }} {{ $vehicle->model_name }} - {{ $vehicle->license_plate }}
                    </option>
                  @endforeach
                </select>
              </div>
              
              <div class="form-group">
                <label for="reception_date">@lang('fleet.receptionDate')</label>
                <div class="input-group date">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input type="text" class="form-control" id="reception_date" name="reception_date" value="{{ $reception->reception_date }}" required>
                </div>
              </div>
              
              <div class="form-group">
                <label for="km_in">@lang('fleet.kmIn')</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="km_in" name="km_in" min="0" value="{{ $reception->km_in }}" required>
                  <div class="input-group-append">
                    <span class="input-group-text">km</span>
                  </div>
                </div>
                <small id="kmHelper" class="form-text text-muted">@lang('fleet.previousKm'): {{ $reception->previous_km ?? '-' }} km</small>
              </div>
              
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="update_vehicle_km" name="update_vehicle_km" value="1">
                  <label class="custom-control-label" for="update_vehicle_km">@lang('fleet.updateVehicleKm')</label>
                </div>
                <small class="form-text text-muted">@lang('fleet.updateVehicleKmHelp')</small>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="notes">@lang('fleet.notes')</label>
                <textarea name="notes" id="notes" class="form-control" rows="5">{{ $reception->notes }}</textarea>
              </div>
              
              <div class="form-group">
                <label for="media">@lang('fleet.uploadMedia') (@lang('fleet.optional'))</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="media" name="media[]" multiple accept="image/*, video/*">
                  <label class="custom-file-label" for="media">@lang('fleet.chooseFiles')</label>
                </div>
                <small class="form-text text-muted">@lang('fleet.maxFileSize')</small>
                <div id="preview" class="image-preview-container"></div>
              </div>
              
              @if(count($reception->media) > 0)
              <div class="form-group">
                <label>@lang('fleet.currentMedia')</label>
                <div class="media-gallery">
                  @foreach($reception->media as $media)
                  <div class="media-item" id="media-{{ $media->id }}">
                    @if($media->file_type == 'image')
                      <img src="{{ asset('storage/'.$media->file_path) }}" alt="Image">
                    @else
                      <video src="{{ asset('storage/'.$media->file_path) }}" controls></video>
                    @endif
                    <button type="button" class="remove-btn" data-id="{{ $media->id }}">&times;</button>
                  </div>
                  @endforeach
                </div>
              </div>
              @endif
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-warning">@lang('fleet.updateReception')</button>
                <a href="{{ route('reception.index') }}" class="btn btn-default">@lang('fleet.cancel')</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/moment.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#reception_date').datetimepicker({
      format: 'YYYY-MM-DD HH:mm',
      sideBySide: true,
    });
    
    // Vista previa de archivos multimedia
    $('#media').on('change', function(e) {
      $('#preview').empty();
      var files = e.target.files;
      var count = $(this)[0].files.length;
      $('.custom-file-label').text(count + ' ' + (count === 1 ? '@lang("fleet.fileSelected")' : '@lang("fleet.filesSelected")'));
      
      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        
        reader.onload = (function(file, index) {
          return function(e) {
            var div = $('<div class="image-preview"></div>');
            var removeBtn = $('<button type="button" class="remove-btn">&times;</button>');
            
            removeBtn.on('click', function() {
              $(this).parent().remove();
            });
            
            if (file.type.match('image.*')) {
              div.append('<img src="' + e.target.result + '" alt="Preview">');
            } else if (file.type.match('video.*')) {
              div.append('<video src="' + e.target.result + '" controls></video>');
            }
            
            div.append(removeBtn);
            $('#preview').append(div);
          };
        })(file, i);
        
        reader.readAsDataURL(file);
      }
    });
    
    // Delete existing media
    $('.media-item .remove-btn').on('click', function() {
      var mediaId = $(this).data('id');
      var mediaItem = $(this).parent();
      
      if (confirm('@lang("fleet.confirmDeleteMedia")')) {
        $.ajax({
          url: '{{ url("admin/reception/media") }}/' + mediaId,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            if (response.success) {
              mediaItem.remove();
            }
          },
          error: function() {
            alert('@lang("fleet.errorDeletingMedia")');
          }
        });
      }
    });
  });
</script>
@endsection