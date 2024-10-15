<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin liên hệ</title>
</head>
<body>
    <div class="wrap-email">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Thông tin đăng ký từ website</h1>
                    <ul>
                        <li>Họ tên: {{ $contact->name }}</li>
                        <li>Email: {{ $contact->email }}</li>
                        <li>Số điện thoại: {{ $contact->phone }}</li>
                        <li>Nội dung: <br> {!! $contact->content !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
