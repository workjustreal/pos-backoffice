@extends('layouts.master-layout', ['page_title' => 'จัดการบทบาท'])
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
                        <li class="breadcrumb-item active">สิทธิการใช้งาน</li>
                    </ol>
                </div>
                <h4 class="page-title">จัดการบทบาท</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <table data-toggle="table" data-page-size="10" data-buttons-class="xs btn-light"
                            data-pagination="true" class="table-bordered" data-search="true">
                            <thead class="table-light">
                                <tr>
                                    <th data-field="shop_id" data-sortable="true">สิทธิเข้าถึงร้านค้า</th>
                                    <th data-field="edit" data-toggle="true">แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response['data'] as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>
                                        <a href="{{url('level-edit')}}/{{ $item['id'] }}/{{ $item['name'] }}"
                                            type="button" class="btn btn-info btn-sm waves-effect waves-light"><i
                                                class="far fa-edit"></i></a>
                                        <a type="button" onclick="deletlevel({{ $item['id'] }})"
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