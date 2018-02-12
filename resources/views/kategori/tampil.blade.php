@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Kategori Buku</h2><hr></div>
	<div class="table-responsive">
		<?php 
			$number = 1;
			$no = 1+((Request::get('page')*10)-10);
		?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col"><a href="{{asset('tambahKategori')}}" class="btn btn-outline-success"><i class="fa fa-plus"></i></a></th>
					<th scope="col">Kategori</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			@foreach ($kategori as $kategoris)
			<tbody >
				<tr>
					<th scope="row">
						@if (Request::get('page') == '')
							{{$number++}}
						@else
							{{$no++}}
						@endif
					</th>
					<td>{{$kategoris->nama}}</td>
					<td>
						<a href="{{asset('ubahKategori/'. $kategoris->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
						<a href="{{asset('hapusKategori/'. $kategoris->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
			</tbody>
			@endforeach
		</table>
	</div>
	<div>
		{!! $kategori->render(); !!}	
	</div>
</div>
@stop

