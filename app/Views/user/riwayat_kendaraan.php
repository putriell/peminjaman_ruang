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
  <?php include 'navbar_user.php'; ?>

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
        <div class="table-responsive">
          <p>Peminjaman Kendaraan</p>
            <table id="example1" class="table table-bordered table-striped">
            <thead class="text-center">
              <tr>
                <th>No.</th>
                <th>Kendaraan</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Detail</th>
                
              </tr>
              </thead>
              <tbody>
                <?php if (!empty($permintaanKendaraan)) : ?>
                <?php $no = 1 + (5 * ($page -1));  ?>
                <?php foreach ($permintaanKendaraan as $row) : ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($row['kendaraan']) ?></td>
                <td><?= esc($row['tanggal_pinjam']) ?></td>
                <td><?= esc($row['tanggal_kembali']) ?></td>
                <td><?= esc($row['jam_pinjam']) ?> - <?= esc($row['jam_kembali']) ?> WIB </td>
                <td class="text-center"><?= esc($row['status']) ?></td>

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

                      <p>Kendaraan <?= esc($row['kendaraan']) ?></p>
                      <p>Unit Kerja: <?= esc($row['unit_kerja']) ?></p>
                      <p>Tanggal Pinjam: <?= esc($row['tanggal_pinjam']) ?></p>
                      <p>Tanggal Kembali: <?= esc($row['tanggal_kembali']) ?></p>
                      <p>Jam Pinjam: <?= esc($row['jam_pinjam']) ?></p>
                      <p>Jam Kembali: <?= esc($row['jam_kembali']) ?></p>
                      <p>Nama PIC: <?= esc($row['nama_pic']) ?></p>
                      <p>Keperluan: <?= esc($row['keperluan']) ?></p>
                      <p>Status: <?= esc($row['status']) ?></p>
                      
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
</div>

<div class="card-footer">
<div class="row">
  <div class="col-12">
      <nav aria-label="Page navigation">
      <?php 
          $perPageLinks = 3; 
          $startPage = (ceil($page / $perPageLinks) - 1) * $perPageLinks + 1;
          $endPage = min($startPage + $perPageLinks - 1, $totalPage);
          ?>
          <ul class="pagination">
          <?php if ($page > 1): ?>
              <li class="page-item">
                  <a class="page-link" href="?page=<?= $page - 1 ?>">« Prev</a>
              </li>
          <?php endif; ?>


          <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
              <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
              </li>
          <?php endfor; ?>

          <?php if ($page < $totalPage): ?>
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

