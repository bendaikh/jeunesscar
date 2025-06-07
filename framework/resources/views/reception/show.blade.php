@extends('layouts.app')

@section('extra_css')
<style type="text/css">
  .media-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-gap: 15px;
    margin-top: 15px;
  }
  .media-item {
    position: relative;
    height: 200px;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  }
  .media-item img,
  .media-item video {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .media-label {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 3px 8px;
    border-radius: 3px;
    font-size: 12px;
  }
  .info-row {
    margin-bottom: 10px;
  }
</style>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">
          @lang('fleet.receptionDetails') #{{ $reception->id }}
        </h3>
        <div class="card-tools">
          <a href="{{ route('reception.index') }}" class="btn btn-default btn-sm">
            <i class="fa fa-arrow-left"></i> @lang('fleet.back')
          </a>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5>@lang('fleet.vehicleInformation')</h5>
              </div>
              <div class="card-body">
                @if($reception->vehicle)
                  <div class="info-row">
                    <strong>@lang('fleet.make'):</strong> {{ $reception->vehicle->make_name }}
                  </div>
                  <div class="info-row">
                    <strong>@lang('fleet.model'):</strong> {{ $reception->vehicle->model_name }}
                  </div>
                  <div class="info-row">
                    <strong>@lang('fleet.licensePlate'):</strong> {{ $reception->vehicle->license_plate }}
                  </div>
                  <div class="info-row">
                    <strong>@lang('fleet.vin'):</strong> {{ $reception->vehicle->vin ?? 'N/A' }}
                  </div>
                  <div class="info-row">
                    <strong>@lang('fleet.color'):</strong> {{ $reception->vehicle->color_name }}
                  </div>
                  <div class="info-row">
                    <strong>@lang('fleet.year'):</strong> {{ $reception->vehicle->year }}
                  </div>
                @else
                  <div class="alert alert-warning">@lang('fleet.vehicleDeleted')</div>
                @endif
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5>@lang('fleet.receptionInformation')</h5>
              </div>
              <div class="card-body">
                <div class="info-row">
                  <strong>@lang('fleet.receptionDate'):</strong> {{ date('d-m-Y H:i', strtotime($reception->reception_date)) }}
                </div>
                <div class="info-row">
                  <strong>@lang('fleet.kmIn'):</strong> {{ $reception->km_in }} km
                </div>
                <div class="info-row">
                  <strong>@lang('fleet.previousKm'):</strong> {{ $reception->previous_km ?? '-' }} km
                </div>
                <div class="info-row">
                  <strong>@lang('fleet.kmDifference'):</strong>
                  @if($reception->previous_km)
                    {{ $reception->km_in - $reception->previous_km }} km
                  @else
                    -
                  @endif
                </div>
                <div class="info-row">
                  <strong>@lang('fleet.receivedBy'):</strong> 
                  @if($reception->user)
                    {{ $reception->user->name }}
                    @if(isset($reception->user->meta_data))
                      ({{ $reception->user->meta_data->first_name ?? '' }} {{ $reception->user->meta_data->last_name ?? '' }})
                    @endif
                  @else
                    -
                  @endif
                </div>
                <div class="info-row">
                  <strong>@lang('fleet.createdAt'):</strong> {{ date('d-m-Y H:i', strtotime($reception->created_at)) }}
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>@lang('fleet.notes')</h5>
              </div>
              <div class="card-body">
                {!! nl2br(e($reception->notes)) ?? 'No hay notas disponibles.' !!}
              </div>
            </div>
          </div>
        </div>
        
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>@lang('fleet.mediaFiles')</h5>
              </div>
              <div class="card-body">
                @if(count($reception->media) > 0)
                  <div class="media-gallery">
                    @foreach($reception->media as $media)
                      <div class="media-item">
                        @if($media->file_type == 'image')
                          <a href="{{ asset('storage/'.$media->file_path) }}" target="_blank">
                            <img src="{{ asset('storage/'.$media->file_path) }}" alt="Reception Image">
                          </a>
                          <span class="media-label">@lang('fleet.image')</span>
                        @else
                          <video src="{{ asset('storage/'.$media->file_path) }}" controls></video>
                          <span class="media-label">@lang('fleet.video')</span>
                        @endif
                      </div>
                    @endforeach
                  </div>
                @else
                  <div class="alert alert-info">@lang('fleet.noMediaFiles')</div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection