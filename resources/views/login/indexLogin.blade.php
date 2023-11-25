<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="w-50 center border rounded px-3 py-3 mx-auto" id="login">
            <h2 class="title">Login</h2>
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" @error('username') is-invalid @enderror placeholder="Username" name="username" value="{{ Session::get('username') }}">
                    <label for="username">Username</label>
                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" @error('password') is-invalid @enderror placeholder="Password" name="password">
                    <label for="password">Password</label>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                @if(Session::has('loginError'))
                    <div class="text-danger text-center mt-2 mb-2">
                        {{ Session::get('loginError') }}
                    </div>
                @endif

                <div class="form-floating text-center">
                    <button type="submit" class="w-100 btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>