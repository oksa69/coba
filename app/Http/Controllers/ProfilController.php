<?php
namespace App\Http\Controllers;
use App\Models\ModelViewPeranPengguna;
use App\Models\ModelPeranPengguna;
use App\Models\ModelPengguna;
use App\Models\ModelPeran;
use App\Models\ModelKota;
use App\Models\ModelProvinsi;
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
class ProfilController extends Controller
{
// =================== HALAMAN PROFIL ============================
	public function halamanProfil()
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		$data = ModelViewPeranPengguna::where('penggunaid',Session::get('id'))->get();
		return view('profil.tampil', ['profil' => $data]);
	}

// =================== UBAH PROFIL ==============================
	public function ubahProfil($id)
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		$qry = ModelViewPeranPengguna::where('penggunaid',$id)->get();
		$qry2 = ModelProvinsi::all();
		$qry3 = ModelKota::all();
		return view('profil.ubah',['profil' => $qry, 'provinsi' => $qry2, 'kota' => $qry3]);
	}

	public function prosesUbahProfil()
	{

		$validator = Validator::make(Request::all(), [
			'namadepan'     => 'required',  
			'email'     => 'required|email',  
			'alamat'     => 'required', 
			'provinsi'     => 'required', 
			'kota'     => 'required', 
			'tanggallahir'     => 'required|date', 
			'telepon'     => 'numeric|max:99999999999999999999999999999999999999999999999999', 
		]);

		// jika validasinya benar
		if ($validator->fails()) 
		{

			//maka akan dikembalikan
			return redirect()->back()->withErrors($validator)->withInput();
		}

		// jika validasinya salah
		else {
			$cek = ModelPengguna::where('id','!=',Request::input('id'))
			->where('email', Request::input('email'))
			->first();
			if (empty($cek)) {
				$profil['namadepan'] = Request::input('namadepan');
				$profil['namabelakang'] = Request::input('namabelakang');
				$profil['alamat'] = Request::input('alamat'); 
				$profil['tanggallahir'] = Request::input('tanggallahir');
				$profil['kotaid'] = Request::input('kota'); 
				$profil['telepon'] = Request::input('telepon'); 
				$profil['hobi'] = Request::input('hobi');
				
				ModelPengguna::where('id',Request::input('id'))->update($profil);
				Alert::success('Data anda telah tersimpan','Berhasil');
				return redirect('home');
			}
			else{
				Alert::confirmButton()->warning('Email anda sudah terdaftar','Peringatan');
				return redirect()->back()->withInput();
			}
		}
	}

// ================== GET KOTA ==================================
	public function ambilKota($id)
	{
		if ($id == '') {
			$kota=ModelKota::all();
		}else {
			$kota=ModelKota::where('provinsiid','=',$id)->get();
		}
		return $kota;
	}

// ==================== UPLOAD FOTO ===================================
	public function uploadFoto()
	{
		
		$foto = Request::file('upload');

        // jika file foto dan naskah ada
		if ($foto) {

          // maka akan menjalankan proses upload
			$date = date('Y-m');  
			Storage::makeDirectory('uploads/fotoProfil/'.$date);
			$destinationPath = storage_path("app/uploads/fotoProfil/".$date."/");
			$extension       = $foto->getClientOriginalExtension();

          // jika jenis file foto dan naskah tidak sesuai
			if ($extension != 'png' && $extension != 'jpg' && $extension != 'jpeg') {

            //maka akan dikembalikan
				Alert::confirmButton()->warning('Format file tidak sesuai','Peringatan');
				return redirect()->back();
			}

          // jika jenis file foto dan naskah benar
			else{

            // upload foto
				$fileName        = date('ymdhis').''.rand(11111,99999).'.'.$extension;
				$foto->move($destinationPath, $fileName);
				$tambah['foto'] = "uploads/fotoProfil/".$date."/".$fileName;
				ModelPengguna::where('id',Session::get('id'))->update($tambah);
				Alert::success('Data anda sudah tersimpan','Berhasil');
				return redirect('home');
			}
		}else {
			return redirect()->back();
		}
	}

// ==================== UBAH PASSWORD ================================
	public function ubahPassword()
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		return view('profil.ubahPassword');
	}

	public function prosesUbahPassword()
	{
		
		$validator = Validator::make(Request::all(), [
			'passwordlama'     => 'required|min:6', 
			'passwordbaru'     => 'required|min:6' ,
			'konfirmasipasswordbaru'     => 'required' 
		]);

		// jika validasinya benar
		if ($validator->fails()) 
		{

			//maka akan dikembalikan
			return redirect()->back()->withErrors($validator)->withInput();
		}
		else{
			$passwordLama = md5(Request::input('passwordlama'));
			$cek = ModelPengguna::where('id',Session::get('id'))
			->where('password',$passwordLama)
			->first();

			if (empty($cek)) {
				Alert::confirmButton()->error('Password lama anda salah','Gagal');
				return redirect()->back();
			}else{
				$passwordBaru = md5(Request::input('passwordbaru'));
				$konfirmasiPasswordBaru = md5(Request::input('konfirmasipasswordbaru'));
				if ($passwordBaru == $konfirmasiPasswordBaru) {
					$ubah['password'] = $passwordBaru;
					ModelPengguna::where('id',Session::get('id'))->update($ubah);
					Alert::success('Password anda telah berubah','Berhasil');
					return redirect()->back();
				}else {
					Alert::confirmButton()->warning('Password baru anda tidak sesuai','Peringatan');
					return redirect()->back();
				}
			}
		}
	}
}

?>