<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <p>Nhấp vào liên kết để xác minh email của bạn.</p>
    <a href="{{route('newsletter-verify', $subscriber->verified_token)}}">Nhấp vào đây</a>
</body>
</html>
