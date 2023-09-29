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
                        <form class="form-horizontal" method="POST" action="{{ route('role.create') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <label for="emp_id">รหัสพนักงาน</label>
                                    <input type="number" id="emp_id" name="emp_id" class="form-control"
                                        value="{{ old('emp_id') }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <label for="name">ชื่อพนักงาน</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="mt-3">ระดับผู้ใช้</label>
                                    <ul class="list-group">
                                        @foreach ($response as $level)
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="level" id="level"
                                                    value="{{ $level['id'] }}" required>
                                                <label class="form-check-label" for="level">
                                                    {{ $level['name'] }}
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="mt-3">ร้านค้าที่ดูแล</label>
                                    <ul class="list-group">
                                        @foreach ($shop as $shop)
                                        <li class="list-group-item">
                                            <div class="form-check form-check-success">
                                                <input class="form-check-input" type="checkbox" name="shop[]"
                                                    id="shop{{$shop['shop_code']}}" value="{{$shop['shop_code']}}">
                                                <label class="form-check-label"
                                                    for="shop{{$shop['shop_code']}}">{{$shop['shop_name']}}</label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
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
<script src="{{ asset('assets/js/bootstrap3-typeahead.js') }}"></script>
<script src="{{ asset('assets/js/pages/employee.init.js') }}"></script>
<!-- third party js ends -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#emp_id').on('keyup focus', function(){
            getEmp($(this), $('#name'));
        });
        $('#emp_id').on('blur', function(){
            getCheckEmp($(this), $('#name'));
        });
        // $( "#shop" ).prop( "disabled", true );
        // $('#level').change(function() {
        // if (this.value != 'ดูแลสินค้า') {
        // // ...
        // }
        // else if (this.value == 'transfer') {
        // // ...
        // }
        // });
    });
</script>
@endsection