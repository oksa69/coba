@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Ubah Peran Pengguna</h2><hr></div>
	<div class="col-sm-2"></div>
	<div class="col-sm-8 ">
		@foreach ($hakAkses as $key)
		<form method="POST" action="{{asset('proses-ubahPeranPengguna/'. $key->menuid )}}">
			<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
			<div class="row">
				<div class="form-group col-sm-2">
					<select class="form-control" id="entri" name="entri" onchange="entries(this.value)">
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="75">75</option>
						<option value="100">100</option>
						
					</select>
				</div>
				<div class="form-group col-sm-4"></div>
				<!-- <div class="form-group col-sm-6">
					<input type="search" class="form-control light-table-filter" data-table="order-table" placeholder="Seacrh" />
				</div> -->
				<div class="form-group col-sm-6">
					<input id="cari" type="search" class="form-control" placeholder="Seacrh" />
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered order-table" id="dataTabel">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama Depan</th>
							<th scope="col">Nama Belakang</th>
							<th scope="col">Email</th>
							<th scope="col">Peran</th>
						</tr>
					</thead>
					<tbody id="tbody_pengguna">
						@foreach ($pengguna as $row)
						<tr>
							<td align="center">
								<input style="margin-left: -0.25rem;" class="form-check-input" name="{{$row->penggunaid}}_pengguna" type="checkbox" {{ old($row->penggunaid .'_pengguna') ? 'checked' : '' }}>
							</td>
							<td>{{$row->namadepan}}</td>
							<td>{{$row->namabelakang}}</td>
							<td>{{$row->email}}</td>
							<td>{{$row->peran}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{ $pengguna->render() }}
			</div>
			<div class="form-group {{ $errors->has('peran') ? 'has-danger' : ''}}">
				<label for="peran">Peran</label>
				<select class="form-control combobox" id="peran" name="peran">
					<option value="">-- Silahkan Pilih Peran --</option>
					@foreach($peran as $row)
					<option value="{{$row->id}}">{{$row->nama}}</option>
					@endforeach
				</select>
				<small><div class="form-control-feedback">{!! $errors->first('peran',':message') !!}</div></small>
			</div>
			<button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
			
			<a href="{{asset('Pengguna/'. $key->menuid)}}" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
			
		</form>
		@endforeach
	</div>
</div>
<script type="text/javascript">
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();

	function pencarian(a) {
		var entri = $('#entri').val();
		$.ajax({
			type 	: "get",
			url		: "{{ asset('cariPeranPengguna') }}",
			data 	: {"cari": a,"entri":entri},
			success:function(respon){
				$('#tbody_pengguna').html(respon);
			}
		})
	}

	$('#cari').keyup(function() {
		var a = $('#cari').val();
		delay(function(){
			pencarian(a);
		}, 1000);
	});

	function entries(e) {
		$.ajax({
			type 	:"get",
			url		: "{{ asset('entri') }}",
			data 	: {"entri" : e},
			success:function(respon){
				$('#tbody_pengguna').html(respon);
			}
		})
	}
</script>
@stop