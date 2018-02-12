@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Ubah Password</h2><hr></div>
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		@if(Session::get('pesan') == 'gagalPasswordLama')
		<div class="alert alert-danger fade in alert-dismissable show">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true" style="font-size:20px">×</span>
			</button>
			<strong><i class="fa fa-warning"></i> Maaf!!</strong> password lama anda salah, silahkan coba lagi.
		</div>
		@elseif (Session::get('pesan') == 'gagalKonfirmasi')
		<div class="alert alert-danger fade in alert-dismissable show">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true" style="font-size:20px">×</span>
			</button>
			<strong><i class="fa fa-warning"></i> Maaf!!</strong> konfirmasi password dan password baru anda tidak sesuai, silahkan coba lagi.
		</div>
		@elseif(Session::get('pesan') == 'sukses')
		<div class="alert alert-success fade in alert-dismissable show">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true" style="font-size:20px">×</span>
			</button>
			<strong><i class="fa fa-warning"></i> Selamat!!</strong> password anda telah diperbaharui.
		</div>
		@endif

		<form method="POST" action="{{asset('proses-ubahPassword')}}">
			
			<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
			
			<div class="form-group {{ $errors->has('passwordlama') ? 'has-danger' : ''}}">
				<label for="passwordlama">Password Lama</label>
				<input type="password" class="form-control" id="passwordlama" name="passwordlama" placeholder="Minimal 6 karakter">
				<small><div class="form-control-feedback">{!! $errors->first('passwordlama',':message') !!}</div></small>
			</div>
			
			<div class="form-group {{ $errors->has('passwordbaru') ? 'has-danger' : ''}}">
				<label for="passwordbaru">Password Baru</label>
				<input type="password" class="form-control" placeholder="Minimal 6 karakter" id="passwordbaru" name="passwordbaru" value="">
				<small><div class="form-control-feedback">{!! $errors->first('passwordbaru',':message') !!}</div></small>
			</div>
			
			<div class="form-group {{ $errors->has('konfirmasipasswordbaru') ? 'has-danger' : ''}}">
				<label for="konfirmasipasswordbaru">Konfirmasi Password Baru</label>
				<input type="password" class="form-control" id="konfirmasipasswordbaru" placeholder="" name="konfirmasipasswordbaru" value="">
				<small><div class="form-control-feedback">{!! $errors->first('konfirmasipasswordbaru',':message') !!}</div></small>
			</div>
			
			<button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
			
			<a href="{{asset('home')}}" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>

		</form>
	</div>
</div>
@stop