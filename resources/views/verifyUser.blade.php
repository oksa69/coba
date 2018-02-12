<h2>Selamat datang di Zmartbook {{$namadepan}}</h2>
<br/>
Anda telah mendaftar dengan email {{$email}} , silahkan untuk verifikasi email anda dengan klik link berikut.
<br/>
<a href="{{url('konfirmasiEmail',['email' => $email, 'email_token' => $email_token])}}">Verifikasi Email</a>