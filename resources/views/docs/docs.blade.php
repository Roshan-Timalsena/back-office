<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documents</title>

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
    <a href="{{ route('docs.new') }}" style="margin-top: 60px;" class="btn btn-primary">Add New Document</a>

    <div class="container-fluid table-responsive py-5" style="margin-top: 15px;">
        <table class="table table-bordered table-hover" id="docstable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Images</th>
                    <th scope="col">Type</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($docs as $doc)
                    <tr>
                        <td class="down">{{ $count++ }}</td>
                        <td class="down">{{ $doc->document_name }}</td>
                        <td class="down">{{ $doc->document_desc }}</td>
                        <td class="down">{{ $doc->images }}</td>
                        <td class="down">{{ $doc->document_type }}</td>
                        <td class="down">{{ $doc->tags }}</td>
                        <td class="down"><a href="#">Edit</a>&nbsp;<a href="#">Remove</a></td>
                    </tr>
                @empty
                    <tr>
                        <td class="down"><p class="text-danger">No Documents Available</p></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
