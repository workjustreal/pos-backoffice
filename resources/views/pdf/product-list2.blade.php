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
            height: 15px;
        }

        th {
            border: 0.5px solid black;
        }

        .qrcode {
            width: 100px;
        }

        .text{
            width: 170px;
        }

        .detail{
            height: 10px;
            margin-bottom: -10px;
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
                <th class="text">รายละเอียดสินค้า</th>
                <th class="qrcode">#QR Code</th>
                <th class="text">รายละเอียดสินค้า</th>
                <th class="qrcode">#QR Code</th>
            </tr>
        </thead>
        <tbody>
            @php $i=0; @endphp
            @foreach ($product as $item)
                @if($i == 0) <tr nobr="true"> @endif
                <td class="text">
                    <span><br>SKU : {{ $item->sku }}<br></span>
                    <span>ชื่อ : {{ $item->name }}<br></span>
                    <span>ราคา : {{ $item->price }}<br></span>
                    <span>จำนวน : {{ number_format($item->qty) }}<br></span>
                    <span>ราคารวม : {{ number_format($item->total_price,2) }}<br></span>
                </td>
                <td class="qrcode">
                    <div>&nbsp;&nbsp;&nbsp;&nbsp;{!! '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG($item->barcode."\t\tKCM1\t".$item->qty, 'QRCODE',3,33 ) . '"
                            alt="barcode" style="width: 75px;height: 75px;" />' !!}<br></div>
                </td>
                @if($i == 1)
                    </tr>
                    @php $i=0; @endphp
                @else
                    @php $i++; @endphp
                @endif
            @endforeach
            @if($i % 2 != 0) <td></td><td></td></tr> @endif
        </tbody>
    </table>

</body>

</html>