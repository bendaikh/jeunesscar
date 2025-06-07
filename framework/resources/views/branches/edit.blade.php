@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('branches.index') }}">@lang('fleet.branches')</a></li>
<li class="breadcrumb-item active">@lang('fleet.editBranch')</li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">@lang('fleet.editBranch'): {{ $branch->name }}</h3>
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

        {!! Form::model($branch, ['route' => ['branches.update', $branch->id], 'method'=>'PATCH']) !!}
        <div class="row">
          <!-- Branch Name -->
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('name', __('fleet.branchName'), ['class' => 'form-label required']) !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('fleet.branchName')]) !!}
            </div>
          </div>
          
          <!-- Contact Person -->
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('contact_person', __('fleet.branchContact'), ['class' => 'form-label']) !!}
              {!! Form::text('contact_person', null, ['class' => 'form-control', 'placeholder' => __('fleet.branchContact')]) !!}
            </div>
          </div>
          
          <!-- Address -->
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('address', __('fleet.branchAddress'), ['class' => 'form-label']) !!}
              {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('fleet.branchAddress')]) !!}
            </div>
          </div>
          
          <!-- City -->
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('city', __('fleet.branchCity'), ['class' => 'form-label']) !!}
              {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('fleet.branchCity')]) !!}
            </div>
          </div>
          
          <!-- State -->
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('state', __('fleet.state'), ['class' => 'form-label']) !!}
              {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('fleet.state')]) !!}
            </div>
          </div>
          
          <!-- Country -->
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('country', __('fleet.country'), ['class' => 'form-label']) !!}
              {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => __('fleet.country')]) !!}
            </div>
          </div>
          
          <!-- Postal Code -->
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('zipcode', __('fleet.postal_code'), ['class' => 'form-label']) !!}
              {!! Form::text('zipcode', null, ['class' => 'form-control', 'placeholder' => __('fleet.postal_code')]) !!}
            </div>
          </div>
          
          <!-- Phone -->
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
          
          <!-- Email -->
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
          
          <!-- Latitude -->
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('latitude', __('fleet.latitude'), ['class' => 'form-label']) !!}
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                </div>
                {!! Form::text('latitude', null, ['class' => 'form-control', 'placeholder' => __('fleet.latitude')]) !!}
              </div>
              <small class="form-text text-muted">@lang('fleet.latitude') (مثال: 24.7136)</small>
            </div>
          </div>
          
          <!-- Longitude -->
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('longitude', __('fleet.longitude'), ['class' => 'form-label']) !!}
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                </div>
                {!! Form::text('longitude', null, ['class' => 'form-control', 'placeholder' => __('fleet.longitude')]) !!}
              </div>
              <small class="form-text text-muted">@lang('fleet.longitude') (مثال: 46.6753)</small>
            </div>
          </div>
          
          <!-- Status -->
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('is_active', __('fleet.status'), ['class' => 'form-label']) !!}
              <div class="form-control-plaintext">
                <div class="custom-control custom-switch">
                  {!! Form::checkbox('is_active', 1, null, ['class' => 'custom-control-input', 'id' => 'is_active']) !!}
                  {!! Form::label('is_active', __('fleet.active'), ['class' => 'custom-control-label']) !!}
                </div>
              </div>
              <small class="form-text text-muted">قم بتفعيل أو إلغاء تفعيل هذا الفرع</small>
            </div>
          </div>
          
          <!-- Details -->
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('details', __('fleet.details'), ['class' => 'form-label']) !!}
              {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => __('fleet.details')]) !!}
              <small class="form-text text-muted">أضف أي تفاصيل إضافية حول هذا الفرع</small>
            </div>
          </div>
        </div>
        
        <!-- Branch Statistics -->
        <div class="row mt-4">
          <div class="col-md-12">
            <h5>@lang('fleet.branch_statistics')</h5>
            <hr>
          </div>
          <div class="col-md-3">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fa fa-car"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">@lang('fleet.branch_vehicles')</span>
                <span class="info-box-number">{{ $branch->vehicle_count ?? 0 }}</span>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fa fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">@lang('fleet.branch_users')</span>
                <span class="info-box-number">{{ $branch->user_count ?? 0 }}</span>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="fa fa-file-contract"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">@lang('fleet.branch_contracts')</span>
                <span class="info-box-number">{{ $branch->contract_count ?? 0 }}</span>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info-box bg-secondary">
              <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">تاريخ الإنشاء</span>
                <span class="info-box-number text-sm">{{ $branch->created_at ? $branch->created_at->format('Y-m-d') : 'غير محدد' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col-md-8">
            {!! Form::submit(__('fleet.save'), ['class' => 'btn btn-warning btn-lg']) !!}
            <a href="{{ route('branches.index') }}" class="btn btn-default btn-lg">@lang('fleet.back')</a>
            
            <!-- Quick Actions -->
            @if($branch->vehicle_count > 0)
            <a href="{{ route('branches.vehicles', $branch->id) }}" class="btn btn-info btn-sm ml-2">
              <i class="fa fa-car"></i> عرض المركبات
            </a>
            @endif
            
            @if($branch->user_count > 0)
            <a href="{{ route('branches.users', $branch->id) }}" class="btn btn-success btn-sm ml-2">
              <i class="fa fa-users"></i> عرض المستخدمين
            </a>
            @endif
          </div>
          <div class="col-md-4 text-right">
            <small class="text-muted">
              آخر تحديث: {{ $branch->updated_at ? $branch->updated_at->diffForHumans() : 'غير محدد' }}
            </small>
          </div>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- Map Modal for Location -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mapModalLabel">تحديد موقع الفرع</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="map" style="height: 400px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
        <button type="button" class="btn btn-primary" id="saveLocation">حفظ الموقع</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    // تهيئة التلميحات
    $('[data-toggle="tooltip"]').tooltip();
    
    // إضافة زر لفتح الخريطة
    $('input[name="latitude"], input[name="longitude"]').after(
      '<button type="button" class="btn btn-sm btn-outline-primary ml-2" data-toggle="modal" data-target="#mapModal">' +
      '<i class="fa fa-map"></i> اختر من الخريطة</button>'
    );
    
    // التحقق من صحة البيانات عند الإرسال
    $('form').on('submit', function(e) {
      var name = $('input[name="name"]').val();
      if (!name.trim()) {
        e.preventDefault();
        alert('يرجى إدخال اسم الفرع');
        $('input[name="name"]').focus();
        return false;
      }
      
      // تأكيد التحديث
      if (!confirm('هل أنت متأكد من تحديث بيانات هذا الفرع؟')) {
        e.preventDefault();
        return false;
      }
    });
    
    // تفعيل/إلغاء تفعيل الفرع
    $('#is_active').on('change', function() {
      var isActive = $(this).is(':checked');
      var message = isActive ? 'سيتم تفعيل هذا الفرع' : 'سيتم إلغاء تفعيل هذا الفرع';
      
      if (!confirm(message + '. هل تريد المتابعة؟')) {
        $(this).prop('checked', !isActive);
      }
    });
    
    // معاينة موقع الفرع الحالي
    var currentLat = $('input[name="latitude"]').val();
    var currentLng = $('input[name="longitude"]').val();
    
    if (currentLat && currentLng) {
      $('input[name="latitude"], input[name="longitude"]').after(
        '<a href="https://maps.google.com/?q=' + currentLat + ',' + currentLng + '" target="_blank" class="btn btn-sm btn-outline-info ml-2">' +
        '<i class="fa fa-external-link-alt"></i> عرض في الخريطة</a>'
      );
    }
  });
  
  // دالة لحفظ الموقع من الخريطة
  function saveLocation() {
    // هنا يمكنك إضافة منطق حفظ الموقع من الخريطة
    $('#mapModal').modal('hide');
  }
  
  // دالة للتحقق من صحة الإحداثيات
  function validateCoordinates() {
    var lat = parseFloat($('input[name="latitude"]').val());
    var lng = parseFloat($('input[name="longitude"]').val());
    
    if (lat && (lat < -90 || lat > 90)) {
      alert('خط العرض يجب أن يكون بين -90 و 90');
      return false;
    }
    
    if (lng && (lng < -180 || lng > 180)) {
      alert('خط الطول يجب أن يكون بين -180 و 180');
      return false;
    }
    
    return true;
  }
</script>
@endsection

@section('extra_css')
<style>
  .required::after {
    content: " *";
    color: red;
  }
  
  .info-box {
    margin-bottom: 15px;
  }
  
  .form-text {
    font-size: 0.875em;
  }
  
  .custom-switch .custom-control-label::before {
    width: 2.25rem;
    height: 1.25rem;
  }
  
  .custom-switch .custom-control-label::after {
    width: 1rem;
    height: 1rem;
  }
</style>
@endsection