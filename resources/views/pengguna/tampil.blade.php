@extends('layoutBackend.master')
@section('content')
@foreach ($hakAkses as $key)
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Daftar Pengguna</h2><hr></div>
	@if ($key->tambah == 'YA')
	<div style="padding-bottom: 15px;"><a href="{{asset('ubahPeranPengguna/'. $key->menuid)}}" class="btn btn-outline-warning"><i class="fa fa-edit"></i> Edit Peran</a></div>
	@endif
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">
						@if ($key->tambah == 'YA')
						<a href="{{asset('tambahPengguna/'. $key->menuid)}}" class="btn btn-outline-success"><i class="fa fa-plus"></i></a>
						@endif
					</th>
					<th scope="col">Nama Depan</th>
					<th scope="col">Nama Belakang</th>
					<th scope="col">Email</th>
					<th scope="col">Peran</th>
					<th scope="col">Status</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody id="tbody_pengguna">
				<?php 
				$number = 1;
				$no = 1+((Request::get('page')*10)-10);
				?>
				@foreach ($pengguna as $row)
				<tr>
					<th scope="row">
						@if (Request::get('page') == '')
						{{$number++}}
						@else
						{{$no++}}
						@endif
					</th>
					<td>{{$row->namadepan}}</td>
					<td>{{$row->namabelakang}}</td>
					<td>{{$row->email}}</td>
					<td>{{$row->peran}}</td>
					<td>{{$row->aksi}}</td>
					<td>
						@if ($key->ubah == 'YA')
						<a href="{{asset('ubahPengguna/'. $row->penggunaid .'/'. $key->menuid)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
						@endif
						@if ($key->hapus == 'YA')
						<button type="button" onclick="hapus({{$row->penggunaid}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
						@endif
						<input type="hidden" style="display: none;" id="menuid" value="{{ $key->menuid }}">
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endforeach
	</div>
	<div>
		{!! $pengguna->render(); !!}	
	</div>
</div>
<script type="text/javascript">
	function hapus(a) {
		var b = $('#menuid').val();
		swal({
			title: 'Apakah anda yakin?',
			text: 'File yang sudah terhapus tidak dapat dikembalikan!',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus data!',
			cancelButtonText: 'Tidak, Batal!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(
		function () {
			$.ajax({
				url: '{{ asset("hapusPengguna") }}/'+ b,
				type: 'get',
				data: {
					"id": a,
				},
				success: function(response) {
					if (response) {
						swal({
							title: 'Berhasil',
							text: 'Data anda telah terhapus',
							type: 'success',
							showConfirmButton : false,
							timer: 2000
						});
						$('#tbody_pengguna').html(response);
					}
				}
			});
		}
		).catch(swal.noop)
	}
</script>
@stop