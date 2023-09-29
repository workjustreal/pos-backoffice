@extends('layouts.master-layout', ['page_title' => 'ผู้ใช้งาน'])
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">ผู้ใช้งาน</li>
                    </ol>
                </div>
                <h4 class="page-title">ผู้ใช้งาน</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <a href="{{ url('admin/user-role-add') }}" class="btn btn-dark"><i class="fe-user-plus"></i>
                            เพิ่มสิทธิผู้ใช้งาน</a>
                        <table data-toggle="table" data-page-size="10" data-buttons-class="xs btn-light"
                            data-pagination="true" class="table-bordered" data-search="true">
                            <thead class="table-light">
                                <tr>
                                    <th data-field="emp_id" data-sortable="true">รหัสพนักงาน</th>
                                    <th data-field="name" data-toggle="true">ชื่อ</th>
                                    <th data-field="level" data-toggle="true">บทบาทการใช้งาน</th>
                                    <th data-field="action" data-toggle="true">แก้ไข/ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $role)
                                <tr>
                                    <td>{{ $role['emp_id'] }}</td>
                                    <td>{{ $role['name'] }}</td>
                                    <td>
                                        @if ($role['level'] == 1)
                                        <span class="badge bg-primary">Admin</span>
                                        @elseif($role['level'] == 2)
                                        <span class="badge bg-dark">ผู้ใช้งานทั่วไป</span>
                                        @elseif($role['level'] == 9)
                                        <span class="badge bg-info">ผู้จัดการร้าน</span>
                                        @elseif($role['level'] == 10)
                                        <span class="badge bg-warning">ดูแลสินค้า</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('user-role/edit') }}/{{ $role['id'] }}" type="button"
                                            class="btn btn-info btn-sm waves-effect waves-light"><i
                                                class="far fa-edit"></i></a>

                                        <a type="button" onclick="deletrole({{ $role['id'] }})"
                                            class="btn btn-danger btn-sm waves-effect waves-light"><i
                                                class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
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