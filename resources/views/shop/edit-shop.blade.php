@extends('layouts.master-layout', ['page_title' => 'แก้ไขผู้ใช้งาน'])
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
                <h4 class="page-title">แก้ไขร้านค้า</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <form method="POST" action="{{ route('edit.shop', [$id]) }}">
                            @csrf
                            @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @foreach ($data as $item)
                            <div class="mb-3">
                                <label for="name" class="form-label">ชื่อร้านค้า</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $item['shop_name'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">รหัสร้านค้า</label>
                                <input type="number" id="code" name="code" class="form-control"
                                    value="{{ $item['shop_code'] }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">สิทธิล็อกอิน</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_yes" value="1"
                                        @if ($item['shop_status']==1) checked @endif>
                                    <label class="form-check-label" for="login_yes"> เปิด </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_no" value="0"
                                        @if ($item['shop_status']==0) checked @endif>
                                    <label class="form-check-label" for="login_no"> ปิด </label>
                                </div>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-info mt-4"><i class="far fa-save"></i> SAVE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection