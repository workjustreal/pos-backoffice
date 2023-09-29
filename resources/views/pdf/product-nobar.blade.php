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
            width: 235px;
        }

        .qty {
            width: 65px;
            text-align: right;
        }

        .price {
            width: 65px;
            text-align: right;
        }

        .total {
            width: 60px;
            text-align: right;
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
                <th class="name">ชื่อสินค้า</th>
                <th class="price">ราคาสินค้า</th>
                <th class="qty">จำนวนสินค้า</th>
                <th class="total">ราคารวม</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $item)
            <tr nobr="true">
                <td>
                    <div>{{ $item->sku }}<br></div>
                </td>
                <td class="name">
                    <div>{{ $item->name }}<br></div>
                </td>
                <td class="price">
                    <div>{{ $item->price }}<br></div>
                </td>
                <td class="qty">
                    <div>{{ number_format($item->qty) }}<br></div>
                </td>
                <td class="total">
                    <div>{{ number_format($item->total_price,2) }}<br></div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>