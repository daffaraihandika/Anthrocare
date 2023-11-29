<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login_style.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="{{ asset('img/wave.png') }}">
	<div class="container">
		<div class="img">
			<img src="{{ asset('img/logo.png') }}">
		</div>
		<div class="login-content">
			<form action="{{ url('/login') }}" method="POST">
                @csrf
				<img src="{{ asset('img/avatar.svg') }}">
				<h2 class="title">Login</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input required type="text" class="input form-control" id="username" @error('username') is-invalid @enderror name="username">
                        @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
                        <input required type="password" class="input form-control" id="password" @error('password') is-invalid @enderror name="password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            	   </div>
            	</div>
                @if(Session::has('loginError'))
                    <div class="text-danger text-center mt-2 mb-2" style="color: red">
                        <br>
                        {{ Session::get('loginError') }}
                    </div>
                @endif
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
</body>
</html>
