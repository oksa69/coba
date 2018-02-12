@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Jenis Kertas</h2><hr></div>
	<div class="table-responsive">
		<?php 
			$number = 1;
			$no = 1+((Request::get('page')*10)-10);
		?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col"><a href="{{asset('tambahJenisKertas')}}" class="btn btn-outline-success"><i class="fa fa-plus"></i></a></th>
					<th scope="col">Jenis Kertas</th>
					<th scope="col">Harg per lembar</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			@foreach ($jenisKertas as $row)
			<tbody >
				<tr>
					<th scope="row">
						@if (Request::get('page') == '')
							{{$number++}}
						@else
							{{$no++}}
						@endif
					</th>
					<td>{{$row->nama}}</td>
					<td>{{$row->harga}}</td>
					<td>
						<a href="{{asset('ubahJenisKertas/'. $row->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
						<a href="{{asset('hapusJenisKertas/'. $row->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
			</tbody>
			@endforeach
		</table>
	</div>
	<div>
		{!! $jenisKertas->render(); !!}	
	</div>
</div>
@stop