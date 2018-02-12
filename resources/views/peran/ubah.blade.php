@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Ubah Peran</h2><hr></div>
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		@foreach ($hakAkses as $key)
		@foreach ($peran as $row)
		<form method="POST" action="{{asset('proses-ubahPeran/'. $row->id .'/'. $key->menuid)}}">
			<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
			<div class="form-group {{ $errors->has('nama') ? 'has-danger' : ''}}">
				<label for="nama">Nama</label>
				<input type="text" class="form-control" id="nama" name="nama" value="{{old('nama',  isset($row->nama) ? $row->nama : null)}}">
				<small><div class="form-control-feedback">{!! $errors->first('nama',':message') !!}</div></small>
			</div>
			
			<div class="form-group">
				<label for="deskripsi">Deskripsi</label>
				<input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{old('deskripsi',  isset($row->deskripsi) ? $row->deskripsi : null)}}">
			</div>
			@endforeach
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
					<tbody id="tbody_pengguna">
					@foreach ($menu as $menus)
						<tr>
							<th scope="row">{{$no++}}</th>
							<td>{{$menus->menu}}</td>
							<td align="center" class="table-info">
								<input class="form-check-input" name="{{$menus->menuid}}_tampil" type="checkbox" {{ $menus->tampil == 'YA' ? 'checked' : ''}} >
							</td>
							<td align="center" class="table-success">
								<input class="form-check-input" name="{{$menus->menuid}}_tambah" type="checkbox" {{ $menus->tambah == 'YA' ? 'checked' : ''}}>
							</td>
							<td align="center" class="table-warning">
								<input class="form-check-input" name="{{$menus->menuid}}_ubah" type="checkbox" {{ $menus->ubah == 'YA' ? 'checked' : ''}}>
							</td>
							<td align="center" class="table-danger">
								<input class="form-check-input" name="{{$menus->menuid}}_hapus" type="checkbox" {{ $menus->hapus == 'YA' ? 'checked' : ''}}>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
			
			<a href="{{asset('Peran/'. $key->menuid)}}" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>

		</form>
		@endforeach
	</div>
</div>
@stop