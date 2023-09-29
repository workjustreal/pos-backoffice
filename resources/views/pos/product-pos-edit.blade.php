@extends('layouts.master-layout', ['page_title' => 'แก้ไขสินค้า POS'])
@section('css')
    <link href="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .sub{
            margin-bottom: -2px;
        }
    </style>
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">POS</a></li>
                            <li class="breadcrumb-item active">Product Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">แก้ไขราคาสินค้า</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-box">
                            <div class="row justify-content-end">
                                <div class="col-lg-2">
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="แก้ไขราคาทั้งหมด"
                                            aria-label="Recipient's username" aria-describedby="button-addon2"
                                            id="editall" name="editall">
                                        <button class="btn btn-soft-pink waves-effect waves-light" type="button"
                                            id="btnedit">แก้ไข</button>
                                    </div>
                                </div>
                            </div>
                            <form id="soform" class="form-horizontal" method="post" action="{{ route('update_price') }}">
                                {{ csrf_field() }}
                                <table class="table table-hover">
                                    <thead class="bg-blue-prik text-white">
                                        <tr>
                                            <th>ชื่อสินค้า</th>
                                            <th>SKU</th>
                                            <th>ราคา Ex</th>
                                            <th>ราคาปัจจุบัน</th>
                                            <th>แก้ไขราคา</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($product as $product)
                                            <tr>
                                                <td>{{ $product->names }}
                                                    @foreach ($log as $item)
                                                        @if ($product->barcode == $item['barcode'])
                                                            <p class="sub"><sub class="text-pos">{{ $item['name'] }} {{ $item['surname'] }} <i>( {{ $item['nickname'] }} )</i>
                                                                    &nbsp;&nbsp;ราคาแก้ไข : {{ $item['price'] }}
                                                                    บาท &nbsp;&nbsp;{{ $item['updated_at'] }}</sub></p>
                                                        @endif
                                                    @endforeach
                                                    <input type="text" name="id[]" value="{{ $product->id }}" hidden>
                                                </td>
                                                <td>{{ $product->stkcod }}
                                                    <input type="text" name="barcode[]" value="{{ $product->barcode }}"
                                                        hidden>
                                                </td>
                                                <td>{{$product->sellpr1}}</td>
                                                <td>
                                                    <b class="text-pos">{{ $product->price }}</b>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control price" name="price[]"
                                                        value="{{ $product->price }}">
                                                </td>
                                            </tr>
                                            @if ($i == 1)
                                                </tr>
                                                @php $i=0; @endphp
                                            @else
                                                @php $i++; @endphp
                                            @endif
                                    </tbody>
                                    @endforeach
                                </table>
                                <a href="{{ url('pos/price') }}" class="btn btn-dark">
                                    <i class="fe-arrow-left"></i> กลับ
                                </a>
                            </form>
                            <button class="btn btn-info float-end mr-5" onclick="changeprice()" ><i class="fe-save"></i> Save</button>
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
    <script>
        $('#btnedit').click(function() {
            $('.price').val($('#editall').val());
        });
    </script>
@endsection
