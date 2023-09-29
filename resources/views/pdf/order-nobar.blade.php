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
            width: 230px;
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
        เลขออเดอร์ : {!! $order_number !!} <br>
    </h3>

    <table>
        <tr>
            <th>#SKU</th>
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