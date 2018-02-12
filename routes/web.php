<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ============ Profil =====================
Route::get('home','ProfilController@halamanProfil');
Route::get('ubahProfil/{id}','ProfilController@ubahProfil');
Route::get('ambilkota/{id}','ProfilController@ambilKota');
Route::get('ubahPassword','ProfilController@ubahPassword');
Route::post('proses-ubahprofil','ProfilController@prosesUbahProfil');
Route::post('uploadFoto','ProfilController@uploadFoto');
Route::post('proses-ubahPassword','ProfilController@prosesUbahPassword');

// ============= Login =====================
Route::get('login','LoginController@halamanLogin');
Route::post('proses-login','LoginController@prosesLogin');
Route::get('logout','LoginController@logout');

//============== Registrasi ================
Route::get('registrasi','RegistrasiController@halamanRegistrasi');
Route::post('proses-registrasi','RegistrasiController@prosesRegistrasi');
Route::get('konfirmasiEmail/{email}/{email_token}','RegistrasiController@konfirmasiEmail');

// =============== Kategori =================
Route::get('halamanKategori','KategoriController@halamanKategori');
Route::get('tambahKategori','KategoriController@tambahKategori');
Route::post('proses-tambahKategori','KategoriController@prosesTambahKategori');
Route::get('ubahKategori/{id}','KategoriController@ubahKategori');
Route::post('proses-ubahKategori/{id}','KategoriController@prosesUbahKategori');
Route::get('hapusKategori/{id}','KategoriController@hapusKategori');

//============== Jenis Kertas ===================
Route::get('halamanJenisKertas','JenisKertasController@halamanJenisKertas');
Route::get('tambahJenisKertas','JenisKertasController@tambahJenisKertas');
Route::post('proses-tambahJenisKertas','JenisKertasController@prosesTambahJenisKertas');
Route::get('ubahJenisKertas/{id}','JenisKertasController@ubahJenisKertas');
Route::post('proses-ubahJenisKertas/{id}','JenisKertasController@prosesUbahJenisKertas');
Route::get('hapusJenisKertas/{id}','JenisKertasController@hapusJenisKertas');

//================== Ukuran Kertas ================
Route::get('halamanUkuranKertas','UkuranKertasController@halamanUkuranKertas');
Route::get('tambahUkuranKertas','UkuranKertasController@tambahUkuranKertas');
Route::post('proses-tambahUkuranKertas','UkuranKertasController@ProsesTambahUkuranKertas');
Route::get('ubahUkuranKertas/{id}','UkuranKertasController@ubahUkuranKertas');
Route::post('proses-ubahUkuranKertas/{id}','UkuranKertasController@prosesUbahUkuranKertas');
Route::get('hapusUkuranKertas/{id}','UkuranKertasController@hapusUkuranKertas');

// ================== Pengguna =======================
Route::get('Pengguna/{menuid}','PenggunaController@halamanPengguna');
Route::get('tambahPengguna/{menuid}','PenggunaController@tambahPengguna');
Route::post('proses-tambahPengguna/{menuid}','PenggunaController@prosesTambahPengguna');
Route::get('ubahPengguna/{id}/{menuid}','PenggunaController@ubahPengguna');
Route::post('proses-ubahPengguna/{id}/{menuid}','PenggunaController@prosesUbahPengguna');
Route::get('hapusPengguna/{menuid}','PenggunaController@hapusPengguna');
Route::get('ubahPeranPengguna/{menuid}','PenggunaController@ubahPeranPengguna');
Route::post('proses-ubahPeranPengguna/{menuid}','PenggunaController@prosesUbahPeranPengguna');
Route::get('cariPeranPengguna','PenggunaController@cariPeranPengguna');
Route::get('entri','PenggunaController@entriPeranPengguna');

// ================ Halaman peran ===========================
Route::get('Peran/{menuid}','PeranController@halamanPeran');
Route::get('tambahPeran/{menuid}','PeranController@tambahPeran');
Route::post('proses-tambahPeran/{menuid}','PeranController@prosesTambahPeran');
Route::get('ubahPeran/{id}/{menuid}','PeranController@ubahPeran');
Route::post('proses-ubahPeran/{id}/{menuid}','PeranController@prosesUbahPeran');
Route::get('hapusPeran/{menuid}','PeranController@hapusPeran');