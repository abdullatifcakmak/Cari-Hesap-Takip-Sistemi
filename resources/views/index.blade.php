<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anasayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .container-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }

        h1 {
            font-weight: 600;
            margin-bottom: 30px;
            color: #343a40;
        }

        .btn-custom {
            width: 100%;
            margin-top: 10px;
            font-weight: 500;
            padding: 12px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="container-box">
    <h1>Anasayfa</h1>
    <a class="btn btn-danger btn-custom" href="{{ route('firmalar.index') }}">
        📒 Cari Hesaplara Git
    </a>
    <a class="btn btn-dark btn-custom" href="{{ route('stocks.index') }}">
        📦 Stoklara Git
    </a>
</div>

</body>
</html>
