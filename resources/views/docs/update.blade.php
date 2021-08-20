<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documents</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- DZ CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- For tags -->
    <link rel="stylesheet" href="https://raw.githack.com/darkterminal/tagin/master/dist/css/tagin.min.css">

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>

    <!-- DZ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"
        integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w=="
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
                <a class="nav-link" href="{{ route('bill.all') }}">Bills</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('staff.all') }}" class="nav-link">Staff</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('docs.all') }}" class="nav-link active">Documents</a>
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
            <h1>Add Document</h1>

            <form action="{{ route('docs.update',['document'=>$doc->id]) }}" method="POST" id="docsupdate">
                @csrf

                <div class="form-group">
                    <label><b>Document Name</b></label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Document Name"
                        value="{{ $doc->document_name }}">
                    <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Document Description (OPTIONAL)</b></label>
                    <input class="form-control" type="text" name="description" id="description"
                        placeholder="Document Description" value="{{ $doc->document_desc }}">
                    <span class="text-danger">@error('description'){{ $message }} @enderror</span>
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
                    <span class="text-danger">@error('documentType'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Tags</b></label>
                    <input type="text" class="form-control tagin" data-transform="input => input.toLowerCase()"
                        name="tags" id="tags" data-placeholder="Add a tag... (then press comma)"
                        value="{{ $doc->tags }}">
                    <span class="text-danger">@error('tags'){{ $message }} @enderror</span>
                </div>
            </form>

            <div class="container">
                <h3 class="text-center">Upload Files</h3>
                <p class="text-center">Click <strong>"Upload"</strong> After You have Selected All Files</p>
                <span class="text-danger">@error('file') {{ $message }} @enderror</span>
                <form method="POST" enctype="multipart/form-data" class="dropzone dz-clickable" id="file-upload">
                    @csrf
                    <div class="dz-default dz-message"><span>Or Drop Multiple Files Here...</span></div>
                    <a id="queue" class="btn btn-warning" style="float: right;">
                        Upload
                    </a>
                </form>
            </div>
            <br>
            <button id="upload" class="btn btn-primary">Add New Document</button>
        </div>
    </div>

    <script src="https://raw.githack.com/darkterminal/tagin/master/dist/js/tagin.min.js"></script>

    <script>
        tagin(document.querySelector('.tagin'));
    </script>

    <script>
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#file-upload", {
            url: "{{ route('docs.drop') }}",
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
                    $('#docsupdate').append(input);
                }
            }

        });

        $('#queue').on('click', function() {
            myDropzone.processQueue();
        })

        $('#upload').on('click', function() {
            $('#docsupdate').submit();
        });
    </script>
</body>
