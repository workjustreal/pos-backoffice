@extends('layouts.master-layout', ['page_title' => 'รายการสินค้า'])
@section('css')
<link href="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

{{-- inputdate --}}
<link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                        <li class="breadcrumb-item active">Product List</li>
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
                        <form class="form-horizontal" method="get" action="{{ route('productlist') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <label for="shop" class="form-label">ร้านค้า</label>
                                    <select class="form-select" id="shop_select" name="shop_select">
                                        <option selected value="">ทั้งหมด</option>
                                        @foreach ($shop as $shop)
                                        <option value="{{ $shop['shop_name'] }}" {{
                                            old('shop_select')==$shop['shop_name'] ? 'selected' : '' }}>
                                            {{ $shop['shop_name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-12">
                                    <input type="hidden" value="{{ old('pos_name') }}" id="hidden_pos_name">
                                    <label for="pos" class="form-label">เครื่อง POS</label>
                                    <select class="form-select" id="pos_name" name="pos_name">
                                        <option selected value="">ทั้งหมด</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-12">
                                    <label for="product_status" class="form-label">สถานะ</label>
                                    <select class="form-select" id="product_status" name="product_status">
                                        <option value="9" {{ old('product_status')=="9" ? 'selected' : '' }}>สำเร็จ
                                        </option>
                                        <option value="3" {{ old('product_status')=="3" ? 'selected' : '' }}>ยกเลิก
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="form-label">วันที่ในบิล</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="range-datepicker" onchange="myFunction()"
                                            class="form-control" name="order_date" @if (old('order_date')=='' )
                                            value="{{ $date }}" placeholder="เลือกวันที่ในบิล" @else
                                            value="{{ old('order_date') }}" @endif placeholder="เลือกวันที่ในบิล">
                                        <a class="btn btn-soft-info waves-effect waves-light"
                                            onclick="clearinput()">ล้าง</a>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <label class="form-label">ชื่อสินค้า / SKU</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="sku" name="sku"
                                            value="{{ old('sku') }}" pattern="[A-Za-z0-9ก-๏\s]+">
                                        <button id="order_search" class="btn btn-dark" type="submit"><i
                                                class="fas fa-search"></i>
                                            ค้นหา</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    @if (!old('shop_select') == '')
                                    <h5>ร้านค้า : <b class="text-pos">{{ old('shop_select') }}</b></h5>
                                    @else
                                    <h5>ร้านค้า : <b class="text-pos">ทั้งหมด</b></h5>
                                    @endif
                                    @if (!old('pos_name') == '')
                                    <h5>เครื่อง POS : <b class="text-pos">{{ old('pos_name') }}</b></h5>
                                    @else
                                    <h5>เครื่อง POS : <b class="text-pos">ทั้งหมด</b></h5>
                                    @endif
                                    @if (!$date == '' || !old('order_date') == '')
                                    <h5>วันที่ในบิล : <b class="text-pos">
                                            @if (old('order_date') == '')
                                            {{ $date }}
                                            @else
                                            {{ old('order_date') }}
                                            @endif
                                        </b></h5>
                                    @endif
                                    @if (!old('order_number') == '')
                                    <h5>เลขออเดอร์: <b class="text-pos">{{ old('order_number') }}</b></h5>
                                    @endif
                                    @if (!$list_count == 0)
                                    <h5>รายการสินค้า: <b class="text-pos">{{ $list_count }} รายการ</b></h5>
                                    @endif
                                    @if (!$product_count == 0)
                                    <h5>จำนวนสินค้า: <b class="text-pos">{{ $product_count }} ชิ้น</b></h5>
                                    @endif
                                    @if (!$product_count == 0)
                                    <h5>ยอดรวม: <b class="text-pos">{{ number_format($total_price) }} บาท</b></h5>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <input type="text" class="form-control" id="action" name="action" value="" hidden>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="submit"
                                    class=" btn btn-soft-primary waves-effect waves-light btn-sm float-start"
                                    onclick="document.getElementById('action').value='excel';setTimeout(() => {document.getElementById('action').value='';}, 500);">Excel</button>
                                <button type="submit"
                                    class=" btn btn-soft-primary waves-effect waves-light btn-sm float-start"
                                    onclick="document.getElementById('action').value='pdf';setTimeout(() => {document.getElementById('action').value='';}, 500);">PDF (Barcode)
                                </button>
                                <button type="submit" class=" btn btn-soft-primary waves-effect waves-light btn-sm float-start"
                                    onclick="document.getElementById('action').value='pdf2';setTimeout(() => {document.getElementById('action').value='';}, 500);">PDF (QRCode)
                                </button>
                                <button type="submit"
                                    class=" btn btn-soft-primary waves-effect waves-light btn-sm float-start"
                                    onclick="document.getElementById('action').value='nobar';setTimeout(() => {document.getElementById('action').value='';}, 500);">PDF
                                    (ไม่มีบาร์โค้ด)
                                </button>
                            </div>
                        </form>
                        <table data-toggle="table" data-page-size="10" data-buttons-class="xs btn-light"
                            data-pagination="true" class="table-bordered" data-search="true">
                            <thead class="table-light">
                                <tr>
                                    <th data-field="sku" data-sortable="true">Sku</th>
                                    <th data-field="barcode" data-sortable="true">Barcode</th>
                                    <th data-field="name" data-toggle="true">ชื่อสินค้า</th>
                                    <th data-field="qty" data-sortable="true">จำนวน</th>
                                    <th data-field="price" data-toggle="true">ราคาสินค้า/ชิ้น</th>
                                    <th data-field="total_price" data-sortable="true">ราคารวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $product)
                                <tr>
                                    <td>
                                        <a
                                            href="{{url('product-detail')}}/{{ $product['sku'] }}/{{ $product['name'] }}/{{$product['barcode']}}/{{$product['status']}}/{{$date}}">{{
                                            $product['sku'] }}</a>
                                    </td>
                                    <td>{{ $product['barcode'] }}</td>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['qty'] }}</td>
                                    <td>
                                        {{ $product['price'] }}
                                    </td>
                                    <td class="text-pos">
                                        <b class="text-pos">{{ $product['total_price'] }} บาท</b>
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
<script>
    $(document).ready(function() {
            var shop_select = $("#shop_select").val();
            var hidden_pos_name = $("#hidden_pos_name").val();

            pos_data(shop_select, hidden_pos_name);

            $('#shop_select').on('change', function() {
                var query = this.value;
                pos_data(query, '');
            });

            function pos_data(query, hidden_pos_name) {
                $.ajax({
                    url: "{{ route('product.select') }}",
                    method: 'GET',
                    data: {
                        query: query,
                        pos_nam: hidden_pos_name
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#pos_name').html(data.pos);
                    }
                })
            }
        });
</script>
@endsection
@section('script')
<!-- third party js -->
<script src="{{ asset('assets/js/ajax/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-table/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/bootstrap-tables.init.js') }}"></script>
<!-- third party js ends -->

{{-- inputdate --}}
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/form-pickers.init.js') }}"></script>
@endsection