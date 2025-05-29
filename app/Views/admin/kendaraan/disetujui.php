<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Peminjaman Ruang </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/adminlte.min.css?v=3.2.0') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/summernote/summernote-bs4.min.css')?>">
     <style>
        /* Tambahkan ini ke file CSS kustom Anda */
        
        .table thead {
          background-color: #083D62;
          color: white;
        }
        .table tbody tr:nth-child(odd){
          background-color: #F0F9FF;
        }
        .table tbody tr:nth-child(even){
          background-color: #ffffff;
        }
        .small-box {
          padding-top: 12px; /* Tambahkan padding jika diperlukan */
        }
        .small-box .inner {
            text-align: center; /* Memusatkan teks di dalam box */
        }
        .btn-success{
          margin-left: -130px
        }
        
    </style>   
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?= view('admin/navbar_admin') ?>

  <div class="content-wrapper" style="padding: 20px">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <p> Daftar Pengajuan Disetujui</p>
          </div>
        </div>
      </div>
    </div>
  

    <!-- Main content -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
        <div class="form-group mx-auto" style="max-width:500px; padding-top: 20px; ">
            <form action="<?= base_url('data_aset/search') ?>" method="get">
                <div class="input-group input-group-lg">
                    <input type="search" name="keyword" class="form-control form-control-lg" placeholder="Type your keywords here" value="<?= isset($keyword) ? esc($keyword) : '' ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                </div>
              </form>
            </div>
            </div>
              <!-- /.card-header -->
        <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead class="text-center">
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kendaraan</th>
                    <th>No HP</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Detail</th>  
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php if (!empty($disetujui)) : ?>
                      <?php $no = 1 + (5 * ($page -1));  ?>
                    <?php foreach ($disetujui as $row) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['nama']) ?></td>
                    <td><?= esc($row['kendaraan']) ?></td>
                    <td><?= esc($row['no_hp']) ?></td>
                    <td><?= esc($row['tanggal_pinjam']) ?> - <?= esc($row['tanggal_kembali']) ?></td>
                    <td><?= esc($row['jam_pinjam']) ?> - <?= esc($row['jam_kembali']) ?> WIB </td>
                    <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?= $row['id'] ?>"> Detail</button>
                    </td>
                  </tr>
                  </tbody>
                  <div class="modal fade" id="myModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="myModalLabel">Detail Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">

                          <p>Nama: <?= esc($row['nama']) ?></p>
                           <p>NO.HP: <?= esc($row['no_hp']) ?></p>
                          <p>Tanggal Pinjam: <?= esc($row['tanggal_pinjam']) ?></p>
                          <p>Tanggal Kembali: <?= esc($row['tanggal_kembali']) ?></p>
                          <p>Jam Pinjam: <?= esc($row['jam_pinjam']) ?></p>
                          <p>Jam Kembali: <?= esc($row['jam_kembali']) ?></p>
                          <p>Kendaraan: <?= esc($row['kendaraan']) ?></p>
                          <p> Status: <?= esc($row['status']) ?></p>
                          <p> Unit Kerja: <?= esc($row['unit_kerja']) ?> </p>
                          <p> Nama PIC: <?= esc($row['nama_pic']) ?></p>
                          <p>Keperluan: <?= esc($row['keperluan']) ?></p>
                         <p> Lampiran: <?= esc($row['lampiran']) ?></p>
                          
                          <div class="d-flex justify-content-between align-items-center">
                          
                          <form action="<?= base_url('admin/pindah_jadwal') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id[]" value="<?= esc($row['id']) ?>">
                            
                            
                            <a href="<?= base_url('admin/form_pindah_jadwal/' . esc($row['id'])) ?>" class="btn btn-success">
                                Pindah Jadwal
                            </a>
                            </form>

                            
                            

                        <form action="<?= base_url('/admin/hapus') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id[]" value="<?= esc($row['id']) ?>">
                            
                            <!-- Tombol "Tolak" -->
                            <button type="button" class="btn btn-danger float-right"
                                data-toggle="modal"
                                data-target="#rejectModal<?= esc($row['id']) ?>">Hapus</button>
                            
                            <!-- Modal Konfirmasi Penolakan -->
                            <div class="modal fade" id="rejectModal<?= esc($row['id']) ?>"
                                tabindex="-1" role="dialog"
                                aria-labelledby="rejectModalLabel<?= esc($row['id']) ?>"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel<?= esc($row['id']) ?>">
                                                Konfirmasi Hapus
                                            </h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Input alasan penolakan -->
                                            <div class="form-group">
                                                <label for="alasan_penolakan<?= esc($row['id']) ?>">Alasan Penolakan:</label>
                                                <textarea class="form-control"
                                                    id="alasan_penolakan<?= esc($row['id']) ?>"
                                                    name="alasan_penolakan"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <!-- Tombol "Tolak" yang sebenarnya -->
                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    </div>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
          </table> 
          <div class="row">
              <div class="col-12">
                  <nav aria-label="Page navigation">
                  <?php 
                      $perPageLinks = 3; // Menampilkan 3 angka per tampilan pagination
                      $startPage = (ceil($page / $perPageLinks) - 1) * $perPageLinks + 1;
                      $endPage = min($startPage + $perPageLinks - 1, $totalPages);
                      ?>
                      <ul class="pagination">
                      <?php if ($page > 1): ?>
                          <li class="page-item">
                              <a class="page-link" href="?page=<?= $page - 1 ?>">« Prev</a>
                          </li>
                      <?php endif; ?>

                      <!-- Menampilkan halaman dalam kelompok 3 -->
                      <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                          <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                              <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                          </li>
                      <?php endfor; ?>

                      <!-- Tombol Next -->
                      <?php if ($page < $totalPages): ?>
                          <li class="page-item">
                              <a class="page-link" href="?page=<?= $page + 1 ?>">Next »</a>
                          </li>
                      <?php endif; ?>
                  </ul>
                  </nav>
              </div>
          </div>          
    </div>  
</script>
    <script src="<?= base_url('adminLTE/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('adminLTE/dist/js/adminlte.js') ?>"></script>

</body>
</html>

