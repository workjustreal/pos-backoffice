@extends('layouts.master-layout', ['page_title' => 'สร้างร้านค้า'])
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">KACEE</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">ร้านค้า</li>
                    </ol>
                </div>
                <h4 class="page-title">สร้างร้านค้า</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <form class="form-horizontal" method="POST" action="{{ route('createshop') }}">
                            @csrf
                            @error('shop_code')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="mb-3">
                                <label for="name" class="form-label">ชื่อร้านค้า</label>
                                <input id="name" type="text" pattern="[A-Za-z0-9ก-๏\s]+"
                                    class="form-control @if (Session::has('name')) border border-danger @endif"
                                    value="{{ old('name') }}" name="name" required>
                                @if(Session::has('name'))
                                <p class="text-danger">{{Session::get('name')}}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="shop_code"
                                    class="@error('shop_code') text-danger @enderror form-label">รหัสร้านค้า</label>
                                <input id="shop_code" type="number" value="{{ old('shop_code') }}"
                                    class="form-control  @if (Session::has('code')) border border-danger @endif"
                                    name="shop_code" required>
                                @if(Session::has('code'))
                                <p class="text-danger">{{Session::get('code')}}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="shop_code"
                                    class="@error('shop_code') text-danger @enderror form-label">รายละเอียด
                                    (ร้านค้า)</label>
                                <textarea id="shop_detail" name="shop_detail" type="text"
                                    value="{{ old('shop_detail') }}" rows="5" class="form-control"></textarea>
                            </div>
                            <label class="form-label">สถานะ</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_on" value="1"
                                    checked>
                                <label class="form-check-label" for="login_yes"> เปิด </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_close" value="0">
                                <label class="form-check-label" for="login_no"> ปิด </label>
                            </div>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-info btn-block" type="submit">
                            <i class="mdi mdi-layers-plus"></i> CREATE ACCOUNT </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection