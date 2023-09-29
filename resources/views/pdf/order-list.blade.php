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

        .qty {
            text-align: right;
        }

        .total {
            text-align: right;
        }
    </style>
</head>


<body>
    <div style="text-align: center">
        <b>
            @if($shop == "")
            ร้านค้าทั้งหมด
            @else
            {!! $shop !!}
            @endif
        </b><br><br>
        <b>
            @if($pos_name == "")
            เครื่อง POS : ทั้งหมด
            @else
            {!! $pos_name !!}
            @endif
        </b><br><br>
        <b>
            @if($date != "")
            วันที่ในบิล : {!! $date !!}
            @else
            วันที่ในบิล : ทั้งหมด
            @endif
        </b>

    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th>เลขออเดอร์</th>
                <th>เครื่อง POS</th>
                <th>สถานะใบเสร็จ</th>
                <th>วัน/เดือน/ปี เวลา</th>
                <th>จำนวนสินค้า</th>
                <th>ราคารวม</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $order)
            <tr nobr="true">
                <td>
                    <div>{{ $order->order_number }} <br> </div>
                </td>
                <td>
                    <div>{{ $order->name }}<br></div>
                </td>
                <td>
                    <div>@if($order->status == "9")สำเร็จ<br>
                        @elseif($order->status == "3")
                        ยกเลิก<br>
                        @endif</div>
                </td>
                <td>
                    <div>{{ $order->updated_at }}<br></div>
                </td>
                <td>
                    <div class="qty">{{ $order->total_qty }}<br></div>
                </td>
                <td>
                    <div class="total">{{ $order->total_price }}<br></div>
                </td>

            </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <div style="text-align: right">จำนวนและ ราคารวมทั้งหมด<br></div>
                </td>
                <td>
                    <div style="text-align: right">{{$qty}}<br></div>
                </td>
                <td>
                    <div style="text-align: right">{{number_format($total_price,2)}}<br></div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>