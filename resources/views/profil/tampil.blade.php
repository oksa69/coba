@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-4">
		<div class="container-foto">
			@foreach ($profil as $profils)

			@if ($profils->foto == '')
			<img id="foto" src="{!! asset('assets/image/user.png') !!}" alt="Avatar" class="img-fluid img-thumbnail">
			@else
			<img id="foto" src="{!! asset('storage/app/'.$profils->foto) !!}" alt="Avatar" class="img-fluid img-thumbnail">
			@endif
			
			<div class="middle">
				<div class="text">
					<button type="button" class="btn btn-outline-success btn-lg" onclick="pilihFoto()">Unggah</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8 table-responsive">
		@if ($profils->alamat == '' || $profils->provinsi == '' || $profils->kota == '' || $profils->telepon == '' || $profils->hobi == '')	
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<i class="fa fa-warning"></i>
			<strong>Peringatan!</strong> Biodata anda kurang lengkap, silahkan dilengkapi.
		</div>
		@endif
		<table class="table">
			<tbody>
				<tr>
					<td>Nama Depan</td>
					<td>:</td>
					<td>{{$profils->namadepan}}</td>
				</tr>
				<tr class="table-success">
					<td>Nama Belakang</td>
					<td>:</td>
					<td>{{$profils->namabelakang}}</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td>{{$profils->email}}</td>
				</tr>
				<tr class="table-success">
					<td>Status</td>
					<td>:</td>
					<td>{{$profils->peran}}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td>{{$profils->alamat}}</td>
				</tr>
				<tr class="table-success">
					<td>Tanggal Lahir</td>
					<td>:</td>
					<td>{{$profils->tanggallahir}}</td>
				</tr>
				<tr>
					<td>Provinsi</td>
					<td>:</td>
					<td>{{$profils->provinsi}}</td>
				</tr>
				<tr class="table-success">
					<td>Kota</td>
					<td>:</td>
					<td>{{$profils->kota}}</td>
				</tr>
				<tr>
					<td>Telpon</td>
					<td>:</td>
					<td>{{$profils->telepon}}</td>
				</tr>
				<tr class="table-success">
					<td>Hobi</td>
					<td>:</td>
					<td>{{$profils->hobi}}</td>
				</tr>
				<tr>
					<td><a href="{{asset('ubahProfil/'. Session::get('id'))}}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a></td>
				</tr>
			</tbody>
		</table>
		@endforeach
	</div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Upload Foto</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form action="{{asset('uploadFoto')}}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="file" class="form-control-file" id="upload" name="upload">
					<small id="fileHelp" class="form-text text-muted">Berkas yang digunakan harus berukuran kurang dari 500kb dan berformat png atau jpg.</small>
					<button id="simpan" style="display: none;"></button>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="simpan()"><i class="fa fa-upload"></i> Unggah</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
			</div>

		</div>
	</div>
</div>
<script>
	
	function pilihFoto() {
		$('#myModal').modal('show'); 
	};
	function simpan() {
		setTimeout(function(){ 
			$('#myModal').modal('hide'); 
			$('#simpan').click();
		}, 1000);
	};
</script>

@stop

