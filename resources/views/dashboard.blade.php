@extends('layouts.master-layout', ['page_title' => 'Home'])
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ URL::asset('assets/css/datatables/datatables.min.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- inputdate --}}
    <link href="{{ asset('assets/css/datepicker.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <div class="input-group mb-3">
                            <select class="form-select form-select-sm" id="dash_shop" name="dash_shop">
                                <option value="" @if ($dash_shop == '') selected @endif>ทั้งหมด</option>
                                @foreach ($shop as $shop)
                                    <option value="{{ $shop['shop_code'] }}"
                                        @if ($dash_shop == $shop['shop_code']) selected @endif>
                                        {{ $shop['shop_name'] }}</option>
                                @endforeach
                            </select>
                            <label class="input-group-text" for="inputGroupSelect02">ร้านค้า</label>
                        </div>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @if (Auth::User()->permission_admin())
                <div class="col-md-6 col-xl-3 hvr-bob">
                    <div class="widget-rounded-circle card bg-product">
                        <a href="#">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-lg rounded-circle bg-soft-danger border-white border">
                                            <i
                                                class="mdi mdi-chart-timeline-variant-shimmer font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h2 class="text-white">฿<span
                                                    data-plugin="counterup">{{ number_format($total_price) }}</span>
                                            </h2>
                                            <h5 class="text-light">ยอดขาย</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 hvr-bob">
                    <div class="widget-rounded-circle card bg-emp">
                        <a href="{{ url('admin/orderlist') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-lg rounded-circle bg-soft-success border-white border">
                                            <i class="fe-file-text font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h2 class="text-white"><span data-plugin="counterup">{{ number_format($order_count) }}</span>
                                            </h2>
                                            <h5 class="text-light">รายการออเดอร์</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 hvr-bob">
                    <div class="widget-rounded-circle card bg-Leave">
                        <a href="{{ url('/admin/shop-manage') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-lg rounded-circle bg-soft-primary border-white border">
                                            <i class="fas fa-store font-22 avatar-title text-white"></i>&nbsp;
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h2 class="text-white"><span data-plugin="counterup">{{ $shop_count }}</span>
                                            </h2>
                                            <h5 class="text-light">ร้านค้า</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 hvr-bob">
                    <div class="widget-rounded-circle card bg-stock">
                        <a href="{{ url('/admin/member-manage') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-lg rounded-circle bg-soft-warning border-white border">
                                            <i class="fas fa-users font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h2 class="text-white"><span data-plugin="counterup">{{ $pos_count }}</span>
                                            </h2>
                                            <h5 class="text-light">เครื่อง POS</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <div class="col-md-6 col-xl-4 hvr-bob">
                    <div class="widget-rounded-circle card bg-Leave">
                        <a href="{{ url('/admin/product-list') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-lg rounded-circle bg-soft-warning border-white border">
                                            <i class="fas fa-users font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h2 class="text-white"><span
                                                    data-plugin="counterup">{{ $product_count }}</span>
                                            </h2>
                                            <h5 class="text-light">รายการสินค้า</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 hvr-bob">
                    <div class="widget-rounded-circle card bg-emp">
                        <a href="{{ url('admin/orderlist') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-lg rounded-circle bg-soft-success border-white border">
                                            <i class="fe-file-text font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h2 class="text-white"><span
                                                    data-plugin="counterup">{{ $order_count }}</span>
                                            </h2>
                                            <h5 class="text-light">รายการออเดอร์</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 hvr-bob">
                    <div class="widget-rounded-circle card bg-product">
                        <a href="#">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-lg rounded-circle bg-soft-danger border-white border">
                                            <i
                                                class="mdi mdi-chart-timeline-variant-shimmer font-22 avatar-title text-white"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h2 class="text-white"><span
                                                    data-plugin="counterup">{{ number_format($total_price) }}</span>
                                            </h2>
                                            <h5 class="text-light">ยอดขาย</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-0">รายได้รวม</h4>
                        <div class="widget-chart text-center mb-2" dir="ltr">
                            <input type="text" value="{{ $percent }}" id="percent" name="percent" hidden>
                            <div id="total-revenue" class="mt-0" data-colors="#f1556c"></div>

                            <h5 class="text-muted mt-0">ยอดขายรวมของวันนี้</h5>
                            <h2>฿{{ number_format($total_today) }}</h2>
                            <h4>บาท</h4>
                            <p class="text-muted w-75 mx-auto sp-line-2"></p>

                            <div class="row mt-3">
                                <div class="col-4">
                                    <p class="text-muted font-15 mb-1 text-truncate">เป้าหมายต่อวัน</p>
                                    <h4><i class="mdi mdi-star-half-full text-blue me-1"></i>฿1,000</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted font-15 mb-1 text-truncate">สัปดาห์ ล่าสุด</p>
                                    <h4>
                                        @if ($total_lastweek > $total_week)
                                            <i class="fe-arrow-down text-danger"></i>
                                        @else
                                            <i class="fe-arrow-up text-success "></i>
                                        @endif
                                        ฿{{ number_format($total_week) }}
                                    </h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted font-15 mb-1 text-truncate">เดือน ล่าสุด</p>
                                    <h4>
                                        @if ($total_lastmonth > $total_month)
                                            <i class="fe-arrow-down text-danger"></i>
                                        @else
                                            <i class="fe-arrow-up text-success"></i>
                                        @endif
                                        ฿{{ number_format($total_month) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body pb-2">
                        <h4 class="header-title mb-3">ยอดขาย</h4>

                        <div dir="ltr">
                            <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <div class="input-group input-group-sm">
                                            {{-- <input type="text" class="form-control border" id="range-datepicker"
                                                    name="best_date"
                                                   value="{{$best_query}}"> --}}
                                            <input type="text" class="form-control" data-provide="datepicker"
                                                data-date-format="MM yyyy" data-date-min-view-mode="1" id="best_date"
                                                name="best_date" autocomplete="off" value="{{ $best_query }}">
                                            <span class="input-group-text bg-blue border-blue text-white">
                                                <i class="mdi mdi-calendar-range"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <h4 class="header-title">สินค้าขายดี</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bestsell as $best)
                                        <tr>
                                            <td>{{ $best->sku }}</td>
                                            <td>{{ $best->name }}</td>
                                            <td>{{ $best->total_qty }}</td>
                                            <td>{{ number_format($best->total_sumprice) }} ฿</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">สินค้าขายล่าสุด</h4>
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pdlast as $last)
                                        <tr>
                                            <td>{{ $last->sku }}</td>
                                            <td>{{ $last->name }}</td>
                                            <td>{{ $last->qty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div hidden>
            @foreach ($daytwoweek as $item)
                <input type="text" value="{{ $item }}" id="twoweek{{ $loop->index }}">
            @endforeach
            @foreach ($total_qty as $qty)
                <input type="text" value="{{ $qty }}" id="qty{{ $loop->index }}">
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#dash_shop").change(function() {
                var url = "{{ url('dashboard/shop') }}";
                $.get(url, {
                    dash_shop: $(this).val()
                }).then(function(res) {
                    location.reload()
                });
            });
            $("#best_date").change(function() {
                var url = "{{ url('dashboard/select_date') }}";
                $.get(url, {
                    best_date: $(this).val()
                }).then(function(res) {
                    location.reload()
                });
            });
            $("#best_date").datepicker({
                language: 'th-TH',
                format: 'mm/yyyy',
                autoclose: true
            });
        });
    </script>
    <script src="{{ asset('assets/js/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-1.init.js') }}"></script>

    {{-- inputdate --}}
    <script src="{{ asset('assets/js/bootstrap-datepicker-thai/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker-thai/bootstrap-datepicker-thai.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker-thai/locales/bootstrap-datepicker.th.js') }}"></script>
@endsection
