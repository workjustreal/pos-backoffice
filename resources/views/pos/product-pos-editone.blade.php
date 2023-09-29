@extends('layouts.master-layout', ['page_title' => 'แก้ไขสินค้า POS'])
@section('css')
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
            <div class="col-lg-6 col-12">
                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-pink float-start"><i class="mdi mdi-circle-edit-outline me-1"></i>
                            แก้ไขราคาสินค้า
                        </div>
                        <div class="ribbon-content">
                            <div class="row justify-content-md-center mb-3">
                                {{-- <div class="col-lg-12">
                                    @foreach ($product as $product)
                                        <form id="soform" class="form-horizontal" method="post"
                                            action="{{ route('update_priceone', [$product->id]) }}">
                                            {{ csrf_field() }}
                                            <div class="input-group mb-2">
                                                <span class="input-group-text text-pink bg-soft-pink border-pink"
                                                    id="sku">SKU</span>
                                                <input type="text" class="form-control" aria-label="Sizing example input"
                                                    readonly value="{{ $product->stkcod }}" aria-describedby="sku">
                                            </div>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text text-pink bg-soft-pink border-pink"
                                                    id="barcode">Barcode</span>
                                                <input type="text" class="form-control" aria-label="Sizing example input"
                                                    readonly value="{{ $product->barcode }}" aria-describedby="barcode">
                                            </div>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text text-pink bg-soft-pink border-pink"
                                                    id="name">ชื่อสินค้า</span>
                                                <input type="text" class="form-control" aria-label="Sizing example input"
                                                    readonly value="{{ $product->names }}" aria-describedby="name">
                                            </div>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text text-pink bg-soft-pink border-pink"
                                                    id="name">ราคา Ex</span>
                                                <input type="text" class="form-control" aria-label="Sizing example input"
                                                    readonly value="{{ $product->sellpr1 }}" aria-describedby="name">
                                            </div>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text text-pink bg-soft-pink border-pink"
                                                    id="now">ราคาปัจจุบัน</span>
                                                <input type="text" class="form-control" aria-label="Sizing example input"
                                                    readonly value="{{ $product->price }}" aria-describedby="now">
                                            </div>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text text-primary bg-soft-primary border-primary"
                                                    id="price">แก้ไขราคา</span>
                                                <input type="number" class="form-control" aria-label="Sizing example input"
                                                    name="price" value="{{ $product->price }}" aria-describedby="price">
                                            </div>
                                        </form>
                                        <button class="btn btn-info mt-2 w-100" onclick="changeprice()"><i class="fe-save"></i> Save</button>
                                        <a href="javascript:void(0);" class="btn btn-dark mt-2 w-100"
                                            onclick="history.back()">
                                            <i class="fe-arrow-left"></i> กลับ
                                        </a>
                                    @endforeach
                                </div> --}}
                                <div class="col-lg-12">
                                    @foreach ($product as $product)
                                        <form id="soform" class="form-horizontal" method="post"
                                            action="{{ route('update_priceone', [$product->id]) }}">
                                            {{ csrf_field() }}
                                            <div class="row mb-2">
                                                <div class="col-lg-2">
                                                    SKU
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" readonly
                                                        value="{{ $product->stkcod }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-2">
                                                    Barcode
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" readonly
                                                        value="{{ $product->barcode }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-2">
                                                    ชื่อสินค้า
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" readonly
                                                        value="{{ $product->names }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-2">
                                                    ราคา Ex
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" readonly
                                                        value="{{ $product->sellpr1 }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-2">
                                                    ราคาปัจจุบัน
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" readonly
                                                        value="{{ $product->price }}">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-2">
                                                    <b class="text-primary">แก้ไขราคา</b>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="number" class="form-control border-primary" name="price"
                                                        value="{{ $product->price }}">
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-lg-9 offset-lg-2">
                                                <button class="btn btn-info mt-2 w-100" onclick="changeprice()"><i
                                                        class="fe-save"></i> Save</button>
                                                <a href="javascript:void(0);" class="btn btn-dark mt-2 w-100"
                                                    onclick="history.back()">
                                                    <i class="fe-arrow-left"></i> กลับ
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card ribbon-box">
                    <div class="card-body">
                        <div class="ribbon ribbon-pink float-end"><i class="mdi mdi-history me-1"></i>
                            แก้ไขล่าสุด
                        </div>
                        <div class="card-box">
                            <div class="ribbon-content">
                                @if (!$log->isEmpty())
                                    <div class="row justify-content-md-center mb-3">
                                        <div class="col-xl-12">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th scope="col">ชื่อ-นามสกุล</th>
                                                        <th scope="col">ราคาแก้ไข</th>
                                                        <th scope="col">วัน/เวลา แก้ไข</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($log as $log)
                                                        <tr>
                                                            <td>{{ $log->name }} {{ $log->surname }}<i class="text-pos">(
                                                                    {{ $log->nickname }} )</i></li>
                                                            </td>
                                                            <td>{{ $log->price }}</td>
                                                            <td>{{ $log->updated_at }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="row justify-content-md-center mb-3">
                                        <div class="col-xl-12">
                                            <div class="alert alert-success" role="alert">
                                                ไม่มีรายการแก้ไขราคา
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
