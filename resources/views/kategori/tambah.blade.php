@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Tambah Kategori</h2><hr></div>
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		@if(Session::get('pesan')=='gagal')
			<div class="alert alert-danger fade in alert-dismissable show">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true" style="font-size:20px">×</span>
				</button><strong><i class="fa fa-warning"></i> Maaf!!</strong> nama kategori sudah ada, silahkan coba lagi
			</div>
		@endif
		<form method="POST" action="{{asset('proses-tambahKategori')}}">
			
			<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
			
			<div class="form-group {{ $errors->has('nama') ? 'has-danger' : ''}}">
				<label for="nama">Nama Kategori</label>
				<input type="text" class="form-control" id="nama" name="nama" value="{{old('nama')}}">
				<small><div class="form-control-feedback">{!! $errors->first('nama',':message') !!}</div></small>
			</div>

			<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
			
			<a href="{{asset('halamanKategori')}}" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>

		</form>
	</div>
</div>
@stop