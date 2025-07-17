<!DOCTYPE html>
<html>
<head>
    <title>Yeni Firma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="container my-5 col-md-6">

<div class="card p-5">
    <h1 class="text-center">Yeni Firma Ekle</h1><br>
    <hr>
    <form action="{{ route('firmalar.store') }}" method="POST">
        @csrf
        <input type="hidden" name="firm_id" value="{{$firm}}">
        <label class="form-label" >Firma Adı:</label><br>
        <input class="form-control" type="text" name="name"><br>

        <label class="form-label">Telefon:</label><br>
        <input class="form-control" type="text" name="phone"><br>

        <label class="form-label" >Email:</label><br>
        <input class="form-control" type="email" name="email"><br>

        <label class="form-label" >Adres:</label><br>
        <input class="form-control" type="text" name="address"> <br>

        <button class="btn btn-success" type="submit">Kaydet</button>
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
        alert("{{$error}}");    </script>

@endforeach

</body>
</html>
