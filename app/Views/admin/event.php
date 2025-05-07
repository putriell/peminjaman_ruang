<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pengelolaan Aset </title>
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
        
        
    </style>   
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php include 'navbar_admin.php'; ?>
  <div class="content-wrapper" style="padding: 20px">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item" ><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Event</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-item-center">
            <button type="button" class="btn btn-block btn-primary mr-2" data-toggle="modal" data-target="#tambah-data">Tambah</button>
          </div>
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
                    <th>Ruang</th>
                    <th>Email</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Tindakan</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($event)) : ?>
                  <?php $no = 1 + (10 * ($page -1)); ?>
                   <?php foreach ($event as $row) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= esc($row['nama']) ?></td>
                      <td><?= esc($row['ruang']) ?></td>
                      <td><?= esc($row['email']) ?></td>
                      <td><?= esc($row['tanggal']) ?></td>
                      <td><?= esc($row['waktu_mulai']) ?> - <?= esc($row['waktu_selesai']) ?></td>
                      <td class="text-center" >
                      
                        <a href="<?=base_url('data_aset/edit/'.$row['id']) ?>" class="edit-data" >
                         <i class="fas fa-edit"></i></a>
                       <a href="#" data-href="<?= base_url('data_aset/hapus/'.$row['id']) ?>" onclick="confirmToDelete(this)">
                          <i class="fas fa-trash-alt pl-3"></i>
                        </a> 
                      </td>
                      

                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="7" class="text-center">Data tidak ditemukan</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
          </table>  
                  
    </div>  

    <div class="row">
              <div class="col-12">
                  <nav aria-label="Page navigation">
                  <?php 
                      $page = $page ?? 1;
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
    
    <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('/event/simpan') ?>" method="post" enctype="multipart/form-data" class=" p-4">
                    <div class="mb-3 ">
                            <label for="ruang" class="form-label">Pilih Ruang</label>
                            <select class="form-control" name="ruang" id="ruang" onchange="getKlasifikasi()" required>
                                <option value="">-Pilih ruang-</option>
                                <?php foreach ($ruang as $row) : ?>
                                    <?php $disabled = ($row['status'] == 'Tidak Tersedia') ? 'disabled' : ''; ?>
                                    <option value="<?= esc($row['nama_ruang']) ?>" <?= $disabled ?>>
                                        <?= esc($row['nama_ruang']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?= csrf_field(); ?>    
                    
                        <div class="mb-3">
                            <label for="klasifikasi" class="form-label">Klasifikasi:</label>
                            <input type="text" name="klasifikasi" id="klasifikasi" class="form-control mt-3" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal:</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control mt-3">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Waktu Mulai:</label>
                            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control mt-3">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Waktu Selesai:</label>
                            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control mt-3">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama:</label>
                            <input type="text" name="nama" class="form-control mt-3" placeholder="Enter here" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">NIM/NIP:</label>
                            <input type="text" name="nim" class="form-control mt-3" placeholder="Enter here" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Organisasi/Unit Kerja:</label>
                            <input type="text" name="organisasi" class="form-control mt-3" placeholder="Enter here"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Penanggung Jawab/PIC:</label>
                            <input type="text" name="penanggungjawab" class="form-control mt-3" placeholder="Enter here"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control mt-3"
                                placeholder="@mail.ugm.ac.id / @ugm.ac.id / @gmail.com / @gmail.co.id" required>
                            
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">NO.HP:</label>
                            <input type="text" name="nohp" class="form-control mt-3" placeholder="Enter here" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Tambahan Fasilitas:</label>
                            <textarea class="form-control mt-3" name="fasilitas" cols="50" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Keperluan:</label>
                            <textarea class="form-control mt-3" name="keperluan" cols="50" rows="3"></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" name="submit"
                                value=<?php echo date("h:i:sa"); ?>>Submit</button>
                        </div>


                    </form>
        </div>
      </div>
    </div>
   


 
  
    <script src="adminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="adminLTE/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="adminLTE/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="adminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="adminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="adminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="adminLTE/plugins/moment/moment.min.js"></script>
    <script src="adminLTE/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="adminLTE/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="adminLTE/plugins/select2/js/select2.full.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="adminLTE/dist/js/demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('adminLTE/plugins/jquery/jquery.min.js') ?>"></script>

    <script src="<?= base_url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url('adminLTE/dist/js/adminlte.js') ?>"></script>

</body>
</html>
