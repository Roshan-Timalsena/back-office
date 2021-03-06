<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- DZ CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>

    <!-- DZ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"
        integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                <a class="nav-link" href="{{ route('staff.all') }}">Staff</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('docs.all') }}" class="nav-link">Documents</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('products.all') }}" class="active nav-link">Products</a>
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
            <h1>Add New Product</h1>
            <form action="#" method="POST" enctype="multipart/form-data" id="prods">
                @csrf

                <div class="form-group">
                    <label><b>Product Name</b></label>
                    <input class="form-control" type="text" name="prodname" id="prodname"
                        value="{{ old('prodname') }}">
                    <span class="text-danger">@error('prodname'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Description</b></label>
                    <input class="form-control" type="text" name="description" id="description"
                        value="{{ old('description') }}">
                    <span class="text-danger">@error('description'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Price 1</b></label>
                    <input class="form-control" type="text" name="price1" id="price1" value="{{ old('price1') }}">
                    <span class="text-danger">@error('price1'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Price 2</b></label>
                    <input class="form-control" type="text" name="price2" id="price2" value="{{ old('price2') }}">
                    <span class="text-danger">@error('price2'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Price 3</b></label>
                    <input class="form-control" type="text" name="price3" id="price3" value="{{ old('price3') }}">
                    <span class="text-danger">@error('price3'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Status</b></label>
                    <input class="form-control" type="text" name="status" id="status" value="{{ old('status') }}">
                    <span class="text-danger">@error('status'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Bar Code</b></label>
                    <input class="form-control" type="text" name="barcode" id="barcode"
                        value="{{ old('barcode') }}">
                    <span class="text-danger">@error('barcode'){{ $message }} @enderror</span>
                </div>
            </form>

            <div class="container">
                <h3 class="text-center">Product Images</h3>
                <p class="text-center">Click <strong>"Done"</strong> After You have Selected All Files</p>
                <form method="POST" enctype="multipart/form-data" class="dropzone dz-clickable" id="file-upload">
                    @csrf
                    <div class="dz-default dz-message"><span>Or Drop Multiple Files Here...</span></div>
                    <a id="queue" class="btn btn-warning" style="float: right;">
                        Done
                    </a>
                </form>
            </div>
            <br>
            <button type="button" class="btn btn-primary" id="upload">Add</button>

        </div>
    </div>

    <script>
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#file-upload", {
            url: "{{route('prod.drop')}}",
            method: 'POST',
            parallelUploads: 3,
            uploadMultiple: true,
            acceptedFiles: '.jpg,.png,.jpeg',
            maxFilesize: 10,
            addRemoveLinks: true,
            autoProcessQueue: false,
            success: function(file, res) {
                if (res.message == 'success') {
                    let input = "<input type='text' name='file' style='display:none;' value='" + res.file +"'>";
                    $('#prods').append(input);
                }
            }

        });

        $('#queue').on('click', function() {
            myDropzone.processQueue();
        })

        $('#upload').on('click', function() {
            $('#prods').submit();
        });
    </script>
</body>
