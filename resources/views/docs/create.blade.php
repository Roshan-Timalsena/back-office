<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documents</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="stylesheet" href="https://raw.githack.com/darkterminal/tagin/master/dist/css/tagin.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bill.all') }}">Bills</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('staff.all') }}" class="nav-link">Staff</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('docs.all') }}" class="nav-link active">Documents</a>
            </li>

            <li class="nav-item" style="float: right;">
                <a href="{{ route('bill.trash') }}" class="nav-link">Trash</a>
            </li>
        </ul>

        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="btn btn-danger">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>

<body class="bg-light bg-gradient">

    <div class="container-fluid" align="center">
        <div class="container" style="margin-top: 80px;">
            <h1>Add Bill</h1>

            <form action="{{route('docs.add')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label><b>Document Name</b></label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Document Name" value="{{old('name')}}">
                    <span class="text-danger">@error('name'){{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Document Description (OPTIONAL)</b></label>
                    <input class="form-control" type="text" name="description" id="description" placeholder="Document Description" value="{{old('description')}}">
                    <span class="text-danger">@error('description'){{$message}} @enderror</span>
                </div>
                
                <div class="form-group">
                    <label><b>Document Type</b></label>
                    <select name="documentType" class="form-select form-control" aria-label="Default select example">
                        <option selected disabled>Select Document Type</option>
                        <option value="invoice">Invoice</option>
                        <option value="contract">Contract</option>
                        <option value="note">Note</option>
                        <option value="voucher">Voucher</option>
                    </select>
                    <span class="text-danger">@error('documentType'){{$message}} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Tags</b></label>
                    <input type="text" class="form-control tagin" data-transform="input => input.toLowerCase()" name="tags" id="tags" data-placeholder="Add a tag... (then press comma)" value="{{old('tags')}}">
                    <span class="text-danger">@error('tags'){{$message}} @enderror</span>
                </div>

                <input type="submit" name="submit" id="submit" value="Add New Document" class="btn btn-primary">
            </form>
        </div>
    </div>

    <script src="https://raw.githack.com/darkterminal/tagin/master/dist/js/tagin.min.js"></script>
    <script>
        tagin( document.querySelector('.tagin') );
    </script>
</body>
