<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{!! asset('assets/css/font-awesome.min.css') !!}">
	<link rel="stylesheet" href="{!! asset('assets/css/bootstrap.min.css') !!}">
	<link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">
	<link rel="stylesheet" href="{!! asset('assets/css/sweetalert2.min.css') !!}">
</head>
<body style="background-color: #fff0">
	<div id="login" class="container">
		<div class="row" style="margin-top: 135px">
			<div class="col-sm-3"></div>
			<div class="col-sm-6" style="background-color: #ffffff;padding: 15px">
				<div align="center"><a href="{{asset('/')}}"><img class="img-fluid" src="{!! asset('assets/image/zmartbook.png') !!}" width="300px"></a></div><br>
				<form action="{{asset('proses-login')}}" method="POST">
					<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
					<div class="form-group {{ $errors->has('email') ? 'has-danger' : ''}}">
						<label for="email" class="control-label">Email</label>
						<div class="input-group">
							<input type="text" class="form-control" name="email" id="email"  placeholder="nama@example.com" value="{{old('email')}}" />
							<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						</div>
						<small><div class="form-control-feedback">{!! $errors->first('email', ':message') !!}</div></small>
					</div>
					<div class="form-group {{ $errors->has('password') ? 'has-danger' : ''}}">
						<label for="email" class="control-label">Password</label>
						<div class="input-group">
							<input type="password" class="form-control" name="password" id="password"  placeholder="Password min 6 karakter"/>
							<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
						</div>
						<small><div class="form-control-feedback">{!! $errors->first('password', ':message') !!}</div></small>
					</div>
					<button type="submit" class="btn btn-success">Masuk</button>
					<small>Anda belum memiliki akun? silahkan </small><a style="color: #139a69" href="{{asset('registrasi')}}">Registrasi</a>
				</form>
			</div>
		</div><br><br>
		<footer class="container-fluid bg-4 text-center">
			<p>2017 © All Rights Reserved. Zmartbook</p>
		</footer>
	</div>
	<!-- jQuery first, then Tether, then Bootstrap JS. -->
	<script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
	<script src="{!! asset('assets/js/tether.min.js') !!}"></script>
	<script src="{!! asset('assets/js/bootstrap.min.js') !!}"></script>
	<script src="{!! asset('assets/js/sweetalert2.min.js') !!}"></script>
	@include('sweet::alert')
</body>
</html>