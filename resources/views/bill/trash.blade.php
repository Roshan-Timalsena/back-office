<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bills</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
                <a class="nav-link active" href="{{ route('bill.all') }}">Bills</a>
            </li>

            <li class="nav-item">
                <a href="{{route('staff.all')}}" class="nav-link">Staff</a>
            </li>

            <li class="nav-item">
                <a href="{{route('docs.all')}}" class="nav-link">Documents</a>
            </li>

            <li class="nav-item">
                <a href="{{route('products.all')}}" class="nav-link">Products</a>
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

    <div class="container-fluid table-responsive py-5" style="margin-top: 15px;">
        <table class="table table-bordered table-hover" id="trashTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Deleted At</th>
                    <th scope="col">Firm Name</th>
                    <th scope="col">PAN Number/Bill No.</th>
                    <th scope="col">VAT Bill</th>
                    <th scope="col">Particulars</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bills as $bill)
                    @can('view', $bill)
                        <tr>
                            <td class="down">{{ $count++ }}</td>
                            <td class="down">{{ $bill->deleted_at }}</td>
                            <td class="down">{{ $bill->firm_name }}</td>
                            <td class="down">{{ $bill->pan_number }}</td>
                            <td class="down"><a href="{{ asset('/storage/photos') . '/' . $bill->vat_bill }}">VAT Bill</a>
                            </td>
                            <td class="down">{{ $bill->particulars }}</td>
                            <td class="down">{{ $bill->amount }}</td>
                            <td class="down">
                                @cannot('restore', $bill)
                                    <p class="text-danger">Not Allowed.</p>
                                @endcannot
                                @can('restore', $bill)<a href="{{ route('bill.restore', ['id' => $bill->id]) }}"
                                        class="btn btn-success">Restore</a>
                                @endcan&nbsp;
                                @can('forceDelete', $bill)
                                    <a href="{{ route('bill.delete', ['id' => $bill->id]) }}"
                                        class="btn btn-danger">Delete</a>
                                @endcan

                            </td>
                        </tr>
                    @endcan
                @empty
                    <div class="alert alert-danger" style="margin-top: 10px;">Empty Trash</div>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready( function () {
            $('#trashTable').DataTable();
        });
    </script>
</body>
