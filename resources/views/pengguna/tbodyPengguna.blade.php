<?php 
$number = 1;
$no = 1+((Request::get('page')*10)-10);
?>
@foreach ($hakAkses as $key)
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
@endforeach