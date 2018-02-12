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
	<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
</head>
<body style="background-color: #fff0">
	<div id="register" class="container">
		<div class="row" style="margin-top: 15px">
			<div class="col-sm-3"></div>
			<div class="col-sm-6" style="background-color: #ffffff;padding: 15px">
				<div align="center"><a href="{{asset('/')}}" align="center"><img class="img-fluid" src="{!! asset('assets/image/zmartbook.png') !!}" width="300px"></a></div><br>
				@if(Session::get('pesan')!='')
				<div class="alert alert-success fade in alert-dismissable show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true" style="font-size:20px">×</span>
					</button><i class="fa fa-warning"></i> {{Session::get('pesan')}}
				</div>
				@endif
				<form action="{{asset('proses-registrasi')}}" method="POST">
					<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
					<div class="form-group {{ $errors->has('namadepan') ? 'has-danger' : ''}}">
						<label for="namadepan" class="control-label">Nama Depan *</label>
						<div class="input-group">
							<input type="text" class="form-control" name="namadepan" id="namadepan"  placeholder="" value="{{old('namadepan')}}" />
							<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						</div>
						<small><div class="form-control-feedback">{!! $errors->first('namadepan',':message') !!}</div></small>
					</div>
					<div class="form-group">
						<label for="namabelakang" class="control-label">Nama Belakang</label>
						<div class="input-group">
							<input type="text" class="form-control" name="namabelakang" id="namabelakang"  placeholder="" value="{{old('namabelakang')}}" />
							<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						</div>
					</div>
					<div class="form-group {{ $errors->has('email') ? 'has-danger' : ''}}">
						<label for="email" class="control-label">Email *</label>
						<div class="input-group">
							<input type="text" class="form-control" name="email" id="email"  placeholder="nama@contoh.com" value="{{old('email')}}" />
							<span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
						</div>
						<small><div class="form-control-feedback">{!! $errors->first('email', ':message') !!}</div></small>
					</div>
					<div class="form-group {{ $errors->has('password') ? 'has-danger' : ''}}">
						<label for="password" class="control-label">Password *</label>
						<div class="input-group">
							<input type="password" class="form-control" name="password" id="password"  placeholder="Password min 6 karakter"/>
							<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
						</div>
						<small><div class="form-control-feedback">{!! $errors->first('password', ':message') !!}</div></small>
					</div>
					<div class="form-group {{ $errors->has('konfirmasipassword') ? 'has-danger' : ''}}">
						<label for="konfirmasipassword" class="control-label">Konfirmasi Password *</label>
						<div class="input-group">
							<input type="password" class="form-control" name="konfirmasipassword" id="konfirmasipassword"  placeholder=""/>
							<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
						</div>
						<small><div class="form-control-feedback">{!! $errors->first('konfirmasipassword', ':message') !!}</div></small>
					</div>
					<div class="form-group {{ $errors->has('captcha') ? 'has-danger' : ''}}">
						<label for="captcha" class="control-label">Captcha *</label>
						{!! captcha_image_html('ContactCaptcha') !!}
						<div class="input-group">
							<input type="text" class="form-control" name="captcha" id="captcha" style="text-transform: uppercase;" />
							<span class="input-group-addon"><i class="fa fa-contao" aria-hidden="true"></i></span>
						</div>
						<small><div class="form-control-feedback">{!! $errors->first('captcha', ':message') !!}</div></small>
					</div>
					<button type="submit" class="btn btn-success">Daftar</button>
					<small>Anda sudah memiliki akun? silahkan </small><a style="color: #139a69" href="{{asset('login')}}">Login</a>
				</form>
			</div>
		</div><br>
		<footer class="text-center">
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