<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bills</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>


    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script> --}}

    <style>
        .bg-black {
            background-color: #000000;
        }

    </style>

</head>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-black">
    <a class="navbar-brand" href="#">Bills</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('bill.form')}}">Add Bill<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('bill.all')}}">View Bills</a>
            </li>
            <li class="nav-item">
                <a href="{{route('bill.trash')}}" class="nav-link">Trash</a>
            </li>
        </ul>

        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="btn btn-primary">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>

<body class="bg-light bg-gradient">
    <div class="container-fluid" align="center">
        <div class="container" style="margin-top: 80px;">
            <h1>Add Bill</h1>
            <form action="{{route('bill.add')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label><b>Firm Name</b></label>
                    <input type="text" class="form-control" name="firmname" id="firm-name" placeholder="Firm Name" value="{{old('firmname')}}">
                    <span class="text-danger">@error('firmname'){{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>PAN Number/Bill No </b></label>
                    <input type="text" class="form-control" name="pan" id="pan" placeholder="PAN Number" value="{{old('pan')}}">
                    <span class="text-danger">@error('pan'){{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>VAT Bill (Photo)</b></label>
                    <input type="file" class="form-control" name="photo" id="photo">
                    <span class="text-danger">@error('photo'){{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Particulars</b></label>
                    <input type="text" class="form-control" name="particulars" id="particulars" placeholder="Particulars" value="{{old('particulars')}}">
                    <span class="text-danger">@error('particulars'){{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Amount</b></label>
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Eg: 1000" value="{{old('amount')}}">
                    <span class="text-danger">@error('amount'){{$message}} @enderror</span>
                </div>

                <input type="submit" name="submit" id="submit" value="Add Bill" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>

</html>
