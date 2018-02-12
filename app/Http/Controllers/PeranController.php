<?php
namespace App\Http\Controllers;
use App\Models\ModelPeran;
use App\Models\ModelMenu;
use App\Models\ModelHakAkses;
use App\Models\ModelViewHakAkses;
use App\Models\ModelViewPeranPengguna;
use App\Models\ModelAktivitasPengguna;
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
class PeranController extends Controller
{
// ============================== HALAMAN PERAN ==================================
	public function halamanPeran($menuid)
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		else{
			$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
			->where('menuid',$menuid)
			->first();
			if ($cekHakAkses['tampil'] == 'YA') {
				if (Session::get('peranid') == '1') {
					$data = ModelPeran::where('id','!=','1')->paginate(10) ;
				}else{
					$data = ModelPeran::where('id','!=','1')
					->where('id','!=','2')
					->paginate(10) ;
				}
				$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
				->where('menuid',$menuid)
				->get();
				return view('peran.tampil', ['peran' => $data, 'hakAkses' => $cekHakAkses]);
			} else {
				return redirect('home');
			}

		}
	}

// ============================== TAMBAH PERAN ===================================
	public function tambahPeran($menuid)
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		else{
			$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
			->where('menuid',$menuid)
			->first();
			if ($cekHakAkses['tampil'] == 'YA' && $cekHakAkses['tambah'] == 'YA') {
				$data = ModelMenu::all();
				$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
				->where('menuid',$menuid)
				->get();
				return view('peran.tambah',['menu' => $data, 'hakAkses' => $cekHakAkses]);
			}else{
				return redirect('home');
			}
		}
	}

	public function prosesTambahPeran($menuid)
	{
		$validator = Validator::make(Request::all(), [
			'nama'     => 'required'
		]);

		// jika validasinya benar
		if ($validator->fails()) 
		{

			//maka akan dikembalikan
			return redirect()->back()->withErrors($validator)->withInput();
		}

		// jika validasinya salah
		else {
			$cekPeran = ModelPeran::where('nama',Request::input('nama'))->first();
			if (empty($cekPeran)) {
				$peran = ModelPeran::create(['nama' => Request::input('nama'), 'deskripsi' => Request::input('deskripsi')]);
				$cariPengguna = ModelViewPeranPengguna::where('penggunaid',Session::get('id'))->first();
				ModelAktivitasPengguna::create([
					'namadepan' => $cariPengguna['namadepan'],
					'email' 	=> $cariPengguna['email'],
					'menuid' 	=> $menuid,
					'aktivitas' => 'TAMBAH',
					'targetid' 	=> $peran['id']
				]);
				$menu= ModelMenu::all();
				foreach ($menu as $key) {
					$tampil = Request::input($key['id'].'_tampil') == null ? 'TIDAK' : 'YA';
					$tambah = Request::input($key['id'].'_tambah') == null ? 'TIDAK' : 'YA';
					$ubah   = Request::input($key['id'].'_ubah') == null ? 'TIDAK' : 'YA';
					$hapus  = Request::input($key['id'].'_hapus') == null ? 'TIDAK' : 'YA';
					
					ModelHakAkses::create([
						'peranid' => $peran['id'],
						'menuid'  => $key['id'], 
						'tambah'  => $tambah, 
						'ubah'    => $ubah, 
						'hapus'   => $hapus,
						'tampil'  => $tampil
					]);
				}
				Alert::success('Data anda sudah tersimpan','Berhasil');
				return redirect('Peran/'. $menuid);
			} else {
				Alert::confirmButton()->warning('Peran sudah ada','Peringatan');
				return redirect()->back();
			}
		}
	}

// ============================= UBAH PERAN ====================================
	public function ubahPeran($id, $menuid)
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		else{
			$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
			->where('menuid',$menuid)
			->first();
			if ($cekHakAkses['tampil'] == 'YA' && $cekHakAkses['ubah'] == 'YA') {
				$peran = ModelPeran::where('id',$id)->get();
				$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
				->where('menuid',$menuid)
				->get();
				$menu = ModelViewHakAkses::where('peranid',$id)->get();
				return view('peran.ubah', ['peran' => $peran, 'hakAkses' => $cekHakAkses, 'menu'=>$menu]);
			}else {
				return redirect('home');
			}
		}
	}

	public function prosesUbahPeran($id, $menuid)
	{
		$validator = Validator::make(Request::all(), [
			'nama'     => 'required'
		]);

		// jika validasinya benar
		if ($validator->fails()) 
		{

			//maka akan dikembalikan
			return redirect()->back()->withErrors($validator)->withInput();
		}

		// jika validasinya salah
		else {
			$cekPeran = ModelPeran::where('nama',Request::input('nama'))->where('id','!=',$id)->first();
			if (empty($cekPeran)) {
				$peran = ModelPeran::where('id',$id)->update(['nama' => Request::input('nama'), 'deskripsi' => Request::input('deskripsi')]);
				$cariPengguna = ModelViewPeranPengguna::where('penggunaid',Session::get('id'))->first();
				ModelAktivitasPengguna::create([
					'namadepan' => $cariPengguna['namadepan'],
					'email' 	=> $cariPengguna['email'],
					'menuid' 	=> $menuid,
					'aktivitas' => 'UBAH',
					'targetid' 	=> $id
				]);
				$hakakses= ModelMenu::all();
				foreach ($hakakses as $key) {
					$tambah = Request::input($key['id'].'_tambah') == null ? 'TIDAK' : 'YA';
					$tampil = Request::input($key['id'].'_tampil') == null ? 'TIDAK' : 'YA';
					$ubah   = Request::input($key['id'].'_ubah') == null ? 'TIDAK' : 'YA';
					$hapus  = Request::input($key['id'].'_hapus') == null ? 'TIDAK' : 'YA';
					ModelHakAkses::where('peranid',$id)->where('menuid',$key['id'])->update([ 
						'tambah'  => $tambah, 
						'ubah'    => $ubah, 
						'hapus'   => $hapus,
						'tampil'  => $tampil
					]);
				}
				Alert::success('Data anda telah tersimpan','Berhasil');
				return redirect('Peran/'.$menuid);
			} else {
				Alert::confirmButton()->warning('Peran sudah ada','Peringatan');
				return redirect()->back();
			}
		}
	}

// ============================ HAPUS PERAN =====================================
	public function hapusPeran($menuid)
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		else{
			$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
			->where('menuid',$menuid)
			->first();
			if ($cekHakAkses['tampil'] == 'YA' && $cekHakAkses['hapus'] == 'YA') {
				$id = Request::get('id');
				$delete = ModelPeran::where('id',$id)->delete();
				if (Session::get('peranid') == '1') {
					$data = ModelPeran::where('id','!=','1')->paginate(10) ;
				}else{
					$data = ModelPeran::where('id','!=','1')
					->where('id','!=','2')
					->paginate(10) ;
				}
				$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
				->where('menuid',$menuid)
				->get();
				$cariPengguna = ModelViewPeranPengguna::where('penggunaid',Session::get('id'))->first();
				ModelAktivitasPengguna::create([
					'namadepan' => $cariPengguna['namadepan'],
					'email' 	=> $cariPengguna['email'],
					'menuid' 	=> $menuid,
					'aktivitas' => 'HAPUS',
					'targetid' 	=> $id
				]);
				return view('peran.tbodyPeran',['peran' => $data, 'hakAkses' => $cekHakAkses]);
			}
		}
	}
}