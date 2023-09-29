@extends('layouts.master-layout', ['page_title' => 'รายการสินค้า POS'])
@section('css')
    <link href="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">POS</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                    <h4 class="page-title">รายการสินค้า</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-box">
                            <button class="btn btn-info" style="margin-bottom: -80px" id="btedit">แก้ไข</button>
                            <form id="soform" class="form-horizontal" method="get" action="{{ route('getedit') }}">
                                {{ csrf_field() }}
                                <table data-toggle="table" data-page-size="10" data-buttons-class="xs btn-light"
                                    data-pagination="true" class="table-bordered" data-search="true">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">
                                                <input type="checkbox" id="checkAll">

                                            </th>
                                            <th data-field="barcode" data-sortable="true">Barcode</th>
                                            <th data-field="sku" data-sortable="true">SKU</th>
                                            <th data-field="name" data-toggle="true">ชื่อสินค้า</th>
                                            <th data-field="qty" data-sortable="true">ราคาสินค้า</th>
                                            @if (Auth::User()->productPrice())
                                                <th data-field="edit" data-sortable="true">แก้ไข</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $product)
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" class="selectitems" name="selectitems[]"
                                                        value="{{ $product->id }}">
                                                </td>
                                                <td>
                                                    {{ $product->barcode }}
                                                </td>
                                                <td>{{ $product->stkcod }}</td>
                                                <td>{{ $product->names }}</td>
                                                <td><b class="text-pos">{{ $product->price }}</b></td>
                                                @if (Auth::User()->productPrice())
                                                    <td>
                                                        <a href="{{ url('product/pos/edit/') }}/{{ $product->id }}"
                                                            type="button"
                                                            class="btn btn-soft-info waves-effect waves-light btn-sm"><i
                                                                class="far fa-edit"></i></a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    <script>
        $(document).ready(function() {
            $("#btedit").click(function() {
                if ($('.selectitems:checked').length) {
                    document.getElementById("soform").submit();
                } else {
                    Swal.fire({
                        title: 'กรุณาเลือกสินค้าที่ต้องการ!',
                        icon: 'warning',
                    })
                }
            });
            $("#checkAll").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
            $('#soform').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
