@extends('layouts.master-layout', ['page_title' => 'เพิ่มประเภทผู้ใช้งาน'])
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
                            <li class="breadcrumb-item active">เพิ่มประเภทผู้ใช้งาน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">เพิ่มประเภทผู้ใช้งาน</h4>
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
                                <label for="emp_id">รหัสพนักงาน</label>
                                <input type="text" id="emp_id" name="emp_id" class="form-control">
                                <label class="mt-3">ระดับผู้ใช้</label>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="level" id="level1"
                                                value="1">
                                            <label class="form-check-label" for="level1">
                                                แอดมิน
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="level" id="level1"
                                                value="2">
                                            <label class="form-check-label" for="level1">
                                                ผู้ใช้งานทั่วไป
                                            </label>
                                        </div>
                                    </li>
                                </ul>
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
