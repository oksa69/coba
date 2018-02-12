@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Ubah Biodata</h2><hr></div>
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		@foreach ($profil as $profils)
		<form method="POST" action="{{asset('proses-ubahprofil')}}">
			
			<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

			<input type="hidden" id="id" name="id" value="{{$profils->penggunaid}}">
			
			<div class="form-group {{ $errors->has('namadepan') ? 'has-danger' : ''}}">
				<label for="namadepan">Nama Depan</label>
				<input type="text" class="form-control" id="namadepan" name="namadepan" value="{{$profils->namadepan}}">
				<small><div class="form-control-feedback">{!! $errors->first('namadepan',':message') !!}</div></small>
			</div>
			
			<div class="form-group">
				<label for="namabelakang">Nama Belakang</label>
				<input type="text" class="form-control" id="namabelakang" name="namabelakang" value="{{$profils->namabelakang}}">
			</div>
			
			<div class="form-group {{ $errors->has('email') ? 'has-danger' : ''}}">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="email" placeholder="nama@contoh.com" name="email" value="{{$profils->email}}" readonly="">
				<small><div class="form-control-feedback">{!! $errors->first('email',':message') !!}</div></small>
			</div>
			
			<div class="form-group {{ $errors->has('alamat') ? 'has-danger' : ''}}">
				<label for="alamat">Alamat</label>
				<input type="text" class="form-control" id="alamat" name="alamat" value="{{$profils->alamat}}">
				<small><div class="form-control-feedback">{!! $errors->first('alamat',':message') !!}</div></small>
			</div>

			<div class="form-group {{ $errors->has('tanggallahir') ? 'has-danger' : ''}}">
				<label for="tanggallahir">Tanggal Lahir</label>
				<input type="date" class="form-control" id="tanggallahir" name="tanggallahir" value="{{$profils->tanggallahir}}">
				<small><div class="form-control-feedback">{!! $errors->first('tanggallahir',':message') !!}</div></small>
			</div>
			
			<div class="form-group {{ $errors->has('provinsi') ? 'has-danger' : ''}}">
				<label for="provinsi">Provinsi</label>
				<select class="form-control" id="provinsi" name="provinsi" onchange="ambilKota()">
					<option value="">-- Silahkan Pilih Provinsi --</option>
					<?php $selectProvinsi = $profils->provinsiid;?>
					@foreach($provinsi as $row)
					<option value="{{$row->id}}" {{$selectProvinsi==$row->id ? 'selected' : ''}}>{{$row->nama}}</option>
					@endforeach
				</select>
				<small><div class="form-control-feedback">{!! $errors->first('provinsi',':message') !!}</div></small>
			</div>
			
			<div class="form-group {{ $errors->has('kota') ? 'has-danger' : ''}}">
				<label for="kota">Kota</label>
				<select class="form-control" id="kota" name="kota">
					<option value="">-- Silahkan Pilih Kota --</option>
					<?php $selectKota = $profils->kotaid;?>
					@foreach($kota as $row)
					<option value="{{$row->id}}" {{$selectKota==$row->id ? 'selected' : ''}}>{{$row->nama}}</option>
					@endforeach
				</select>
				<small><div class="form-control-feedback">{!! $errors->first('kota',':message') !!}</div></small>
			</div>
			
			<div class="form-group {{ $errors->has('telepon') ? 'has-danger' : ''}}">
				<label for="telepon">Telepon</label>
				<input type="text" class="form-control" id="telepon" placeholder="081256xxxxxx" name="telepon" value="{{$profils->telepon}}">
				<small><div class="form-control-feedback">{!! $errors->first('telepon',':message') !!}</div></small>
			</div>
			
			<div class="form-group">
				<label for="hobi">Hobi</label>
				<input type="text" class="form-control" id="hobi" name="hobi" value="{{$profils->hobi}}">
			</div>
			
			<button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
			
			<a href="{{asset('home')}}" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
		
		</form>
		@endforeach
	</div>
</div>
<script type="text/javascript">
	function ambilKota(){
		var id = $("#provinsi").val();
		$.get('{{ url('ambilkota')}}/'+id, function(data){
			console.log(data);
			$('#kota').empty();
			$.each(data, function(i, element){
				$('#kota').append("<option value='"+element.id+"'>"+element.nama+"</option>");
			});
		});
	};
</script>
@stop