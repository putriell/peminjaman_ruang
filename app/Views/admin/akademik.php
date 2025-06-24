<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Ruang</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/custom/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">

</head>


<body">
 <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #004266;">
        <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mr-2" style="color:white"><?= session()->get('username') ?></span>
                    <i class="far fa-user fa-inverse" style="color:white;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ganti_password">Ganti Password</a>
                    <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                </div>
            </li>
        </ul>
    </div>
    </nav>
    

   <section class="container-fluid">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Jadwal</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-info">
                        <?= esc(session()->getFlashdata('pesan')) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('jadwal_kuliah/simpan') ?>" method="post">
                    
                    <?= csrf_field(); ?>

                    <div class="mb-3">
                        <label for="matkul" class="form-label">Mata Kuliah :</label>
                        <input type="text" name="matkul" class="form-control mt-3" placeholder="Enter here" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Dosen:</label>
                        <select class="form-control mt-3" name="nama" id="nama" required>
                            <option value="">- Pilih Akademik -</option>
                            <option value="Akademik S1">Akademik S1</option>
                            <option value="Akademik S2">Akademik S2</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="ruang" class="form-label">Pilih Ruang</label>
                        <select class="form-control" name="ruang" id="ruang" required>
                            <option value="">- Pilih ruang -</option>
                            <?php if (!empty($ruang_list)): ?>
                                <?php foreach ($ruang_list as $ruang): ?>
                                    <option value="<?= esc($ruang['id']) ?>"><?= esc($ruang['nama_ruang']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai:</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control mt-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai:</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control mt-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="waktu_mulai" class="form-label">Waktu Mulai:</label>
                        <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control mt-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="waktu_selesai" class="form-label">Waktu Selesai:</label>
                        <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control mt-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Kelas:</label>
                        <input type="text" name="jurusan" class="form-control mt-3" placeholder="Contoh: IF-07-A" required>
                    </div>

                    <div class="mb-3">
                        <label for="code" class="form-label">Mahasiswa:</label>
                        <input type="text" name="code" class="form-control mt-3" placeholder="Enter here" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>