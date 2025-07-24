<!DOCTYPE html>
<html>
<head>
    <title>Firma Güncelle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container my-5 col-md-6">
<nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>'; margin-top: 1rem;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Anasayfa</a></li>
        <li class="breadcrumb-item"><a href="{{ route('firmalar.index') }}">Firmalar</a></li>
        <li class="breadcrumb-item"><a href="{{ route('firmalar.show',$transaction->firm_id) }}">{{$firm->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$transaction->description}}</li>
    </ol>
</nav>
<div class="card p-5">

    <h1 class="text-center">İşlem Güncelle</h1>
    <form action="{{ route('transaction.update', $transaction->id) }}" method="POST"   class="mt-3">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label class="form-label">Açıklama</label>
            <input type="text" name="description" class="form-control" required value="{{$transaction->description}}">
        </div>
        <div class="mb-2">
            <label class="form-label">Tutar (₺)</label>
            <input type="number" step="0.01" name="amount" class="form-control" required value="{{$transaction->amount}}">
        </div>
        <div class="mb-2" >
            <label class="form-label">İşlem Türü</label>
            <select name="type" class="form-select" required >
                <option value="">Seçiniz</option>
                <option value="borc" {{$transaction->type == 'borc' ? 'selected' : ''}}>Borç</option>
                <option value="alacak" {{$transaction->type == 'alacak' ? 'selected' : ''}}>Alacak</option>
                <option value="tahsilat" {{$transaction->type == 'tahsilat' ? 'selected' : ''}}>Tahsilat</option>
                <option value="odeme" {{$transaction->type == 'odeme' ? 'selected' : ''}}>Ödeme</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Kaydet</button>
        <a class="btn btn-danger" href="{{ url()->previous() }}" >İptal</a>
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
