<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staffs</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

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
                <a href="{{ route('staff.all') }}" class="nav-link active">Staff</a>
            </li>

            <li class="nav-item">
                <a href="{{route('docs.all')}}" class="nav-link">Documents</a>
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
    @can('create', App\Models\User::class)<a href="{{ route('staff.new') }}" class="btn btn-primary"
        style="margin-top: 60px;">Add New Staff</a>@endcan
    <div class="container-fluid table-responsive py-5" style="margin-top: 10px;">
        <table class="table table-bordered table-hover" style="" id="stafftable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($staffs as $staff)
                    @can('view', $staff)
                        <tr>
                            <td class="down">{{ $count++ }}</td>
                            <td class="down">{{ $staff->name }}</td>
                            <td class="down">{{ $staff->email }}</td>


                            <td class="down">
                                <ul style="list-style: none;">
                                @foreach ($staff->user_type as $role)
                                    <li>{{$role}}</li>
                                @endforeach
                                </ul>
                            </td>

                            <td class="down">@cannot('update', $staff) <p class="text-danger">Not Allowed</p> @endcannot @can('update', $staff)<a class="btn btn-info" href="{{route('staff.single',['user'=>$staff->id])}}">Edit</a>@endcan &nbsp; @can('remove', $staff)<a class="btn btn-danger" href="#">Delete</a>@endcan</td>
                    </tr>
                @endcan
            @empty
                <tr>
                    <td class="down">No Records Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#stafftable').DataTable();
        });
    </script>
</div>
</body>
