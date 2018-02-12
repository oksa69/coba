<?php
namespace App\Http\Controllers;
use App\Models\ModelPengguna;
use App\Models\ModelPeran;
use App\Models\ModelViewPeranPengguna;
use App\Models\ModelViewHakAkses;
use App\Models\ModelProvinsi;
use App\Models\ModelKota;
use App\Models\ModelPeranPengguna;
use App\Models\ModelAktivitasPengguna;
use Illuminate\Support\Str;
use Mail;
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
use Respone;

/**
* 
*/
class PenggunaController extends Controller
{
// =================== HALAMAN PENGGUNA ==============================	
	public function halamanPengguna($menuid)
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		else{
			$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
			->where('menuid',$menuid)
			->first();
			//dd($cekHakAkses['tampil']);
			if ($cekHakAkses['tampil'] == 'YA') {
				if (Session::get('peranid') == '1') {
					$data = ModelViewPeranPengguna::where('peranid','!=','1')->paginate(10) ;
				}else{
					$data = ModelViewPeranPengguna::where('peranid','!=','1')
					->where('peranid','!=','2')
					->paginate(10) ;
				}
				$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
				->where('menuid',$menuid)
				->get();
				return view('pengguna.tampil', ['pengguna' => $data, 'hakAkses' => $cekHakAkses]);
			} else {
				return redirect('home');
			}
			
		}
	}

// ===================== HALAMAN TAMBAH PENGGUNA ==============================
	public function tambahPengguna($menuid)
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		else{
			$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
			->where('menuid',$menuid)
			->first();
			if ($cekHakAkses['tampil'] == 'YA' && $cekHakAkses['tambah'] == 'YA') {
				if (Session::get('peranid') == '1') {
					$peran = ModelPeran::where('id','!=','1')->get();
				} else {
					$peran = ModelPeran::where('id','!=','1')->where('id','!=','2')->get();
				}
				$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
				->where('menuid',$menuid)
				->get();
				return view('pengguna.tambah', ['peran' => $peran, 'hakAkses' => $cekHakAkses]);
			} else {
				return redirect('home');
			}
		}
	}

	public function prosesTambahPengguna($menuid)
	{
		$validator = Validator::make(Request::all(), [
			'namadepan'     => 'required',  
			'email'     => 'required|email',  
			'peran'     => 'required',  
		]);

		// jika validasinya benar
		if ($validator->fails()) 
		{

			//maka akan dikembalikan
			return redirect()->back()->withErrors($validator)->withInput();
		}

		// jika validasinya salah
		else {

			$cek = ModelPengguna::where('email', Request::input('email'))->first();
			if (empty($cek)) {
				$data = [
					'namadepan' => Request::input('namadepan')
					,'namabelakang' => Request::input('namabelakang')
					,'email' => Request::input('email')
					,'email_token'	=> Str::random(40)
				];
				Mail::send('verifyUser',$data,function($message) use ($data)
				{
					$message->to($data['email']);
					$message->subject('Konfirmasi Email');
				});
				$tambah = ModelPengguna::create($data);
				ModelPeranPengguna::where('penggunaid',$tambah->id)->update([
					'peranid' => Request::input('peran'),
				]);
				$cariPengguna = ModelViewPeranPengguna::where('penggunaid',Session::get('id'))->first();
				ModelAktivitasPengguna::create([
					'namadepan' => $cariPengguna['namadepan'],
					'email' 	=> $cariPengguna['email'],
					'menuid' 	=> $menuid,
					'aktivitas' => 'TAMBAH',
					'targetid' 	=> $tambah->id,
				]);
				Alert::success('Data anda telah tersimpan','Berhasil');
				return redirect('Pengguna/'.$menuid);
			}
			else {
				Alert::confirmButton()->warning('Email sudah terdaftar','Peringatan');
				return redirect()->back()->withInput();
			}
		}
	}

// ========================= HALAMAN UBAH PENGGUNA ===============================
	public function ubahPengguna($id, $menuid)
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		else {
			$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
			->where('menuid',$menuid)
			->first();
			if ($cekHakAkses['tampil'] == 'YA' && $cekHakAkses['ubah'] == 'YA') {
				if (Session::get('peranid') == '1') {
					$peran = ModelPeran::where('id','!=','1')->get();
				} else {
					$peran = ModelPeran::where('id','!=','1')->where('id','!=','2')->get();
				}
				$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
				->where('menuid',$menuid)
				->get();
				$pengguna = ModelViewPeranPengguna::where('penggunaid',$id)->first();
				return view('pengguna.ubah', ['pengguna' => $pengguna, 'peran' => $peran, 'hakAkses' => $cekHakAkses]);
			} else{
				return redirect('home');
			}
		}
	}

	public function prosesUbahPengguna($id, $menuid)
	{
		$validator = Validator::make(Request::all(), [
			'namadepan'     => 'required',  
			'email'     	=> 'required|email',  
			'peran'     	=> 'required',  
		]);

		// jika validasinya benar
		if ($validator->fails()) 
		{

			//maka akan dikembalikan
			return redirect()->back()->withErrors($validator)->withInput();
		}

		// jika validasinya salah
		else {

			$cek = ModelPengguna::where('id','!=',$id)
			->where('email', Request::input('email'))
			->first();
			if (empty($cek)) {
				ModelPengguna::find($id)->update([
					'namadepan'		=> Request::input('namadepan')
					,'namabelakang' => Request::input('namabelakang')
				]);
				ModelPeranPengguna::where('penggunaid',$id)->update([
					'peranid' => Request::input('peran')
				]);
				$cariPengguna = ModelViewPeranPengguna::where('penggunaid',Session::get('id'))->first();
				ModelAktivitasPengguna::create([
					'namadepan' => $cariPengguna['namadepan'],
					'email' 	=> $cariPengguna['email'],
					'menuid' 	=> $menuid,
					'aktivitas' => 'UBAH',
					'targetid' 	=> $id,
				]);
				Alert::success('Data anda telah tersimpan','Berhasil');
				return redirect('Pengguna/'.$menuid);
			}
			else {
				Alert::confirmButton()->warning('Email anda telah terdaftar','Peringatan');
				return redirect()->back()->withInput();
			}
		}
	}

// =============================== HALAMAN UBAH PERAN PENGGUNA =====================================
	public function ubahPeranPengguna($menuid)
	{
		if (Session::get('id') =='' || Session::get('aksi') != 'AKTIF') {
			return redirect('login');
		}
		else{
			$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
			->where('menuid',$menuid)
			->first();
			if ($cekHakAkses['tampil'] == 'YA' && $cekHakAkses['ubah'] == 'YA') {
				if (Session::get('peranid') == '1') {
					$data = ModelViewPeranPengguna::where('peranid','!=','1')->paginate(10);
					$peran = ModelPeran::where('id','!=','1')->get();
				}
				else{
					$data = ModelViewPeranPengguna::where('peranid','!=','1')
					->where('peranid','!=','2')
					->paginate(10);
					$peran = ModelPeran::where('id','!=','1')->where('id','!=','2')->get();
				}

				$cekHakAkses = ModelViewHakAkses::where('peranid',Session::get('peranid'))
				->where('menuid',$menuid)
				->get();

				return view('pengguna.ubahPeranPengguna', ['pengguna' => $data, 'hakAkses' => $cekHakAkses, 'peran' => $peran]);
			} else {
				return redirect('home');
			}
		}		
	}


	public function prosesUbahPeranPengguna($menuid)
	{
		$validator = Validator::make(Request::all(), [
			'peran'     => 'required',  
		]);

		// jika validasinya benar
		if ($validator->fails()) 
		{

			//maka akan dikembalikan
			return redirect()->back()->withErrors($validator)->withInput();
		}
		else {
			$pengguna= ModelViewPeranPengguna::all();
			foreach ($pengguna as $key) {
				$id = Request::input($key['penggunaid'].'_pengguna') == null ? '' : $key['penggunaid'];
				ModelPeranPengguna::where('penggunaid',$id)->update([ 
					'peranid'  => Request::input('peran'), 
				]);
			}
			Alert::success('Data anda telah terubah','Berhasil');
			return redirect('Pengguna/'.$menuid);
		}
	}

// ========================== PENCARIAN PENGGUNA =====================================
	public function cariPeranPengguna()
	{		
		Request::get('entri') != '' ? $entri = 10 : $entri = Request::get('entri');
		$cari = Request::input('cari');
		$hasilCari = '';
		$peranPengguna ='';
		if (Session::get('peranid') == '1') {
			$peranPengguna = ModelViewPeranPengguna::where('peranid','!=','1')
			->search($cari)
			->paginate($entri);
		}else{
			$peranPengguna = ModelViewPeranPengguna::where('peranid','!=','1')
			->where('peranid','!=','2')
			->search($cari)
			->paginate($entri);
		}
		// ==============================================================
		if ($peranPengguna) {
			foreach ($peranPengguna as $row) {
				$hasilCari.='<tr>'.
				'<td align=center>'.
				'<input style=margin-left:-0.25rem; class=form-check-input name=' .$row->penggunaid. '_pengguna type=checkbox>'.
				'<td>'. $row->namadepan .
				'<td>'. $row->namabelakang .
				'<td>'. $row->email .
				'<td>'. $row->peran .
				'<tr>';
			}
			return response()->json($hasilCari);
		}
	}

// ====================================================================== 
	public function entriPeranPengguna()
	{
		if (Request::ajax()) {
			$entri = Request::input('entri');
			$hasilEntri = "";
			if (Session::get('peranid') == '1') {
				$peranPengguna = ModelViewPeranPengguna::where('peranid','!=','1')->paginate($entri) ;
			}else{
				$peranPengguna = ModelViewPeranPengguna::where('peranid','!=','1')
				->where('peranid','!=','2')
				->paginate($entri) ;
			}
			// ====================================================
			if ($peranPengguna) {
				foreach ($peranPengguna as $row) {
					$hasilEntri.='<tr>'.
					'<td align=center>'.
					'<input style=margin-left:-0.25rem; class=form-check-input name=' .$row->penggunaid. '_pengguna type=checkbox>'.
					'<td>'. $row->namadepan .
					'<td>'. $row->namabelakang .
					'<td>'. $row->email .
					'<td>'. $row->peran .
					'<tr>';
				}
				return json_encode($hasilEntri);
			}
		}
	}
	
// ========================== HAPUS PENGGUNA ===============================
	public function hapusPengguna($menuid)
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
				ModelPengguna::find($id)->delete();
				if (Session::get('peranid') == '1') {
					$pengguna = ModelViewPeranPengguna::where('peranid','!=','1')->paginate(10) ;
				}else{
					$pengguna = ModelViewPeranPengguna::where('peranid','!=','1')
					->where('peranid','!=','2')
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

				$data = array('pengguna' => $pengguna, 'hakAkses' => $cekHakAkses);
				return view('pengguna.tbodyPengguna',$data);
			}
		}
	}
}	
?>