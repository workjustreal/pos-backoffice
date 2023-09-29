@extends('layouts.master-layout', ['page_title' => 'แก้ไขออเดอร์'])
@section('css')
<link href="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

{{-- inputdate --}}
<link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                        <li class="breadcrumb-item active">Order Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">แก้ไขออเดอร์</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <form class="form-horizontal" method="post"
                            action="{{ route('order.update', $response['id']) }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <h3>เลขออเดอร์ : <b class="text-pos">{{$response['order_number']}}</b></h3>
                                    <h4>จำนวนสินค้าในบิล : {{$response['total_qty']}}</h4>
                                    <h4>ราคารวมในบิล : {{$response['total_price']}}</h4>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-12 mb-3">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupSelect01">สถานะ</label>
                                                <select
                                                    class="form-select text-white @if($response['status'] == '9') bg-success @else bg-danger @endif"
                                                    id="inputGroupSelect01" name="status">
                                                    <option value="9" @if($response['status']=='9' ) selected @endif>
                                                        สำเร็จ
                                                    </option>
                                                    <option value="3" @if($response['status']=='3' ) selected @endif>
                                                        ยกเลิก
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#SKU</th>
                                                <th scope="col">ชื่อสินค้า</th>
                                                <th scope="col">จำนวนสินค้า</th>
                                                <th scope="col">ราคาต่อชิ้น</th>
                                                <th scope="col"><b class="text-pos">ราคารวม</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($response['items'] as $item)
                                            <tr>
                                                <td>{{$item['sku']}}</td>
                                                <td>{{$item['names']}}</td>
                                                <td>{{$item['qty']}}</td>
                                                <td>{{$item['price']}}</td>
                                                <td><b class="text-pos">{{$item['total_price']}}</b></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-dark" onclick="history.back()">
                                <i class="fe-arrow-left"></i> กลับ
                            </a>
                            <button class="btn btn-info"><i class="fe-save"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- third party js -->
<script src="{{ asset('assets/js/ajax/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/bootstrap-tables.init.js') }}"></script>
<!-- third party js ends -->

{{-- inputdate --}}
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/form-pickers.init.js') }}"></script>
@endsection