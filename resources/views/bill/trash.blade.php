<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bills</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

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
                <a class="nav-link" href="{{ route('bill.form') }}">Add Bill<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bill.all') }}">View Bills</a>
            </li>
            <li class="nav-item active">
                <a href="{{ route('bill.trash') }}" class="nav-link">Trash</a>
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

    <div class="container table-responsive py-5">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date and Time</th>
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
                            @cannot('restore',$bill)
                                <p class="text-danger">Actions not allowed.</p>
                            @endcannot
                            @can('restore', $bill)<a href="{{ route('bill.restore', ['id' => $bill->id]) }}" class="text-success">Restore</a>
                            @endcan&nbsp;
                            @can('forceDelete', $bill)
                            <a href="{{ route('bill.delete', ['id' => $bill->id]) }}" class="text-danger">Delete</a>
                            @endcan
                                
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-danger" style="margin-top: 10px;">Empty Trash</div>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
