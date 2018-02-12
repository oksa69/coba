<?php 
	use App\Models\ModelViewHakAkses;
	$hakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))->get();
?>
<nav class="navbar navbar-toggleable-md navbar-light bg-custom">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="container">
		<a class="navbar-brand" href="{{asset('home')}}"><img class="img-fluid" src="{!! asset('assets/image/Symbol.png') !!}" width="150px"></a>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav mr-auto">
				@foreach ($hakAkses as $key)
					@if ($key['tampil'] == 'YA')
						<li class="nav-item">
							<a class="nav-link" id="{{$key['menuid']}}" href="{{asset($key['menu'] .'/'. $key['menuid'])}}">{{$key['menu']}}</a>
						</li>
					@endif
				@endforeach
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user"></i> Selamat Datang {{Session::get('namadepan')}}
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="{{asset('ubahPassword')}}"><i class="fa fa-unlock-alt"></i> Ganti Password</a>
						<a class="dropdown-item" href="{{asset('logout')}}"><i class="fa fa-sign-out"></i> Keluar</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>