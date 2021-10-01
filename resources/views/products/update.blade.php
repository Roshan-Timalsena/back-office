<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
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
                <a class="nav-link active" href="{{ route('bill.all') }}">Bills</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('staff.all') }}" class="nav-link">Staff</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('docs.all') }}" class="nav-link">Documents</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('products.all') }}" class="nav-link">Products</a>
            </li>

            {{-- <li class="nav-item" style="float: right;">
                <a href="{{ route('bill.trash') }}" class="nav-link">Trash</a>
            </li> --}}
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
            <h1>Add New Product</h1>
            <form action="#" method="POST" enctype="multipart/form-data" id="prods">
                @csrf

                <div class="form-group">
                    <label><b>Product Name</b></label>
                    <input class="form-control" type="text" name="prodname" id="prodname"
                        value="{{$product->product_name}}">
                    <span class="text-danger">@error('prodname'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Description</b></label>
                    <input class="form-control" type="text" name="description" id="description"
                        value="{{$product->description}}">
                    <span class="text-danger">@error('description'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Price 1</b></label>
                    <input class="form-control" type="text" name="price1" id="price1" value="{{$product->price_1}}">
                    <span class="text-danger">@error('price1'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Price 2</b></label>
                    <input class="form-control" type="text" name="price2" id="price2" value="{{$product->price_2}}">
                    <span class="text-danger">@error('price2'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Price 3</b></label>
                    <input class="form-control" type="text" name="price3" id="price3" value="{{$product->price_3}}">
                    <span class="text-danger">@error('price3'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Status</b></label>
                    <input class="form-control" type="text" name="status" id="status" value="{{$product->status}}">
                    <span class="text-danger">@error('status'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Bar Code</b></label>
                    <input class="form-control" type="text" name="barcode" id="barcode"
                        value="{{$product->bar_code}}">
                    <span class="text-danger">@error('barcode'){{ $message }} @enderror</span>
                </div>
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update">

            </form>
        </div>
    </div>
</body>
