@extends('layouts.master-layout', ['page_title' => 'รายละเอียดออเดอร์'])
@section('css')
<link href="{{ asset('assets/css/custome.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
    <!-- start page title -->
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
                <h4 class="page-title">Order Detail</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-12 col-xl-12 col-12">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4>เลขออเดอร์ : <b class="text-pos">{{ $data['order_number'] }}</b></h4>
                        </div>
                        <div class="col-6">
                            <h4 class="float-end">
                                <b>สถานะ : </b> <span class="badge {{ $bgstatus }}">{{ $textstatus }}</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-12">
                                <div class="btn-group mb-2" role="group" aria-label="Basic example">
                                    <a href="{{ url('admin/order-detail-export') }}/{{ $id }}/{{ $data['order_number'] }}"
                                        class="btn btn-soft-primary waves-effect waves-light btn-sm float-end mb-2">Excel</a>
                                    <a href="{{ url('admin/order/detail/pdf') }}/{{ $id }}/{{ $data['order_number'] }}"
                                        class="btn btn-soft-primary waves-effect waves-light btn-sm float-end mb-2">PDF</a>
                                    <a href="{{ url('order/pdf/nobar') }}/{{ $id }}/{{ $data['order_number'] }}"
                                        class="btn btn-soft-primary waves-effect waves-light btn-sm float-end mb-2">PDF
                                        (ไม่มีบาร์โค้ด)</a>
                                </div>
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">#SKU</th>
                                            <th scope="col">#Barcode</th>
                                            <th scope="col">ชื่อสินค้า</th>
                                            <th scope="col" class="text-center">จำนวนสินค้า</th>
                                            <th scope="col" class="text-center">ราคาสินค้า</th>
                                            <th scope="col" class="text-center">ราคารวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['items'] as $item)
                                        <tr>
                                            <td>{{ $item['sku'] }}</td>
                                            <td>{{ $item['barcode'] }}</td>
                                            <td>{{ $item['names'] }}</td>
                                            <td class="text-center">{{ $item['qty'] }}</td>
                                            <td class="text-center">{{ $item['price'] }}</td>
                                            <td class="text-center">{{ $item['total_price'] }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5"><b class="text-pos">ราคารวม</b></td>
                                            <td class="text-end text-center">

                                                <b class="text-pos">{{ $data['total_price'] }}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($responsepayment != "empty")
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <b><u>ประวัติการชำระเงิน</u></b>
                @foreach ($responsepayment['data'] as $item)
                <p class="mt-2"><b>Bank ID : </b> <span> {{ $item['bank_id'] }}</span></p>
                <p><b>From Account : </b><span>
                        {{ $item['from_account'] }}</span>
                </p>
                <p><b>Date Time : </b><span> {{ $item['datetime'] }}</span></p>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <a href="javascript:void(0);" class="btn btn-dark" onclick="history.back()">
        <i class="fe-arrow-left"></i> กลับ
    </a>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/dropify/dropify.min.js') }}"></script>

<script src="{{ asset('assets/js/form-fileuploads.init.js') }}"></script>
@endsection