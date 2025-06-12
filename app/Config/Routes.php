<?php
namespace Config;
use CodeIgniter\Router\RouteCollection;
$routes = Services::routes();



/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/informasi_ruang', 'Ruang::index');
$routes->get('/jadwal_ruang', 'Jadwal::ruang');
$routes->get('login', 'Auth::index');
$routes->get('/logout', 'Auth::logout');
$routes->post('login/auth', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('register/store', 'Auth::store');
$routes->get('/dashboard_admin', 'DataAdmin::index');
$routes->get('/jadwal_ruang_admin', 'DataAdmin::jadwalHariIni');
$routes->get('/ruang_disetujui', 'DataAdmin::disetujui');
$routes->get('/ruang_ditolak', 'DataAdmin::ditolak'); 
$routes->post('/user/simpan', 'User::simpan');
$routes->get('/user', 'User::index');
$routes->get('/user/hapus/(:num)', 'User::hapus/$1');
$routes->get('/user/search', 'User::search');
$routes->get('/aktivasi_user', 'User::aktivasi_akun');
$routes->get('/user/reset_password/(:num)', 'User::reset_password/$1');
$routes->post('/user/simpan', 'User::simpan');
$routes->post('user/ganti_password', 'User::ganti_password');
$routes->get('/form_peminjaman_ruang', 'Ruang::formPeminjaman');
$routes->post('/form_peminjaman_ruang/simpan', 'Ruang::simpan');
$routes->get('get_klasifikasi/(:any)', 'Ruang::getKlasifikasi/$1');
$routes->post('/admin/reject', 'DataAdmin::reject');
$routes->post('/admin/approve', 'DataAdmin::approve');
$routes->post('/admin/hapus', 'DataAdmin::hapus');
$routes->get('admin/form_pindah_jadwal/(:num)', 'DataAdmin::formPindahJadwal/$1');
$routes->post('admin/pindah_jadwal', 'DataAdmin::pindah_jadwal');
$routes->get('/event', 'Event::index');
$routes->post('/event/simpan', 'Event::simpan');
$routes->get('/event/get_klasifikasi/(:any)', 'Event::getKlasifikasi/$1');
$routes->get('/dashboard_user', 'DataUser::index');
$routes->get('/jadwal_ruang_user', 'DataUser::jadwalHariIni');
$routes->get('informasi_kendaraan', 'Kendaraan::index');
$routes->get('/form_kendaraan', 'Kendaraan::formPeminjaman');
$routes->post('/form_kendaraan/simpan', 'Kendaraan::simpan');
$routes->get('/kendaraan_menunggu', 'DataAdmin::menunggu_kendaraan');
$routes->get('/kendaraan_disetujui', 'Kendaraan::disetujui_kendaraan');
$routes->get('/kendaraan_ditolak', 'Kendaraan::ditolak_kendaraan'); 
$routes->post('/kendaraan/reject', 'Kendaraan::reject_kendaraan');
$routes->post('/kendaraan/approve', 'Kendaraan::approve_kendaraan');
$routes->post('/kendaraan/hapus', 'Kendaraan::hapus');
$routes->get('ruang_disetujui/search', 'DataAdmin::search_disetujui');
$routes->get('ruang_ditolak/search', 'DataAdmin::search_ditolak');