@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title fs-21 mb-1">Danh sách hoá đơn</h5>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Hoá đơn</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách hoá đơn</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">

                <div class="card-header">
                    <div class="card-title">
                        Danh sách hoá đơn
                    </div>
                </div>

                <div class="card-body">

                    <table id="responsiveDataTable" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tổng tiền</th>
                                <th>Khách hàng</th>
                                <th>Thời gian</th>
                                <th>Trạng thái hoá đơn</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Thanh toán</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td style="width:20px">
                                        {{ $row->orderID }}
                                    </td>
                                    <td>{{ Helper::format_cash($row->total_ammount) }} </td>
                                    <td>{!! Helper::getNameById($row->customer_id, 'customer') !!}</td>
                                    <td>{{ Carbon\Carbon::parse($row->order_date)->format('d/m/Y H:i:s') }} </td>
                                    <td>
                                        @if ($row->order_status == 'PAID')
                                            <span class="text-success">Đã thanh toán</span>
                                        @elseif($row->order_status == 'CANCELED')
                                            <span class="text-danger">Đã huỷ</span>
                                        @elseif($row->order_status == 'PENDING')
                                            <span>Chưa thanh toán</span>
                                        @else
                                            {{ $row->order_status }}
                                        @endif
                                    </td>
                                    <td>{{ $row->shipment_status }}</td>
                                    <td>{{ $row->payment_method }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.editOrder') }}/{{ $row->orderID }}">
                                                <i class="fa fa-edit me-2 font-success"></i>
                                            </a>
                                            <a href="{{ route('admin.editOrder') }}/{{ $row->orderID }}">
                                                <i class="fa fa-eye font-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Datatables Cdn -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- Internal Datatables JS -->
    <script src="{{ asset('assets/admin/js/datatables.js') }}"></script>
@endsection
