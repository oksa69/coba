<?php
namespace App\Http\Controllers;
use App\Models\ModelViewPeranPengguna;
use App\Models\ModelPeranPengguna;
use App\Models\ModelPengguna;
use App\Models\ModelPeran;
use App\Models\ModelLogLogin;
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

/**
* 
*/
class LoginController extends Controller
{
	
	public function halamanLogin()
	{
		if (Session::get('id') !='' || Session::get('aksi') == 'AKTIF') {
			return redirect('home');
		}
		return view('login');
	}

	public function prosesLogin()
	{

		$validator = Validator::make(Request::all(), [
			'email'     => 'required|email', 
			'password'  => 'required|min:6',
		]);

		// jika validasinya benar
		if ($validator->fails()) 
		{

			//maka akan dikembalikan
			return redirect()->back()->withErrors($validator)->withInput();
		}

		// jika validasinya salah
		else {

			// maka akan mengecek email dan password
			$email = Request::input('email');
			$password = Request::input('password');
			$cekEmail = DB::select("SELECT login('$email','$password')as hasil");
			//dd($cekEmail["0"]->hasil);
			// jika email atau password ada di database
			if ($cekEmail["0"]->hasil != 'salah') {

				$cekAktif = ModelViewPeranPengguna::where('aksi','AKTIF')
				->where('email', $email)
				->where('password', md5($password))
				->first();

				if (empty($cekAktif)) {
					Alert::confirmButton()->warning('Maaf email anda belum verifikasi.', 'Peringatan');
					return redirect()->back()->withInput();
				}
				else{
					Session::put('id',$cekAktif->penggunaid);
					Session::put('namadepan',$cekAktif->namadepan);
					Session::put('aksi',$cekAktif->aksi);
					Session::put('peranid',$cekAktif->peranid);

					// ========== Membuat Log Login ===============
					ModelLogLogin::create([
						'ipaddress' => Request::ip('user-agent'),
						'penggunaid'=> Session::get('id'),
					]);
					// ============================================
					
					Alert::success('Selamat datang di Zmartbook', 'Berhasil');
					return redirect('home');
				}
			}

			// jika email atau password ada di database
			else {
				Alert::confirmButton()->error('Maaf email atau password anda salah.', 'Gagal');
				return redirect()->back()->withInput();
			}
		}
	}

	public function logout()
	{
		Session::put('id','');
		Session::put('namadepan','');
		Session::put('aksi','');
		Session::put('peranid','');
		return redirect('login');
	}

}

?>