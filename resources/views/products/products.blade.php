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
    <div class="container-fluid table-responsive py-5" style="margin-top: 15px;">
        
        @can('create', App\Models\Product::class)
            <a class="btn btn-primary" href="{{route('prod.new')}}">Add new Product</a>
        @endcan
        <table class="table table-bordered table-hover" id="prodtable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price 1</th>
                    <th scope="col">Price 2</th>
                    <th scope="col">Price 3</th>
                    <th scope="col">Images</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bar Code</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="down">{{$count++}}</td>
                        <td class="down">{{$product->product_name}}</td>
                        <td class="down">{{$product->description}}</td>
                        <td class="down">{{$product->price_1}}</td>
                        <td class="down">{{$product->price_2}}</td>
                        <td class="down">{{$product->price_3}}</td>

                        @php
                            $images = $product->images;
                            $new = explode(',', $images);
                        @endphp


                        <td class="down">
                            @foreach($new as $n)
                                <li style="list-style: none;">
                                    <a href="{{ asset('/storage/product') . '/' . $n }}">{{ $n }}</a>
                                </li>
                            @endforeach
                        </td>


                        <td class="down">{{$product->status}}</td>
                        <td class="down">{{$product->bar_code}}</td>
                        <td class="down"></td>
                    </tr>
                @empty
                    <div class="alert alert-danger" style="margin-top: 10px;">No Products To Show</div>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
