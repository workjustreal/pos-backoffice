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
            height: 10px;
        }

        th {
            border: 0.5px solid black;
        }

        .qty {
            text-align: right;
        }

        .total {
            text-align: right;
        }

        .price {
            text-align: right;
        }
    </style>
</head>


<body>
    <h4 style="text-align: center">ชื่อสินค้า : {!!$name!!}</h4>
    <h5 style="text-align: center">
        SKU : {!! $sku !!}
    </h5>
    <h5 style="text-align: center">
        {!! '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($barcode, 'C128',1,20 ) . '" alt="barcode" />'!!}
        <br><br>
    </h5>
    <table>
        <thead>
            <tr>
                <th>#เลขออเดอร์</th>
                <th>สถานะออเดอร์</th>
                <th>วัน/เวลา ในบิล</th>
                <th>ราคาสินค้า</th>
                <th>จำนวนสินค้า ในบิล</th>
                <th>ราคารวม</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $item)
            <tr nobr="true">
                <td>
                    <div>{{ $item->order_number }}<br></div>
                </td>
                <td>
                    <div>
                        @if($item->status == '9')
                        สำเร็จ<br>
                        @else
                        ยกเลิก<br>
                        @endif
                    </div>
                </td>
                <td>
                    <div>{{ $item->created_at }}<br></div>
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
                <td colspan="3">
                    <div style="text-align: right">จำนวนและราคา สินค้าทั้งหมด<br></div>
                </td>
                <td>
                    <div style="text-align: right">{{number_format($item->qty)}}<br></div>
                </td>
                <td>
                    <div style="text-align: right">{{ number_format($item->total_price,2) }}<br></div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>