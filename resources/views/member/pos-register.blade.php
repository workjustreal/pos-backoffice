@extends('layouts.master-layout', ['page_title' => 'สร้างผู้ใช้งาน'])
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
                        <li class="breadcrumb-item active">เครื่อง POS</li>
                    </ol>
                </div>
                <h4 class="page-title">เพิ่มเครื่อง</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <form class="form-horizontal" method="POST" action="{{ route('createuser') }}">
                            {{ csrf_field() }}
                            <div class="mb-3" {{ $errors->has('name') ? ' has-error' : '' }}>
                                <label for="name" class="form-label">ชื่อเครือง</label>
                                <input id="name" type="text"
                                    class="form-control @if (Session::has('shophavepos')) border border-danger @endif"
                                    name="name" value="{{ old('name') }}" required>
                                @if(Session::has('shophavepos'))
                                <p class="text-danger">{{Session::get('shophavepos')}}</p>
                                @endif
                            </div>
                            <div class="mb-3" {{ $errors->has('emp_id') ? ' has-error' : '' }}>
                                <label for="emp_id" class="form-label">User Pos</label>
                                <input id="emp_id" type="text"
                                    class="form-control @if (Session::has('username')) border border-danger @endif"
                                    name="emp_id" value="{{ old('emp_id') }}" maxlength="25" required>
                                @if(Session::has('username'))
                                <p class="text-danger">{{Session::get('username')}}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="shop_id" class="form-label">สิทธิเข้าถึงร้านค้า</label>
                                <select id="shop_id" name="shop_id" class="form-select"
                                    aria-label="Default select example" required>
                                    <option value="">เลือกร้านค้า</option>
                                    @foreach ($shop_data as $shop)
                                    <option value="{{ $shop['id'] }}" {{ old('shop_id')==$shop['shop_name'] ? 'selected'
                                        : '' }}>
                                        {{ $shop['shop_name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3" {{ $errors->has('password') ? ' has-error' : '' }}>
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password"
                                    class="form-control @if ($errors->has('password')) border border-danger @endif"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <p class="text-danger">รหัสไม่ตรงกัน</p>
                                </span>
                                @endif
                            </div>
                            <div class="mb-3" {{ $errors->has('is_admin') ? ' has-error' : '' }}>
                                <label for="password-confirm" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                            </div>
                            <label class="form-label">สิทธิล็อกอิน</label>
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
                        <button class="btn btn-info btn-block" type="submit"><i class="fe-user-plus"></i> CREATE
                            ACCOUNT </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection