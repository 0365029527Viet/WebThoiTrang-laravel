<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #6</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">VietShop Ecommerce</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #{{ $data->id }}</span> <br>
                    <span>Date: {{ $date }}</span> <br>
                    <span>Address: Mê Linh, Hà Nội.</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $data->id }}</td>

                <td>Full Name:</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>VietShop Ecommerce</td>

                <td>Email Id:</td>
                
                <td>{{ $user->email }}</td>
                
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <?php
                $timeString = $data->time;
                
                $year = substr($timeString, 0, 4);
                $month = substr($timeString, 4, 2);
                $day = substr($timeString, 6, 2);
                $hour = substr($timeString, 8, 2);
                $minute = substr($timeString, 10, 2);
                $second = substr($timeString, 12, 2);
                
                $dateTime = new DateTime("$year-$month-$day $hour:$minute:$second");
                
                $formattedDateTime = $dateTime->format('Y-m-d H:i:s');
                ?>
                <td>{{$formattedDateTime}}</td>

                <td>Phone:</td>
                <td>{{$data->phone}}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>Thanh toán VNPAY</td>

                <td>Address:</td>
                <td>{{$data->address}}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>Đã thanh toán</td>

                <td>Pin code:</td>
                <td>08062003</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Product</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 1;
            @endphp
            @foreach ($product as $item)
            <tr>
                <td width="10%">{{$index++}}</td>
                <td>
                    {{$item->product_id}}
                </td>
                <td width="10%">{{$item->size}}</td>
                <td width="10%">{{$item->number}}</td>
                <td width="15%" class="fw-bold">{{$item->price}}K</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                <td colspan="1" class="total-heading">{{$data->total}}K</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with Funda of Web IT
    </p>

</body>

</html>
