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
    width: 120px;
    height: 120px;
    border: 1px solid #ddd;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 10px;
  }
  .image-preview img,
  .image-preview video {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .remove-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(255,0,0,0.7);
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    line-height: 25px;
    text-align: center;
    cursor: pointer;
    font-weight: bold;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  }
  .file-type-label {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.6);
    color: white;
    padding: 3px;
    text-align: center;
    font-size: 12px;
  }
  .upload-section {
    margin-bottom: 15px;
    padding: 15px;
    border: 1px dashed #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
  }
  .dropzone-area {
    border: 2px dashed #ccc;
    border-radius: 5px;
    padding: 25px;
    text-align: center;
    margin-top: 10px;
    cursor: pointer;
    background-color: #f8f9fa;
    transition: all 0.3s;
  }
  .dropzone-area:hover, .dropzone-area.drag-over {
    border-color: #66afe9;
    background-color: #eff8ff;
  }
  .dropzone-area i {
    font-size: 32px;
    margin-bottom: 10px;
    color: #666;
  }
  .media-counter {
    background-color: #28a745;
    color: white;
    border-radius: 50%;
    padding: 2px 8px;
    font-size: 12px;
    margin-left: 5px;
  }
  .files-selected {
    margin-top: 10px;
    font-weight: bold;
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">@lang('fleet.addReception')</h3>
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

        <form method="POST" action="{{ route('reception.store') }}" enctype="multipart/form-data" id="reception-form">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="vehicle_id">@lang('fleet.selectVehicle')</label>
                <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                  <option value="">@lang('fleet.selectVehicle')</option>
                  @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" data-km="{{ $vehicle->int_mileage }}">
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
                  <input type="text" class="form-control" id="reception_date" name="reception_date" value="{{ date('Y-m-d H:i') }}" required>
                </div>
              </div>
              
              <div class="form-group">
                <label for="km_in">@lang('fleet.kmIn')</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="km_in" name="km_in" min="0" required>
                  <div class="input-group-append">
                    <span class="input-group-text">km</span>
                  </div>
                </div>
                <small id="kmHelper" class="form-text text-muted">@lang('fleet.currentKm'): <span id="current_km">-</span></small>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="notes">@lang('fleet.notes')</label>
                <textarea name="notes" id="notes" class="form-control" rows="5"></textarea>
              </div>
              
              <div class="form-group upload-section">
                <label>
                  @lang('fleet.uploadMedia') (@lang('fleet.optional'))
                  <span id="image-counter" class="media-counter">0</span> 
                  <span id="video-counter" class="media-counter">0</span>
                </label>
                
                <div class="dropzone-area" id="dropzone">
                  <i class="fa fa-cloud-upload"></i>
                  <p>Arrastre y suelte archivos aquí o haga click para seleccionar</p>
                  <p class="text-muted">Puede seleccionar múltiples imágenes y vídeos a la vez</p>
                </div>
                
                <div class="custom-file mt-2" style="display:none;">
                  <input type="file" class="custom-file-input" id="media" name="media[]" multiple accept="image/*, video/*">
                  <label class="custom-file-label" for="media">@lang('fleet.chooseFiles')</label>
                </div>
                
                <div class="files-selected" id="files-count"></div>
                <small class="form-text text-muted">@lang('fleet.maxFileSize')</small>
                
                <div id="preview" class="image-preview-container"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" class="btn btn-success">@lang('fleet.saveReception')</button>
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
    
    // Mostrar km actual al seleccionar vehículo
    $('#vehicle_id').on('change', function() {
      var selectedOption = $(this).find('option:selected');
      var km = selectedOption.data('km');
      $('#current_km').text(km ? km + ' km' : '-');
      
      // Auto-fill km_in with current kilometer value
      if (km) {
        $('#km_in').val(km);
      }
    });
    
    // Variables para contar archivos
    var imageCount = 0;
    var videoCount = 0;
    
    // Drop zone functionality
    var dropzone = document.getElementById('dropzone');
    var fileInput = document.getElementById('media');
    
    dropzone.addEventListener('click', function() {
      fileInput.click();
    });
    
    dropzone.addEventListener('dragover', function(e) {
      e.preventDefault();
      dropzone.classList.add('drag-over');
    });
    
    dropzone.addEventListener('dragleave', function() {
      dropzone.classList.remove('drag-over');
    });
    
    dropzone.addEventListener('drop', function(e) {
      e.preventDefault();
      dropzone.classList.remove('drag-over');
      
      if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        handleFiles(e.dataTransfer.files);
      }
    });
    
    // Vista previa de archivos multimedia
    $('#media').on('change', function(e) {
      handleFiles(this.files);
    });
    
    function handleFiles(files) {
      var newImageCount = 0;
      var newVideoCount = 0;
      
      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        
        if (file.type.match('image.*')) {
          newImageCount++;
        } else if (file.type.match('video.*')) {
          newVideoCount++;
        }
        
        reader.onload = (function(file) {
          return function(e) {
            var div = $('<div class="image-preview"></div>');
            var removeBtn = $('<button type="button" class="remove-btn">&times;</button>');
            var fileType = '';
            
            if (file.type.match('image.*')) {
              div.append('<img src="' + e.target.result + '" alt="Preview">');
              fileType = 'Imagen';
            } else if (file.type.match('video.*')) {
              div.append('<video src="' + e.target.result + '" controls></video>');
              fileType = 'Video';
            }
            
            div.append('<div class="file-type-label">' + fileType + '</div>');
            
            removeBtn.on('click', function() {
              if (file.type.match('image.*')) {
                imageCount--;
                updateCounter();
              } else if (file.type.match('video.*')) {
                videoCount--;
                updateCounter();
              }
              $(this).parent().remove();
              updateFilesSelectedText();
            });
            
            div.append(removeBtn);
            $('#preview').append(div);
          };
        })(file);
        
        reader.readAsDataURL(file);
      }
      
      imageCount += newImageCount;
      videoCount += newVideoCount;
      updateCounter();
      updateFilesSelectedText();
    }
    
    function updateCounter() {
      $('#image-counter').text(imageCount);
      $('#video-counter').text(videoCount);
    }
    
    function updateFilesSelectedText() {
      var total = imageCount + videoCount;
      if (total > 0) {
        $('#files-count').html('<i class="fa fa-check-circle text-success"></i> ' + total + ' archivos seleccionados (' + imageCount + ' imágenes, ' + videoCount + ' videos)');
      } else {
        $('#files-count').text('');
      }
    }
    
    // Forma de validación antes de enviar
    $('#reception-form').on('submit', function(e) {
      // Aquí puedes añadir validaciones adicionales si es necesario
      return true;
    });
  });
</script>
@endsection