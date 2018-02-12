@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Tambah Peran</h2><hr></div>
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		@foreach($hakAkses as $row)
		<form method="POST" action="{{asset('proses-tambahPeran/'. $row->menuid)}}">
			
			<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
			
			<div class="form-group {{ $errors->has('nama') ? 'has-danger' : ''}}">
				<label for="nama">Nama</label>
				<input type="text" class="form-control" id="nama" name="nama" value="{{old('nama')}}">
				<small><div class="form-control-feedback">{!! $errors->first('nama',':message') !!}</div></small>
			</div>
			
			<div class="form-group">
				<label for="deskripsi">Deskripsi</label>
				<input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{old('deskripsi')}}">
			</div>
			<div class="form-group">
				<label for="menu">Pengaturan Hak Akses</label>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama </th>
							<th scope="col">Tampil</th>
							<th scope="col">Tambah</th>
							<th scope="col">Ubah</th>
							<th scope="col">Hapus</th>
						</tr>
					</thead>
					<?php $no=1;?>
					@foreach ($menu as $menus)
					<tbody id="tbody_pengguna">
						<tr>
							<th scope="row">{{$no++}}</th>
							<td>{{$menus->nama}}</td>
							<td align="center" class="table-info">
								<input class="form-check-input" name="{{$menus->id}}_tampil" type="checkbox" {{ old($menus->id .'_tampil') ? 'checked' : '' }}>
							</td>
							<td align="center" class="table-success">
								<input class="form-check-input" name="{{$menus->id}}_tambah" type="checkbox" {{ old($menus->id .'_tambah') ? 'checked' : '' }}>
							</td>
							<td align="center" class="table-warning">
								<input class="form-check-input" name="{{$menus->id}}_ubah" type="checkbox" {{ old($menus->id .'_ubah')  ? 'checked' : '' }}>
							</td>
							<td align="center" class="table-danger">
								<input class="form-check-input" name="{{$menus->id}}_hapus" type="checkbox" {{ old($menus->id .'_hapus') ? 'checked' : '' }}>
							</td>
						</tr>
					</tbody>
					@endforeach
				</table>
			</div>

			<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
			
			<a href="{{asset('Peran/'. $row->menuid)}}" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>

		</form>
		@endforeach
	</div>
</div>
@stop