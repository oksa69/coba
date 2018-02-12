@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Ubah Kategori</h2><hr></div>
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<form method="POST" action="{{asset('proses-ubahKategori/'. $ubahKategori->id )}}">
			<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
			<div class="form-group {{ $errors->has('nama') ? 'has-danger' : ''}}">
				<label for="nama">Nama Kategori</label>
				<input type="text" class="form-control" id="nama" name="nama" value="{{$ubahKategori->nama}}">
				<small><div class="form-control-feedback">{!! $errors->first('nama',':message') !!}</div></small>
			</div>

			<button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
			
			<a href="{{asset('halamanKategori')}}" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
		</form>
	</div>
</div>
@stop