<?php
namespace App\Http\Controllers;
use App\Models\ModelViewPeranPengguna;
use App\Models\ModelPeranPengguna;
use App\Models\ModelPengguna;
use App\Models\ModelPeran;
use Illuminate\Support\Str;
use Session;
use Request;
use Functions;
use DB;
use Hash;
use Redirect;
use Validator;
use CRUDBooster;
use Storage;
use Alert;
use Mail;

/**
* 
*/
class RegistrasiController extends Controller
{
// =========================== HALAMAN REGISTRASI ============================
	public function halamanRegistrasi()
	{
		if (Session::get('id') !='' || Session::get('aksi') == 'AKTIF') {
			return redirect('home');
		}
		return view('registrasi');
	}

	public function prosesRegistrasi()
	{
		
		$validator = Validator::make(Request::all(), [
			'namadepan' => 'required', 
			'email'     => 'required|email', 
			'password'  => 'required|min:6',
			'konfirmasipassword'  => 'required',
			'captcha'  => 'required|valid_captcha',
		],
		[
			'captcha.valid_captcha' => 'CAPTCHA anda tidak sesuai, silakan coba lagi.'
		]);

		// jika validasinya benar
		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		// jika tidak
		else {

			// maka akan mengecek email
			$cek = ModelPengguna::where('email', Request::input('email'))
			->first();
			
			// jika email tidak ada yang sama dengan database
			if (empty($cek)) {
				$password = Request::input('password');
				$konfirmasipassword = Request::input('konfirmasipassword');
				
				//jika password dan konfirmasi password sama
				if ($password == $konfirmasipassword) {
					
					// maka akan memasukan data ke database
					$data =[
						'namadepan'		=> Request::input('namadepan')
						,'namabelakang'	=> Request::input('namabelakang')
						,'email'		=> Request::input('email')
						,'password'		=> md5(Request::input('password'))
						,'email_token'	=> Str::random(40)
					];
					Mail::send('verifyUser',$data,function($message) use ($data)
					{
						$message->to($data['email']);
						$message->subject('Konfirmasi Email');
					});
					$pengguna = ModelPengguna::create($data);
					Alert::confirmButton()->success('Data berhasil disimpan, silahkan cek email','Berhasil');
					return redirect()->back();
				}

				// jika password dan konfirmasi password tidak sama
				else {

					// maka akan dikembalikan
					Alert::confirmButton()->error('Password dan konfirmasi tidak sesuai','Salah');
					return redirect()->back()->withInput();	
				}
			}
			
			// jika email ada yang sama dengan database
			else {

				// maka akan dikembalikan
				Alert::confirmButton()->warning('Email anda sudah terdaftar','Peringatan'); 
				return redirect()->back()->withInput();
			}
		}
	}
// ========================= KONFIRMASI EMAIL ======================================
	public function konfirmasiEmail($email, $email_token)
	{
		$cek = ModelPengguna::where('email',$email)->where('email_token',$email_token)->first();
		if ($cek) {
			ModelPengguna::where('email',$email)->update([
				'email_token' => null,
				'aksi' => 'AKTIF'
			]);
			Alert::confirmButton()->success('Selamat akun anda telah terverify silahkan login','berhasil');
			return redirect('login');
		} 
	}
}
?>
