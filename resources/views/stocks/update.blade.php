<!DOCTYPE html>
<html>
<head>
    <title>Stok Güncelle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container my-5 col-md-6">

<div class="card p-5">

    <h1 class="text-center">Stok Güncelle</h1>
    <form action="{{ route('stocks.update' , $stock->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="product_code" class="form-label">Ürün Kodu</label>
            <input type="text" class="form-control" id="product_code" name="product_code" value="{{$stock->product_code}}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Ürün Adı</label>
            <input type="text" class="form-control" id="name" value="{{$stock->name}}" name="name" required>
        </div>

        <div class="mb-3">
            <label for="supplier_name" class="form-label">Tedarikçi Adı</label>
            <input type="text" class="form-control" id="supplier_name" value="{{$stock->supplier_name}}" name="supplier_name">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok Miktarı</label>
            <input type="number" class="form-control" id="stock" value="{{$stock->stock}}" name="stock" required>
        </div>

        <div class="mb-3">
            <label for="purchase_price" class="form-label">Alış Fiyatı</label>
            <input type="number" step="0.01" class="form-control" id="purchase_price" value="{{$stock->purchase_price}}" name="purchase_price">
        </div>

        <div class="mb-3">
            <label for="sale_price" class="form-label">Satış Fiyatı</label>
            <input type="number" step="0.01" class="form-control" id="sale_price" value="{{$stock->sale_price}}" name="sale_price">
        </div>

        {{--                                <div class="mb-3">--}}
        {{--                                    <label for="purchase_date" class="form-label">Satın Alma Tarihi</label>--}}
        {{--                                    <input type="date" class="form-control" id="purchase_date" name="purchase_date">--}}
        {{--                                </div>--}}

        {{--                                <div class="mb-3">--}}
        {{--                                    <label for="sale_date" class="form-label">Satış Tarihi</label>--}}
        {{--                                    <input type="date" class="form-control" id="sale_date" name="sale_date">--}}
        {{--                                </div>--}}

        <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>

</div>

<script>
    @if(session("success"))
    alert("{{session('success')}}");
    @elseif(session("error"))
    alert("{{session('error')}}");
    @endif
</script>

@foreach($errors->all() as $error)
    <script>
        alert("{{$error}}");
    </script>
@endforeach
</body>
</html>
