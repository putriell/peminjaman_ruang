<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pengelolaan Aset </title>
    <!-- Font Awesome -->

    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/custom/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #004266;">
        <div class="container-fluid">
            <img src="<?= base_url('adminLTE/dist/img/ugm/logo-putih.png') ?>" alt="Avatar Logo" style="width:100px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://geo.ugm.ac.id/visi-misi/">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal"
                            data-bs-target="#ketentuanModal">Ketentuan</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#prosedurModal">Prosedur</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Informasi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="informasi_kendaraan">Informasi Kendaraan</a></li>
                            <li><a class="dropdown-item" href="informasi_ruang">Informasi Ruangan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Jadwal
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="jadwal-kendaraan.php">Jadwal Kendaraan</a></li>
                            <li><a class="dropdown-item" href="jadwal_ruang">Jadwal Ruangan</a></li>
                        </ul>
                    </li>
                   <?php if (session()->get('logged_in')): ?>
                    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Pengajuan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <?php 
                                if (session()->get('status') == 'tendik') { 
                                ?>
                                    <li><a class="dropdown-item" href="form_kendaraan">Peminjaman Kendaraan</a></li>
                                <?php 
                                } 
                                ?>

                                <li><a class="dropdown-item" href="form_peminjaman_ruang">Peminjaman Ruangan</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if (!session()->get('logged_in')): ?> 
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                        </li>
                    <?php endif; ?>
                    <?php if (session()->get('logged_in')): ?> 
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('dashboard_user') ?>">Riwayat</a>
                        </li>
                    <?php endif; ?>

                </ul>
                <?php if (session()->get('logged_in')): ?>
                <ul class="navbar-nav ml-auto mr-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2" style="color:white"><?= session()->get('username') ?></span>  
                        <i class="far fa-user fa-inverse" style="color:white;"></i> 
                        </a>
                        <div class="dropdown-menu dropdown-menu-righ mr-6" aria-labelledby="userDropdown">
                            <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#ganti_password">Ganti Password</a>
                            <a class="dropdown-item" href="logout" >Logout</a>
                        </div>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="ganti_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Ganti Password</h5>
            
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

    </body>
    </html>