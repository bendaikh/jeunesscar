{{-- resources/views/admin/contracts/index.blade.php --}}
@extends('layouts.app')

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('fleet.contracts')</li>
@endsection

@section('styles')
<style>
    .contract-card {
        transition: all 0.3s ease;
        border-left: 4px solid #28a745;
    }
    .contract-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .contract-pending { border-left-color: #ffc107; }
    .contract-active { border-left-color: #28a745; }
    .contract-completed { border-left-color: #17a2b8; }
    .contract-cancelled { border-left-color: #dc3545; }
    .action-buttons .btn {
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 3px;
        transition: all 0.2s;
    }
    .action-buttons .btn:hover {
        transform: scale(1.1);
    }
    .contract-header {
        background: linear-gradient(135deg, #28a745, #20c997);
        border-radius: 5px 5px 0 0;
    }
    .search-container {
        position: relative;
        margin-bottom: 1.5rem;
    }
    .search-container input {
        border-radius: 30px;
        padding-left: 40px;
        border: 1px solid #ddd;
    }
    .search-container i {
        position: absolute;
        left: 15px;
        top: 12px;
        color: #aaa;
    }
    .status-badge {
        border-radius: 30px;
        padding: 5px 12px;
        font-weight: 500;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .pagination .page-link {
        border-radius: 4px;
        margin: 0 3px;
    }
    .pagination .page-item.active .page-link {
        background-color: #28a745;
        border-color: #28a745;
    }
    /* الأنماط الموجودة سابقاً */
    
    /* تحسين أنماط عناصر الترقيم مثل reception/index */
    .pagination {
        display: flex;
        justify-content: center;
        margin-bottom: 0;
    }
    
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        border-radius: 30px;
        padding: 8px 15px;
        margin: 0 5px;
        font-size: 14px;
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        color: white;
        box-shadow: 0 3px 10px rgba(32, 201, 151, 0.3);
    }
    
    .pagination .page-item .page-link {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 4px;
        font-weight: 500;
        border: none;
        color: #555;
        transition: all 0.2s ease;
    }
    
    .pagination .page-item .page-link:hover {
        background-color: #e9fff4;
        color: #28a745;
        transform: translateY(-2px);
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        box-shadow: 0 5px 15px rgba(32, 201, 151, 0.4);
    }
    
    .pagination .page-item.disabled .page-link {
        background-color: #f4f4f4;
        color: #aaa;
        cursor: not-allowed;
    }
    
    /* أنماط معلومات الترقيم */
    .pagination-info {
        padding: 8px 15px;
        background-color: #f9f9f9;
        border-radius: 20px;
        font-size: 0.85rem;
        color: #666;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
    }
    
    /* تحسين العرض على الأجهزة المحمولة */
    @media (max-width: 576px) {
        .pagination .page-item .page-link {
            width: 35px;
            height: 35px;
            margin: 0 2px;
            font-size: 0.85rem;
        }
        
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            padding: 6px 12px;
        }
        
        .pagination {
            margin-top: 10px;
        }
        
        .pagination-info {
            font-size: 0.75rem;
            padding: 6px 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('contract.create') }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus mr-2"></i> @lang('fleet.new_contract')
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header contract-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title text-white mb-0">
                    <i class="fas fa-file-contract mr-2"></i>@lang('fleet.contracts_list')
                </h3>
                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="contractsTable">
                    <thead>
                        <tr>
                            <th>@lang('fleet.contract_number')</th>
                            <th>@lang('fleet.client')</th>
                            <th>@lang('fleet.vehicle')</th>
                            <th>@lang('fleet.duration')</th>
                            <th>@lang('fleet.total_amount')</th>
                            <th>@lang('fleet.status')</th>
                            <th class="text-center">@lang('fleet.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contracts as $contract)
                        <tr class="contract-row" data-status="{{ $contract->status }}">
                            <td class="font-weight-bold">{{ $contract->contract_number }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light rounded-circle mr-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    {{ $contract->client->getMeta('first_name') ?$contract->client->getMeta('first_name') ." s".$contract->client->getMeta('last_name') : $contract->client->name }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light rounded-circle mr-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-car text-secondary"></i>
                                    </div>
                                    {{ $contract->vehicle->make_name }} 
                                    <span class="text-muted ml-2">({{ $contract->vehicle->license_plate }})</span>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="far fa-calendar-alt text-muted mr-1"></i>
                                    {{ $contract->start_date->format('M d') }} - {{ $contract->end_date->format('M d, Y') }}
                                </div>
                                <small class="text-muted">{{ $contract->start_date->diffInDays($contract->end_date) + 1 }} days</small>
                            </td>
                            <td>
                                <div class="font-weight-bold">{{ $contract->formatted_total_amount }}</div>
                            </td>
                            <td>
                                <span class="status-badge">
                                    {{ $contract->status }}
                                </span>
                            </td>
                            <td>
    <div class="dropdown text-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $contract->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i> {{-- أيقونة الإعدادات --}}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $contract->id }}">
            <a class="dropdown-item" href="{{ route('contract.show', $contract->id) }}">
                <i class="fas fa-eye text-info"></i> @lang('fleet.view')
            </a>
            <a class="dropdown-item" href="{{ route('contract.edit', $contract->id) }}">
                <i class="fas fa-edit text-primary"></i> @lang('fleet.edit')
            </a>
            <a class="dropdown-item" href="{{ route('contract.generatePDF', ['id' => $contract->id]) }}">
                <i class="fas fa-file-pdf text-secondary"></i> @lang('fleet.download_pdf')
            </a>
            <form action="{{ route('contract.destroy', $contract->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('@lang('fleet.confirm_delete')');">
                    <i class="fas fa-trash"></i> @lang('fleet.delete')
                </button>
            </form>
        </div>
    </div>
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <span class="pagination-info">
                <i class="fas fa-list-ol mr-1"></i> @lang('fleet.showing') 
                <span class="font-weight-bold">{{ $contracts->firstItem() ?? 0 }} - {{ $contracts->lastItem() ?? 0 }}</span> 
                @lang('fleet.of') 
                <span class="font-weight-bold">{{ $contracts->total() }}</span> 
                @lang('fleet.entries')
            </span>
        </div>
        <div class="mt-2 mt-sm-0">
            {{ $contracts->onEachSide(1)->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // فقط استخدم DataTables للبحث والترتيب، بدون ترقيم وعناصر التحكم الافتراضية
        $('#contractsTable').DataTable({
            "paging": false,        // تعطيل ترقيم DataTables
            "ordering": true,       // تمكين الترتيب
            "info": false,          // تعطيل عرض معلومات "عرض x من y صفحة"
            "searching": true,      // تمكين البحث
            "language": {
                "url": '{{ asset("assets/datatables/")."/".__("fleet.datatable_lang") }}',
            },
            "dom": 'rt<"clear">',   // فقط عرض الجدول (r) والمعالجة (t)
        });
        
        // فلاتر إضافية
        $(".filter-btn").click(function() {
            var filterValue = $(this).data('filter');
            
            $(".filter-btn").removeClass('btn-light').addClass('btn-outline-light');
            $(this).removeClass('btn-outline-light').addClass('btn-light');
            
            if (filterValue === 'all') {
                $("#contractsTable tbody tr").show();
            } else {
                $("#contractsTable tbody tr").hide();
                $("#contractsTable tbody tr[data-status='" + filterValue + "']").show();
            }
        });
    });
</script>
@endsection