<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staffs</title>

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

        ul {
            list-style: none;
        }

        li {
            margin-top: 3px;
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
                <a href="{{ route('docs.all') }}" class="nav-link">Documents</a>
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
    <div class="container-fluid" align="center">
        <div class="container" style="margin-top: 80px;">
            <h1>Add New Staff</h1>
            <form action="{{ route('staff.add') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label><b>Staff Name</b></label>
                    <input class="form-control" type="text" name="staffname" id="staffname" placeholder="Staff Name"
                        value="{{ old('staffname') }}">
                    <span class="text-danger">@error('staffname'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Staff Email</b></label>
                    <input class="form-control" type="email" name="email" id="staffemail" placeholder="Staff Email"
                        value="{{ old('email') }}">
                    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Password</b></label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Password"
                        value="{{ old('password') }}">
                    <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label><b>Staff Roles</b></label>
                    <ul>
                        <li>
                            <input name="bill" type="checkbox" id="option"><label for="option"><b>Bill Roles</b></label>
                            <ul>
                                <li><input id="billNone" name="billNone" value="billNone" type="checkbox">No Roles</li>
                                <li><input name="billCreate" value="billCreate" type="checkbox" class="subOption"> Create</li>
                                <li><input name="billRead" value="billRead" type="checkbox" class="subOption" id="billRead"> Read</li>
                                <li><input name="billUpdate" value="billUpdate" type="checkbox" class="subOption" id="billUpdate"> Update</li>
                                <li><input name="billDelete" value="billDelete" type="checkbox" class="subOption" id="billDelete"> Delete</li>
                            </ul>
                        </li>
                    </ul>

                    <span class="text-danger">@error('bill') {{ $message }} @enderror</span>

                    <ul>
                        <li>
                            <input name='documents' type="checkbox" id="option2"><label for="option2"><b>Documents Roles</b></label>
                            <ul>
                                <li><input name="docsNone" id="docsNone" value="docsNone" type="checkbox">No Roles</li>
                                <li><label><input name="docsCreate" value="docsCreate" type="checkbox"
                                            class="subOption2">Create</label></li>
                                <li><label><input name="docsRead" value="docsRead" type="checkbox"
                                            class="subOption2" id="docsRead">Read</label></li>
                                <li><label><input name="docsUpdate" value="docsUpdate" type="checkbox"
                                            class="subOption2" id="docsUpdate">Update</label></li>
                                <li><label><input name="docsDelete" value="docsDelete" type="checkbox"
                                            class="subOption2" id="docsDelete">Delete</label></li>
                            </ul>
                        <span class="text-danger">@error('documents') {{ $message }} @enderror</span>

                        </li>
                    </ul>

                </div>
                <input type="submit" name="submit" id="submit" value="Add New Staff" class="btn btn-primary">
            </form>
        </div>
    </div>

    <script>
        var checkboxes = document.querySelectorAll('input.subOption'),
            checkboxes2 = document.querySelectorAll('input.subOption2'),
            checkall = document.getElementById('option'),
            checkall2 = document.getElementById('option2');

        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].onclick = function() {
                var checkedCount = document.querySelectorAll('input.subOption:checked').length;

                checkall.checked = checkedCount > 0;
                checkall.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
            }
        }

        for (var i = 0; i < checkboxes2.length; i++) {
            checkboxes2[i].onclick = function() {
                var checkedCount2 = document.querySelectorAll('input.subOption2:checked').length;

                checkall2.checked = checkedCount2 > 0;
                checkall2.indeterminate = checkedCount2 > 0 && checkedCount2 < checkboxes2.length;
            }
        }

        checkall.onclick = function() {
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
            }
        }

        checkall2.onclick = function() {
            for (var i = 0; i < checkboxes2.length; i++) {
                checkboxes2[i].checked = this.checked;
            }
        }

        $(function() {
            disable_cb1();
            $("#billNone").on('click', disable_cb1);
        });

        function disable_cb1() {
            if (this.checked) {
                $("input.subOption").attr('disabled', true);
            } else {
                $("input.subOption").attr('disabled', false);
            }
        }

        $(function() {
            disable_cb();
            $("#docsNone").on('click', disable_cb);
        });

        function disable_cb() {
            if (this.checked) {
                $("input.subOption2").attr('disabled', true);
            } else {
                $("input.subOption2").attr('disabled', false);
            }
        }

        $("#docsUpdate").on('click', function(){
            if(this.checked){
                $("#docsRead").attr('checked', true);
            }
        });

        $("#docsDelete").on('click', function(){
            if(this.checked){
                $("#docsRead").attr('checked', true);
            }
        });


        $("#billUpdate").on('click', function(){
            if(this.checked){
                $("#billRead").attr('checked', true);
            } else{
                $("#billRead").attr('checked', false);
            }
        });

        $("#billDelete").on('click', function(){
            if(this.checked){
                $("#billRead").attr('checked', true);
            } else{
                $("#billRead").attr('checked', false);
            }
        });
    </script>
</body>
