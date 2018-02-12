@extends('layoutBackend.master')
@section('content')
<div class="row" id="row-form">
	<div class="col-sm-12" style="margin-bottom:5px "><h2>Ubah Pengguna</h2><hr></div>
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		@foreach ($hakAkses as $key)
		<form method="POST" action="{{asset('proses-ubahPengguna/'. $pengguna->penggunaid .'/'. $key->menuid )}}">
			
			<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
			
			<div class="form-group {{ $errors->has('namadepan') ? 'has-danger' : ''}}">
				<label for="namadepan">Nama Depan</label>
				<input type="text" class="form-control" id="namadepan" name="namadepan" value="{{old('namadepan',  isset($pengguna->namadepan) ? $pengguna->namadepan : null)}}">
				<small><div class="form-control-feedback">{!! $errors->first('namadepan',':message') !!}</div></small>
			</div>
			
			<div class="form-group">
				<label for="namabelakang">Nama Belakang</label>
				<input type="text" class="form-control" id="namabelakang" name="namabelakang" value="{{old('namabelakang',  isset($pengguna->namabelakang) ? $pengguna->namabelakang : null)}}">
			</div>
			
			<div class="form-group {{ $errors->has('email') ? 'has-danger' : ''}}">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="email" placeholder="nama@contoh.com" name="email" value="{{old('email',  isset($pengguna->email) ? $pengguna->email : null)}}" readonly="">
				<small><div class="form-control-feedback">{!! $errors->first('email',':message') !!}</div></small>
			</div>

			<div class="form-group {{ $errors->has('peran') ? 'has-danger' : ''}}">
				<label for="peran">Peran</label>
				<select class="form-control combobox" id="peran" name="peran">
					<option value="">-- Silahkan Pilih Peran --</option>
					@foreach($peran as $row)
					<option value="{{$row->id}}" {{ old('peran', $pengguna->peranid) == $row->id ? 'selected' : null }}>{{ $row->nama }}</option>
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