@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Tambah Jenis Kertas</h2><hr></div>
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		
		<form method="POST" action="{{asset('proses-tambahJenisKertas')}}">
			
			<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
			
			<div class="form-group {{ $errors->has('nama') ? 'has-danger' : ''}}">
				<label for="nama">Jenis Kertas</label>
				<input type="text" class="form-control" id="nama" name="nama" value="{{old('nama')}}">
				<small><div class="form-control-feedback">{!! $errors->first('nama',':message') !!}</div></small>
			</div>
			<div class="form-group {{ $errors->has('harga') ? 'has-danger' : ''}}">
				<label for="harga">Harga</label>
				<input type="text" maxlength="4" class="form-control" id="harga" name="harga" value="{{old('harga')}}" placeholder="maksimal 4 angka">
				<small><div class="form-control-feedback">{!! $errors->first('harga',':message') !!}</div></small>
			</div>

			<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
			
			<a href="{{asset('halamanJenisKertas')}}" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>

		</form>
	</div>
</div>
@stop