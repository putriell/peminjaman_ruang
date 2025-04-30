<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Peminjaman Ruang </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/adminlte.min.css') ?>">

     <style>
        /* Tambahkan ini ke file CSS kustom Anda */
        .ugm {
            background-color: #083D62 !important; /* Warna biru UGM */
            color: #ffffff; /* Warna teks putih agar kontras */
        }

        /* Jika Anda ingin mengubah warna teks link di sidebar */
        .ugm .nav-link {
            color: #ffffff; /* Warna link */
        }

        .ugm .nav-link:hover {
            background-color: #0A4E8A; /* Warna saat hover */
        }
        
        .main-sidebar{
          background-color: #ffffff;
        }
        .nav-sidebar .nav-link {
          color: #333333; /* Mengatur warna teks menjadi gelap */
        }
        .nav-sidebar .nav-link:hover {
            background-color: #f0f0f0; /* Warna latar belakang saat hover */
            color: #0A4E8A;
        }
        .nav-icon {
            color: #333333; /* Mengatur warna ikon menjadi gelap */
        }
        .logo-container {
            display: flex; /* Menggunakan flexbox untuk menempatkan gambar berdampingan */
            align-items: center; /* Memastikan gambar terpusat secara vertikal */
        }

        .logo-container {
            max-width: 100%; 
            height: auto; /* Menjaga rasio aspek gambar */
            margin-left: 5px; /* Menambahkan jarak antara gambar */
        }
        .logo-container img {
            width: 100px; 
            height: auto;
            padding-left: 10px;
            margin-top: -15px;
        } 
        
    </style>   
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand ugm navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars fa-inverse"> </i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Menampilkan nama user -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2" style="color:white"><?= session()->get('username') ?></span>  
                  <i class="far fa-user fa-inverse" style="color:white;"></i> 
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item"  data-toggle="modal" data-target="#ganti_password">Ganti Password</a>
                    <a class="dropdown-item" href="logout">Logout</a>
                </div>
            </li>
        </ul>
  </nav>
  <aside class="main-sidebar sidebar-light elevation-4">
    <!-- Brand Logo -->
    <div class="logo-container">
    
      <img src="<?= base_url('adminLTE/dist/img/ugm/logo.png') ?>" alt="Logo" class="img-fluid logo" style="opacity: .8">
    </div>
    

    <!-- Sidebar -->
    
  <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="<?=base_url('dashboard_admin') ?>" class="nav-link <?= (uri_string() =='dashboard_admin' || uri_string() == 'data_aset/search') ? 'active' : '' ?>">
               <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Menunggu Persetujuan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('dashboard_admin') ?>" class="nav-link <?= (uri_string() =='dashboard_admin' || uri_string() == 'data_aset/search') ? 'active' : '' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('data_aset') ?>" class="nav-link <?= (uri_string() =='data_aset' || uri_string() == 'data_aset/search') ? 'active' : '' ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kendaraan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('jadwal_ruang_admin') ?>" class="nav-link <?= (uri_string() =='jadwal_ruang_admin' || uri_string() == 'data_aset/search') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Jadwal Hari ini
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('ruang_disetujui') ?>" class="nav-link <?= (uri_string() =='ruang_disetujui' || uri_string() == 'data_aset/search' || uri_string() == 'admin/form_pindah_jadwal/(:num)') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                Disetujui
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('ruang_ditolak') ?>" class="nav-link <?= (uri_string() =='ruang_ditolak' || uri_string() == 'data_aset/search') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-times"></i>
              <p>
              Ditolak
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('event') ?>" class="nav-link <?= (uri_string() =='event' || uri_string() == 'data_aset/search') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-calendar-week"></i>
              <p>
                Event
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="<?=base_url('user') ?>" class="nav-link <?= (uri_string() =='user' || uri_string() == 'user/search') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          </ul>
      </nav>
    </div>
  </aside>
</div>
<div class="modal fade" id="ganti_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="ganti_password" action="<?= base_url('user/ganti_password') ?>" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label for="password"> Password lama</label>
                <input type="password" class="form-control" id="nama" name="password_lama" placeholder="Masukkan password lama" required>
              </div>
              <div class="form-group">
                <label for="password">Password baru</label>
                <input type="password" class="form-control" id="kode" name="password_baru" placeholder="Masukkan password baru" required>
              </div>
              <div class="form-group">
                <label for="password">Ulangi Password baru</label>
                <input type="password" class="form-control" id="kode" name="konfirmasi_password" placeholder="Ulangi password baru" required>
              </div>
              
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>


