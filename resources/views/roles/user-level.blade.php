@extends('layouts.master-layout', ['page_title' => 'สิทธิ์การใช้งาน'])
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
                            <li class="breadcrumb-item active">สิทธิ์การใช้งาน</li>
                        </ol>
                    </div>
                    <h4 class="page-title">สิทธิ์การใช้งาน</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-box">
                            <a href="{{ url('admin/add-user-level') }}" class="btn btn-dark mb-2 float-right">สร้างผู้ใช้งาน
                                &nbsp;<i class="fas fa-user-plus"></i></a>
                            <table data-toggle="table" data-page-size="10" data-buttons-class="xs btn-light"
                                data-pagination="true" class="table-bordered" data-search="true">
                                <thead class="table-light">
                                    <tr>
                                        <th data-field="shop_id" data-sortable="true">สิทธิเข้าถึงร้านค้า</th>
                                        <th data-field="name" data-sortable="true">ชื่อ</th>
                                        <th data-field="status" data-sortable="true">สถานะ</th>
                                        <th data-field="edit" data-toggle="true">แก้ไข</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
