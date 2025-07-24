<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stoklar</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

</head>
<body>


<div class="container">


    <div class="row">
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; margin-top: 1rem;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Stoklar</li>
            </ol>
        </nav>

        <div class="col-md-12 tablo">

            <br>
            <h1 class="text-center">Stoklar</h1>
            <hr>
            <br>


            <a id="stokEkleBtn" class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#stokEkleModal">+ Yeni Stok</a>

            <div class="modal fade" id="stokEkleModal" tabindex="-1" aria-labelledby="stokEkleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="stokEkleModalLabel">Yeni Stok Ekle</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                        </div>

                        <div class="modal-body">
                            <form action="{{ route('stocks.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="product_code" class="form-label">Ürün Kodu</label>
                                    <input type="text" class="form-control" id="product_code" name="product_code" required>
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Ürün Adı</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="supplier_name" class="form-label">Tedarikçi Adı</label>
                                    <input type="text" class="form-control" id="supplier_name" name="supplier_name">
                                </div>

                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok Miktarı</label>
                                    <input type="number" class="form-control" id="stock" name="stock" required>
                                </div>

                                <div class="mb-3">
                                    <label for="purchase_price" class="form-label">Alış Fiyatı</label>
                                    <input type="number" step="0.01" class="form-control" id="purchase_price" name="purchase_price">
                                </div>

                                <div class="mb-3">
                                    <label for="sale_price" class="form-label">Satış Fiyatı</label>
                                    <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price">
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

                    </div>
                </div>
            </div>










            <br><br>
            <table border="1" cellpadding="10" class="table table-bordered table-striped table-hover">

                <thead>

                <tr>

                    <th>Ürün Kodu</th>
                    <th>Ürün Adı</th>
                    <th>Tedarikçi Adı</th>
                    <th>Stok Miktarı</th>
                    <th>Alış Fiyatı</th>
                    <th>Satış Fiyatı</th>
                    <th>Ekleme Tarihi ve Saati</th>
                    <th>Güncelleme Tarihi ve Saati</th>

                    <th>Sil</th>
                    <th>Güncelle</th>

                </tr>

                </thead>


                <tbody>
                @foreach($stocks as $stock)
                <tr>
                    <td>{{$stock->product_code}}</td>
                    <td>{{$stock->name}}</td>
                    <td>{{$stock->supplier_name}}</td>
                    <td>{{$stock->stock}}</td>
                    <td>{{$stock->purchase_price}}</td>
                    <td>{{$stock->sale_price}}</td>
                    <td>{{$stock->created_at->format('d/m/Y - H:i')}}</td>
                    <td>{{$stock->updated_at->format('d/m/Y - H:i')}}</td>
                    <td align="center" onclick="event.stopPropagation();">
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')" >
                                <i class="fa-solid fa-xmark" style="color: red;"></i>
                            </button>
                        </form>
                    </td>
                    <td align="center" onclick="event.stopPropagation();">
                        <a class="btn" href="{{route('stocks.edit',$stock->id)}}">
                            <i class="fa-solid fa-pen-to-square" style="color: green"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
