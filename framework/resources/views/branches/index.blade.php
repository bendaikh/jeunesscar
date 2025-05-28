@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('fleet.branches')</li>
@endsection

@section('content')
<!-- Debug: التحقق من البيانات -->
@if(count($branches) == 0)
<div class="alert alert-info">
    لا توجد فروع محفوظة في النظام
</div>
@endif

<div class="row mb-4">
  <div class="col-12">
   
    
    @can('Branches add')
    <a href="{{ route('branches.create') }}" class="btn btn-primary ml-2">
      <i class="fa fa-plus"></i> @lang('fleet.addBranch')
    </a>
    @endcan
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">@lang('fleet.branches')</h3>
       
      </div>
      <div class="card-body table-responsive">
        <table class="table table-striped" id="branches_table">
          <thead class="thead-dark">
            <tr>
              <th>@lang('fleet.branchName')</th>
              <th>@lang('fleet.branchAddress')</th>
              <th>@lang('fleet.branchCity')</th>
              <th>@lang('fleet.branchPhone')</th>
              <th>@lang('fleet.branchEmail')</th>
              <th>@lang('fleet.branchContact')</th>
              <th>@lang('fleet.status')</th>
              <th width="150px">الإجراءات</th>
            </tr>
          </thead>
          <tbody>
            @forelse($branches as $branch)
            <tr>
              <td>{{ $branch->name ?? 'غير محدد' }}</td>
              <td>{{ $branch->address ?? 'غير محدد' }}</td>
              <td>{{ $branch->city ?? 'غير محدد' }}</td>
              <td>{{ $branch->phone ?? 'غير محدد' }}</td>
              <td>{{ $branch->email ?? 'غير محدد' }}</td>
              <td>{{ $branch->contact_person ?? 'غير محدد' }}</td>
              <td>
                @if($branch->is_active)
                  <span class="badge badge-success">نشط</span>
                @else
                  <span class="badge badge-danger">غير نشط</span>
                @endif
              </td>
              <td>
                
                
                <!-- النسخة مع الصلاحيات -->
                <div class="btn-group mt-1" role="group">
                  @can('Branches edit')
                  <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-info btn-sm">
                    <i class="fa fa-edit"></i>
                  </a>
                  @endcan
                  
                  @can('Branches delete')
                  <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display: inline-block;" id="delete-form-{{ $branch->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $branch->id }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                  @endcan
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="8" class="text-center">لا توجد فروع</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    console.log('تم تحميل الصفحة بنجاح');
    
    // تهيئة DataTable
    if ($.fn.DataTable) {
      $('#branches_table').DataTable({
        "language": {
          "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}'
        }
      });
    }
    
    // معالجة حذف الفرع (الطريقة الأولى)
    $(document).on('click', '.delete-btn', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      
      if (confirm('هل أنت متأكد من حذف هذا الفرع؟')) {
        $('#delete-form-' + id).submit();
      }
    });
  });
  
  // دالة حذف منفصلة
  function deleteBranch(id) {
    if (confirm('هل تريد حذف هذا الفرع؟')) {
      // يمكنك هنا إرسال طلب AJAX أو توجيه إلى رابط الحذف
      window.location.href = '/admin/branches/' + id + '/delete';
    }
  }
</script>
@endsection