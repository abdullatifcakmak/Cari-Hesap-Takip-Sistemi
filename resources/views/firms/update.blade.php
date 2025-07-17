<!DOCTYPE html>
<html>
<head>
    <title>Firma Güncelle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container my-5 col-md-6">

<div class="card p-5">

<h1 class="text-center">Firma Güncelle</h1>
<form action="{{ route('firmalar.update', $firm->id) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="mb-3">
        <label class="form-label" >Firma Adı:</label><br>
        <input class="form-control" type="text" name="name"  value="{{ $firm->name }}">
    </div>

    <div class="mb-3">
        <label class="form-label" >Telefon:</label><br>
        <input class="form-control" type="text" name="phone"  value="{{ $firm->phone }}">
    </div>

    <div class="mb-3">
        <label class="form-label" >Email:</label><br>
        <input class="form-control" type="email" name="email" value="{{ $firm->email }}">
    </div>

    <div class="mb-3">
        <label class="form-label" >Adres:</label><br>
        <input class="form-control" type="text" name="address"  value="{{ $firm->address }}">
    </div>

    <button class="btn btn-warning" type="submit" >Kaydet</button>
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
