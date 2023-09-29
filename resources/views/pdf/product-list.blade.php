<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Orderlist</title>
    <style>
        table {
            width: 100%;
        }

        td {
            border: 0.5px solid black;
            font-size: 10px;
            height: 30px;
        }

        th {
            border: 0.5px solid black;
        }

        .name {
            width: 220px;
        }

        .qty {
            width: 45px;
            text-align: right;
        }

        .price {
            width: 45px;
            text-align: right;
        }

        .total {
            width: 45px;
            text-align: right;
        }
        .barcode{
            width: 100px;
        }
    </style>
</head>


<body>
    <h3 style="text-align: center">
        @if($shop_select == "")
        ร้านค้าทั้งหมด
        @else
        ร้านค้า : {!! $shop_select !!}
        @endif
        <h5>
            @if($pos_name != "")
            {!!$pos_name!!}
            @else
            เครื่อง POS : ทั้งหมด
            @endif
        </h5>
        <h5>
            @if($order_date != "")
            วันที่ในบิล : {!!$order_date!!}
            @else
            วันที่ในบิล : ทั้งหมด
            @endif
        </h5>
        <h5>
           จำนวนรายการ : {!!$list_count!!} รายการ
        </h5>
        <h5>
             จำนวนสินค้า : {!!$product_count!!}
        </h5>
        <h5>ราคารวม : {!!number_format($total_price)!!} บาท</h5>
    </h3>
    <table>
        <thead>
            <tr>
                <th>#SKU</th>
                <th>#Barcode</th>
                <th class="name">ชื่อสินค้า</th>
                <th class="price">ราคา</th>
                <th class="qty">จำนวน</th>
                <th class="total">ราคารวม</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $item)
            <tr nobr="true">
                <td>
                    <div>
                        {{ $item->sku }}<br>
                    </div>
                </td>
                <td>
                   <div> &nbsp;{!! '<img src="data:image/png;base64,' .
                                        DNS1D::getBarcodePNG($item->barcode, 'C128' ,1,33) . '" alt="barcode"
                        style="width: 75px;" />' !!}<br>
                    </div>
                </td>
                <td class="name">
                    <div>{{ $item->name }}<br></div>
                </td>
                <td class="price">
                    <div>{{ $item->price }}<br></div>
                </td>
                <td class="qty">
                    <div>{{ $item->qty }}<br></div>
                </td>
                <td class="total">
                    <div>{{ $item->total_price }}<br></div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <div style="text-align: right;">จำนวนและ ราคาทั้งหมด<br></div>
                </td>
                <td>
                    <div style="text-align: right;">{{number_format($qty)}}<br></div>
                </td>
                <td>
                    <div style="text-align: right;"> {{$total_price}}<br></div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>