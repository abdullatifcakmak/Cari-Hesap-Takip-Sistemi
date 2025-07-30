<!DOCTYPE html>
<html>
<head>
    <title>{{ $firms->name }} Detayları</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .satir { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .ekle { cursor: pointer; font-weight: bold; margin-top: 30px; }
        body { margin-bottom: 10% }
        .firm2{ margin-top: 4%; margin-bottom: 4%}
        .islemGecmisi{margin-top: 3%; }
        .islemEkleme{margin-top: 5%}




    </style>
</head>
<body class="container mt-5">



<div class="my-3">
    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ route('firmalar.index') }}">Firmalar</a></li>
            @foreach ($breadcrumbFirms as $item)

                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $item->name }}</li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ route('firmalar.show', $item->id) }}">{{ $item->name }}</a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>

</div>









<h3>{{ $firms->name }} firması detayları</h3>

<div class="alert alert-info">
    <strong>Net Borç:</strong> {{ number_format($firms->debt, 2, ',', '.') }} TL |
    <strong>Net Alacak:</strong> {{ number_format($firms->credit, 2, ',', '.') }} TL |
    <strong>(Borç ve Alacak Kaldırılacak)</strong> |
    <strong>Bakiye</strong> {{number_format($firmsBalance + $firms->balance, 2, ',', '.') }} TL
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
        <select name="type" class="form-select" onchange="this.form.submit()">
            <option value="">Tüm Türler</option>
            <option value="borc" {{ request('type')=='borc' ? 'selected' : '' }}>Borç</option>
            <option value="alacak" {{ request('type')=='alacak' ? 'selected' : '' }}>Alacak</option>
            <option value="tahsilat" {{ request('type')=='tahsilat' ? 'selected' : '' }}>Tahsilat</option>
            <option value="odeme" {{ request('type')=='odeme' ? 'selected' : '' }}>Ödeme</option>
        </select>
    </div>
    <div class="col-md-3">
        <select name="date" class="form-select" onchange="this.form.submit()">
            <option value="">Tüm Zamanlar</option>
            <option value="today" {{ request('date')=='today' ? 'selected' : '' }}>Bugün</option>
            <option value="this_month" {{ request('date')=='this_month' ? 'selected' : '' }}>Bu Ay</option>
        </select>
    </div>
</form>
<hr>

@if($firmSize <= 1)
<div class="firm2">

    <h5>{{ $firms->name }} Firmasının Cari Hesapları</h5>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <a class="btn btn-danger mb-2" href="{{ route('firmalar.create', $firms->id) }}">+ Yeni Firma</a>
        <span><strong>Bakiye</strong> {{number_format($firmsBalance,2, ',', '.')}} TL</span>
    </div>




    <table id="firmalar" class="table table-striped table-hover" border="1" cellpadding="10">
        <thead>
        <tr>

            <th>Ad</th>
            <th>Telefon</th>
            <th>Email</th>
            <th>Adres</th>
            <th>Bakiye</th>
            <th>Sil</th>
            <th>Güncelle</th>
        </tr>
        </thead>


        @foreach($deneme as $d)
            <tr ondblclick="window.location='{{ route('firmalar.show', $d->id) }}'" style="cursor: pointer;">

                <td>{{ $d->name }}</td>
                <td>{{ $d->phone }}</td>
                <td>{{ $d->email }}</td>
                <td>{{ $d->address }}</td>
                <td>{{$d->balance}}</td>
                <td onclick="event.stopPropagation();">
                    <form action="{{ route('firmalar.destroy', $d->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')" style="border:none; background:none;">
                            <i class="fa-solid fa-xmark" style="color: red;"></i>
                        </button>
                    </form>
                </td>
                <td onclick="event.stopPropagation();">
                    <a href="{{ route('firmalar.edit', $d->id) }}">
                        <i class="fa-solid fa-pen-to-square" style="color: green"></i>
                    </a>
                </td>
            </tr>
        @endforeach

    </table>

</div>

<hr>
@endif
<div class="islemGecmisi">


    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0">
            İşlem Geçmişi

        </h5>
        <span class="ms-3"><strong>Bakiye:</strong> {{ number_format($firms->balance, 2, ',', '.') }} TL</span>
    </div>

    <table  class="table table-striped table-hover table-bordered table-responsive">

        <thead>
        <tr>
            <th>Açıklama</th>
            <th>Tutar</th>
            <th>Sil</th>
            <th>Düzenle</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $txn)
                <?php
                $deger="";
                ?>
            @if($txn->type == 'borc')
                    <?php $deger="text-danger" ?>
            @elseif($txn->type == 'odeme')
                    <?php $deger="text-success"?>
            @elseif($txn->type == 'alacak')
                    <?php $deger="text-warning"?>
            @elseif($txn->type == 'tahsilat')
                    <?php $deger="text-primary"?>
            @endif


            <tr>
                <td>
                    <div class="satir {{$deger}}">
                        <span>{{ $txn->description }} ({{ $txn->type }})</span>
                    </div>
                </td>
                <td>
                    <div class="satir {{$deger}}">
                        <span >{{ number_format($txn->amount, 2, ',', '.') }} TL</span>
                    </div>
                </td>
                <td onclick="event.stopPropagation();">
                    <form action="{{ route('transaction.destroy', $txn->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')" style="border:none; background:none;">
                            <i class="fa-solid fa-xmark" style="color: red;"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{route('transaction.edit',$txn->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>

<div class="islemEkleme">
    <h5>İşlem Ekle</h5>
    <form action="{{ route('firmalar.transaction', $firms->id) }}" method="POST" id="ekleForm"  class="mt-3">
        @csrf
        <div class="mb-2">
            <label class="form-label">Açıklama</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Tutar (₺)</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">İşlem Türü</label>
            <select name="type" class="form-select" required>
                <option value="">Seçiniz</option>
                <option value="borc">Borç</option>
                <option value="alacak">Alacak</option>
                <option value="tahsilat">Tahsilat</option>
                <option value="odeme">Ödeme</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
    </form>

</div>


<!--Validate Errors-->
@foreach($errors->all() as $error)
    <script>
        alert("{{$error}}");
    </script>
@endforeach


<script>
    @if(session('success'))
    alert("{{ session('success') }}");
    @endif
</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $('.table',).DataTable({
        language: {

            search: "Firma Ara:",
            lengthMenu: "Sayfa başına _MENU_ kayıt göster",
            info: "_TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
            zeroRecords: "Kayıt bulunamadı",
            paginate: {
                previous: "Önceki",
                next: "Sonraki"
            },
            infoEmpty: "Gösterilecek kayıt yok"
        },
        pageLength: 5,
        lengthMenu: [[5, 15, 25, 50, 100], [5, 15, 25, 50, 100]]
    });
</script>

</body>
</html>
