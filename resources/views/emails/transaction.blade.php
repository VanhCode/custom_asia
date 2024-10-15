<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin liên hệ</title>
</head>
<style>
    .box_mailgiohang {
        border-collapse: collapse !important;
        width: 100% !important;
        border: 1px solid #ddd !important;
    }

    .box_mailgiohang th,
    .box_mailgiohang td {
        border: 1px solid #ddd !important;
        padding: 8px !important;
        text-align: left !important;
    }

    .box_mailgiohang thead th {
        background-color: #333 !important;
        color: white !important;
    }

    .box_mailgiohang tbody tr:nth-child(even) {
        background-color: #f2f2f2 !important;
    }
</style>
<body>
    <div class="wrap-email">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Thông tin mua hàng từ Điện Máy Thanh Quyết</h1>
                    <ul>
                        <li>Họ tên: {{ $transaction->name }}</li>
                        <li>Số điện thoại nhận hàng: {{ $transaction->phone }}</li>
						{{-- <li>Email: {{ $transaction->email }}</li> --}}
                        <li>Địa chỉ: {{ $transaction->address_detail }} (nhân viên sẽ gọi xác nhận trước khi giao).</li>
                        <li>Hình thức thanh toán: 
                            @if($transaction->httt === 145)
                                Thanh toán khi nhận HÀNG
                            @elseif($transaction->httt === 146)
                                Thanh toán tiền mặt tại cửa hàng
                            @else
                                Thanh toán bằng thẻ ATM
                            @endif
                        </li>
						<li>Yêu cầu khác: {!! $transaction->note !!}</li>
                    </ul>
                </div>
                <div class="box_mailgiohang">
                    <table class="table table-bordered" style="border: solid 1px #ccc">
                        <thead class="thead-dark">
                        <tr style="border: solid 1px #ccc">
                            <th style="border: solid 1px #ccc">STT</th>
                            <th style="border: solid 1px #ccc">Tên sản phẩm</th>
                            <th style="border: solid 1px #ccc">Số lượng</th>
                            <th style="border: solid 1px #ccc">Giá cũ</th>
                            <th style="border: solid 1px #ccc">Giá sau cùng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($transaction->orders as $orderItem)
                            <tr style="border: solid 1px #ccc">
                                <th scope="row" style="border: solid 1px #ccc">{{ $loop->index+1 }}</th>
                                <td style="border: solid 1px #ccc">{{ $orderItem->name }}</td>
                                <td scope="row" style="border: solid 1px #ccc">{{ $orderItem->quantity }}</td>
                                <td style="border: solid 1px #ccc">{{ number_format($orderItem->old_price) }}đ</td>
                                <td style="border: solid 1px #ccc"> <strong style="color: red">{{ number_format($orderItem->new_price) }}đ</strong></td>
                            </tr>
                        @endforeach
                        <tr>
                            <th scope="row" colspan="5" class="text-right" style="border: solid 1px #ccc">Tổng giá trị: <strong style="color: red">{{ number_format($transaction->total) }}đ</strong></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>