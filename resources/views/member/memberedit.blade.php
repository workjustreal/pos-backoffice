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
                        <li class="breadcrumb-item active">ผู้ใช้งาน</li>
                    </ol>
                </div>
                <h4 class="page-title">แก้ไขผู้ใช้งาน</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <form method="POST" action="{{ route('edit.user', [$id]) }}">
                            @csrf
                            @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            @foreach ($data as $user)
                            <div class="mb-3">
                                <label for="name" class="form-label">ชื่อเครื่อง</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $user['name'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="shop_id" class="form-label">สิทธิเข้าถึงร้านค้า</label>
                                <select id="shop_id" name="shop_id" class="form-select"
                                    aria-label="Default select example">
                                    @foreach ($shop_data as $shop)
                                    <option @if ($user['shop_id']==$shop['id']) selected @endif
                                        value="{{ $shop['id'] }}">{{ $shop['shop_name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">User Pos</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    value="{{ $user['email'] }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">สิทธิล็อกอิน</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_yes" value="1"
                                        @if ($user['status']==1) checked @endif>
                                    <label class="form-check-label" for="login_yes"> เปิด </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_no" value="0"
                                        @if ($user['status']==0) checked @endif>
                                    <label class="form-check-label" for="login_no"> ปิด </label>
                                </div>
                            </div>
                            <a class="btn btn-soft-primary waves-effect waves-light"
                                href="{{url('change-password')}}/{{ $id }}"><i class="mdi mdi-circle-edit-outline"></i>
                                คลิกเพื่อเปลี่ยนรหัสผ่าน</a>
                            <a class="btn btn-soft-danger waves-effect waves-light" class="mt-3"
                                onclick="resetConfirmationUserPassword({{ $user['id'] }})">
                                <i class="mdi mdi-lock-reset"></i> คลิกเพื่อรีเซ็ตรหัสผ่าน</a><br>
                            @endforeach
                            {{-- <button type="submit" class="btn btn-info mt-4"> SAVE</button> --}}
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-info btn-block" type="submit"><i class="fe-save"></i>
                                    SAVE </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection