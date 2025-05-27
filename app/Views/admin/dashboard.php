<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Peminjaman Ruang </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/jqvmap/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/adminlte.min.css?v=3.2.0') ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/daterangepicker/daterangepicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/summernote/summernote-bs4.min.css')?>">
     <style>
        
        .table thead {
          background-color: #083D62;
          color: white;
        }
        .table tbody tr:nth-child(odd){
          background-color: #F0F9FF;
        }
        
        .small-box {
          padding-top: 12px; 
        }
        .small-box .inner {
            text-align: center;
        }
        .btn-success{
          margin-left: -150px
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
            <p> Daftar Pengajuan Menunggu Untuk Disetujui </p>
          </div>
        </div>
      </div>
    </div>
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead class="text-center">
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Ruang</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lampiran</th>
                    <th>Detail</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($permintaan)) : ?>
                    <?php $no = 1 + (5 * ($page -1));  ?>
                    <?php foreach ($permintaan as $row) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['nama']) ?></td>
                    <td><?= esc($row['ruang']) ?></td>
                    <td><?= esc($row['tanggal']) ?></td>
                    <td><?= esc($row['waktu_mulai']) ?> - <?= esc($row['waktu_selesai']) ?> WIB </td>
                    <td> <a href="<?= base_url('uploads/' . $row['lampiran']) ?>" target="_blank"> <?= esc($row['lampiran']) ?></a>
                    </td>
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
                          <p>NIM/NIP: <?= esc($row['nim']) ?></p>
                          <p>Organisasi: <?= esc($row['organisasi']) ?></p>
                          <p>Penanggung Jawab: <?= esc($row['penanggungjawab']) ?></p>
                          <p>Email: <?= esc($row['email']) ?></p>
                          <p>NO.HP: <?= esc($row['nohp']) ?></p>
                          <p>Ruang: <?= esc($row['ruang']) ?></p>
                          <p>Tanggal: <?= esc($row['tanggal']) ?></p>
                          <p>Waktu: <?= esc($row['waktu_mulai']) ?> - <?= esc($row['waktu_selesai']) ?> WIB</p>
                          <p>Fasilitas: <?= esc($row['fasilitas']) ?></p>
                          <p>Keperluan: <?= esc($row['keperluan']) ?></p>
                          <div class="d-flex justify-content-between align-items-center">
                          <form action="<?= base_url('/admin/approve') ?>" method="post">
                          <input type="hidden" name="id[]" value="<?= esc($row['id']) ?>">
                            <button type="submit" class="btn btn-success">Setujui</button>
                          </form>
                          <form action="<?= base_url('/admin/reject') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id[]" value="<?= esc($row['id']) ?>">
                            
                            <!-- Tombol "Tolak" -->
                            <button type="button" class="btn btn-danger float-right"
                                data-toggle="modal"
                                data-target="#rejectModal<?= esc($row['id']) ?>">Tolak</button>
                            
                            <!-- Modal Konfirmasi Penolakan -->
                            <div class="modal fade" id="rejectModal<?= esc($row['id']) ?>"
                                tabindex="-1" role="dialog"
                                aria-labelledby="rejectModalLabel<?= esc($row['id']) ?>"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel<?= esc($row['id']) ?>">
                                                Konfirmasi Penolakan
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
                     </div>
                    </div>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
          </table>           
    </div>  
    </div>
    <div class="card-footer">
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

