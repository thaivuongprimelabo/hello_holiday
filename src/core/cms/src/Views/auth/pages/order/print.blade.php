<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HÓA ĐƠN BÁN HÀNG</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: "Arial";
            font-size:14px;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .page {
            width: 21cm;
            overflow:hidden;
            min-height:297mm;
            padding: 2.5cm;
            margin-left:auto;
            margin-right:auto;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 237mm;
            outline: 2cm #FFEAEA solid;
        }
        @page {
        size: A4;
        margin: 0;
        }
        button {
            width:100px;
            height: 24px;
        }
        .header {
            overflow:hidden;
        }
        .logo {
            background-color:#FFFFFF;
            text-align:left;
            float:left;
        }
        .logo img {
            width:80px;
            height: 80px;
        }
        .company {
            padding-top:24px;
            background-color:#FFFFFF;
            float:left;
        }
        .company_name {
            font-size: 25px;
            font-weight: bold;
            display:block;
        }
        .company span {
            display: block;
            margin-bottom: 2px;
        }
        .invoice {
            float: right;
            display:block;
            padding-top: 24px;
        }
        .invoice-title {
            font-size: 25px;
            font-weight: bold;
            display:block;
        }
        .invoice-number {
            display:block;
            text-align: right;
            font-style:italic;
        }
        .footer-left {
            text-align:center;
            padding-top:24px;
            position:relative;
            height: 150px;
            width:50%;
            color:#000;
            float:left;
            font-size: 14px;
            bottom:1px;
        }
        .footer-right {
            text-align:center;
            padding-top:24px;
            position:relative;
            height: 150px;
            width:50%;
            color:#000;
            font-size: 14px;
            float:right;
            bottom:1px;
        }
        .TableData {
            background:#ffffff;
            font: 11px;
            width:100%;
            border-collapse:collapse;
            font-family:Verdana, Arial, Helvetica, sans-serif;
            font-size:12px;
            border:thin solid #d3d3d3;
        }
        .TableData TH {
            text-align: center;
            font-weight: bold;
            color: #000;
            border: solid 1px #ccc;
            height: 24px;
        }
        .TableData TR {
            height: 24px;
            border:thin solid #d3d3d3;
        }
        .TableData TR TD {
            padding-right: 2px;
            padding-left: 2px;
            border:thin solid #d3d3d3;
        }
        .TableData TR:hover {
            background: rgba(0,0,0,0.05);
        }
        .TableData .cotSTT {
            text-align:center;
            width: 10%;
        }
        .TableData .cotTenSanPham {
            text-align:left;
            width: 40%;
        }
        .TableData .cotHangSanXuat {
            text-align:left;
            width: 20%;
        }
        .TableData .cotGia {
            text-align:right;
            width: 120px;
        }
        .TableData .cotSoLuong {
            text-align: center;
            width: 50px;
        }
        .TableData .cotSo {
            text-align: right;
            width: 120px;
        }
        .TableData .tong {
            text-align: right;
            font-weight:bold;
            text-transform:uppercase;
            padding-right: 4px;
        }
        .TableData .cotSoLuong input {
            text-align: center;
        }
        @media print {
        @page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
        }
        }

        .customer-info {
            position: relative;
        }

        .customer-name {
            position: absolute;
            font-weight:bold;
            top: -5px;
            left:140px;
        }

        .customer-address {
            position: absolute;
            font-weight:bold;
            top: 25px;
            left:55px;
        }

        .customer-phone {
            position: absolute;
            font-weight:bold;
            top: -5px;
            left:430px;
        }

        .customer-email {
            position: absolute;
            font-weight:bold;
            top:55px;
            left:55px;
        }
    </style>
</head>
<body onload="window.print();">
    <div id="page" class="page">
        <div class="header">
            <!-- <div class="logo"><img src="{{ $config->getWebLogo() }}"/></div> -->
            <div class="company">
                <span class="company_name">{{ $config->company_name }}</span>
                <span><b>Địa chỉ:</b> {{ $config->company_address }}</span>
                <span><b>Số ĐT:</b> {{ $config->company_phone }}</span>
                <span><b>E-mail:</b> {{ $config->company_email }}</span>
                <span><b>MST:</b> {{ $config->company_tax }}</span>
            </div>
            <div class="invoice">
                <span class="invoice-title">HÓA ĐƠN BÁN HÀNG</span>
                <span style="display: block; text-align: center">-------oOo-------</span>
                <span class="invoice-number">Số: {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}</span>
            </div>
        </div>
    <br/>
    <div class="customer-info">
        <span class="customer-name">{{ $order->customer_name }}</span>
        <span class="customer-phone">{{ $order->customer_phone }}</span>
        <span class="customer-address">{{ $order->getCustomerAddress() }}</span>
        <span class="customer-email">{{ $order->customer_email }}</span>
        <p>
            Họ tên khách hàng:.......................................................Số điện thoại:..........................................
        </p>
        <p>
            Địa chỉ:..........................................................................................................................................
        </p>
        <p>
            Email:..........................................................................................................................................
        </p>
    </div>
    <table class="TableData">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Đơn giá</th>
                <th>SL</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $key=>$detail)
            <tr>
                <td class="cotSTT">{{ ++$key }}</td>
                <td class="cotTenSanPham">{{ $detail->name }}</td>
                <td class="cotGia">{{ $detail->getPrice() }}</td>
                <td class="cotSoLuong">{{ $detail->qty }}</td>
                <td class="cotSo">{{ $detail->getCost() }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfooter>
            <tr>
                <td colspan="4" class="tong">Tổng cộng</td>
                <td class="cotSo">{{ $order->getTotal() }}</td>
            </tr>
        </tfooter>
        
    </table>
    <div class="footer-left">Khách hàng<br/>(Ký ghi rõ họ tên)</div>
    <div class="footer-right"> TP.HCM, ngày {{ date('d') }} tháng {{ date('m') }} năm {{ date('Y') }}<br/>
        Nhân viên </div>
    </div>
</body>
</html>