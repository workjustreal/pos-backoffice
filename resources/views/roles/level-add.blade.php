@extends('layouts.master-layout', ['page_title' => 'เพิ่มสิทธิผู้ใช้งาน'])
@section('css')
<!-- third party css -->
<link href="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
<!-- third party css end -->
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">เพิ่มสิทธิผู้ใช้งาน</li>
                    </ol>
                </div>
                <h4 class="page-title">เพิ่มสิทธิผู้ใช้งาน</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <form class="form-horizontal" method="POST" action="{{ route('create.level') }}">
                            {{ csrf_field() }}
                            <label for="lavel">ชื่อสิทธิ</label>
                            <input type="text" id="lavel" name="lavel" class="form-control" required>
                            <button class="mt-3 btn btn-info"><i class="mdi mdi-content-save-all-outline"></i>
                                บันทึก</button>
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
@endsection