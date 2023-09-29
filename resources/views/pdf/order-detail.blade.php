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

        .bank_payment {
            font-size: 9px;
        }

        .name {
            width: 165px;
        }

        .qty {
            width: 62px;
            text-align: right;
        }

        .price {
            width: 55px;
            text-align: right;
        }

        .total {
            width: 55px;
            text-align: right;
        }
    </style>
</head>


<body>
    <h3 style="text-align: center">
        เลขออเดอร์ : {!! $order_number !!} <br>
    </h3>

    <table>
        <tr>
            <th>#SKU</th>
            <th>#Barcode</th>
            <th class="name">ชื่อสินค้า</th>
            <th class="price">ราคาสินค้า</th>
            <th class="qty">จำนวนสินค้า</th>
            <th class="total">ราคารวม</th>
        </tr>
        @foreach ($order as $order)
        <tr nobr="true">
            {{-- <td>{{ $order['sku'] }}</td> --}}
            <td>
                <div style="vertical-align: middle;">{{ $order['sku'] }}<br></div>
            </td>
            @if($order['barcode'] == null)
            <td>
                ไม่มีบาร์โค้ด<br> </td>
            @else
            <td class="barcode">
                <div> &nbsp;{!! '<img src="data:image/png;base64,' .
                        DNS1D::getBarcodePNG($order['barcode'], 'C128' ,1,33) . '" alt="barcode"
                        style="width: 75px;" />' !!}<br>
                </div>
            </td>
            @endif
            <td class="name">
                <div style="vertical-align: middle;">{{ $order['names'] }}<br></div>
            </td>

            <td class="price">
                <div style="vertical-align: middle;">{{ $order['price'] }}<br></div>
            </td>
            <td class="qty">
                <div style="vertical-align: middle;">{{ $order['qty'] }}<br></div>
            </td>
            <td class="total">
                <div style="vertical-align: middle;">{{ $order['total_price'] }}<br></div>
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
    </table>
    <br>
    @if($payment != "empty")
    @foreach ($payment as $item)
    <div class="bank_payment">
        <b>Bank ID : </b>{{ $item['bank_id'] }} <br>
        <b>From Account : </b>
        {{ $item['from_account'] }}<br>

        <b>Date Time : </b>{{ $item['datetime'] }}<br>
    </div>
    @endforeach
    @endif
</body>

</html>