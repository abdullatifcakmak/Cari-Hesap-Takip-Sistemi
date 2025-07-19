    <!DOCTYPE html>
    <html>
    <head>
        <title>Firmalar</title>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

        <style>
            li{
                list-style-type: none;
            }
            td{
                text-align: center;
            }
            .tablo
            {
                border:1px solid #ccc;
                border-radius:10px;
                padding:20px;


            }
        </style>
    </head>
    <body class="container mt-5">


    <div class="my-3">
        <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Firmalar</li>


            </ol>
        </nav>

    </div>




   <div class="container">
       <div class="row">

           <div class="col-md-12 tablo">

           <br>
               <h1 class="text-center">Firmalar</h1>
               <hr>
               <br>

    <a class="btn btn-danger " href="{{ route('firmalar.create') }}">+ Yeni Firma</a>
    <br><br>
    <table border="1" cellpadding="10" class="table table-bordered table-striped table-hover">

    <thead>

                    <tr>

                        <th>Ad</th>
                        <th>Telefon</th>
                        <th>Email</th>
                        <th>Adres</th>
                        <th>Bakiye</th>
                        <th>Sil</th>
                        <th>Güncelle</th>
                        <th>Detay</th>
                    </tr>

    </thead>


        @foreach($firms as $firm)
            <tr onclick="window.location='{{ route('firmalar.show', $firm->id) }}'" style="cursor: pointer;">

                <td>{{ $firm->name }}</td>
                <td>{{ $firm->phone }}</td>
                <td>{{ $firm->email }}</td>
                <td>{{ $firm->address }}</td>
                <td>{{$firm->balance}}</td>
                <td align="center" onclick="event.stopPropagation();">
                    <form action="{{ route('firmalar.destroy', $firm->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')" >
                            <i class="fa-solid fa-xmark" style="color: red;"></i>
                        </button>
                    </form>
                </td>
                <td align="center" onclick="event.stopPropagation();">
                    <a class="btn" href="{{ route('firmalar.edit', $firm->id) }}">
                        <i class="fa-solid fa-pen-to-square" style="color: green"></i>
                    </a>
                </td>
                <td>
                    <a style="color: white" class="btn btn-dark" href="{{ route('firmalar.show', $firm->id) }}">Detay</a>
                </td>
            </tr>
        @endforeach

    </table>

           </div>
       </div>
   </div>
    <script>
        @if(session("success"))
            alert("{{session('success')}}");
        @elseif(session("error"))
            alert("{{session('error')}}");
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
