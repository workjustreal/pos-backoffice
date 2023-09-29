@extends('layouts.master-layout', ['page_title' => 'รายละเอียดสินค้า'])
@section('css')
<link href="{{ asset('assets/css/custome.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">KACEE</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">API</a></li>
                        <li class="breadcrumb-item active">ORDER</li>
                    </ol>
                </div>
                <h4 class="page-title">Product Detail</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-12 col-12">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5>ชื่อสินค้า : <b class="text-pos">{{ $product_name }}</b></h5>
                            <h5>SKU : <b class="text-pos">{{ $sku }}</b></h5>
                            <h5>Barcode : <b class="text-pos">{{ $barcode }}</b></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group float-end" role="group" aria-label="Basic example">
                            <a href="{{ route('detail_export', [$sku]) }}"
                                class="btn btn-soft-primary waves-effect waves-light btn-sm float-end">Excel</a>
                            <a href="{{ route('detail_pdf', [$sku, $product_name, $barcode]) }}"
                                class="btn btn-soft-primary waves-effect waves-light btn-sm float-end">PDF</a>
                        </div>
                        <label class="d-inline-flex align-items-center mb-3">
                            แสดง
                            <select id="demo-show-entries" class="form-select form-select-sm ms-1 me-1">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                            รายการ
                        </label>

                        <div class="table-responsive">
                            <table id="demo-foo-pagination"
                                class="table table-striped mb-0 table-bordered toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">เลขออเดอร์</th>
                                        <th>จำนวนสินค้า ในบิล</th>
                                        <th> ราคาสินค้า </th>
                                        <th> ราคารวม </th>
                                        <th> สถานะ </th>
                                        <th> วัน/เวลา ในบิล </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($response as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->qty }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>
                                            <b class="text-pos">{{ $order->total_price }}
                                                บาท</b>
                                        </td>
                                        <td>
                                            @if ($order->status == '9')
                                            <span class="badge bg-success">เสร็จสิ้น</span>
                                            @elseif($order->status == '1')
                                            <span class="badge bg-warning">กำลังดำเนินการ</span>
                                            @elseif($order->status == '3')
                                            <span class="badge bg-danger">ยกเลิก</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->updated_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="active">
                                        <td colspan="10">
                                            <div class="text-end">
                                                <ul
                                                    class="pagination pagination-split justify-content-end footable-pagination">
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:void(0);" class="btn btn-dark mb-5" onclick="history.back()">
        <i class="fe-arrow-left"></i> กลับ
    </a>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/libs/footable/footable.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/foo-tables.init.js') }}"></script>
@endsection