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
                        <li class="breadcrumb-item active">ผู้ใช้งาน</li>
                    </ol>
                </div>
                <h4 class="page-title">เปลี่ยนรหัสผ่าน</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <form class="form-horizontal" method="POST" action="{{ route('changepassword', [$id]) }}">
                            {{ csrf_field() }}
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                รหัสผ่านไม่ตรงกัน
                            </div>
                            @endforeach
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" value=""
                                    required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input id="new_password" type="password" class="form-control" name="new_password"
                                    value="" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="new_confirm_password" class="form-label">Confirm Password</label>
                                <input id="new_confirm_password" type="password" class="form-control"
                                    name="new_confirm_password" dvalue="" required>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-info btn-block" type="submit"><i class="fe-save"></i> SAVE
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection