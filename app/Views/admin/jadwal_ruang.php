<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Peminjaman Ruang</title>

  <link rel="stylesheet" href="<?= base_url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')?>">
  <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/adminlte.min.css')?>">
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
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#peminjaman" data-toggle="tab">Jadwal peminjaman</a></li>
          <li class="nav-item"><a class="nav-link" href="#kuliah" data-toggle="tab">Jadwal Kuliah</a></li>
          <li class="nav-item"><a class="nav-link" href="#dipesan" data-toggle="tab">Ruangan Dipesan</a></li>
          <li class="nav-item"><a class="nav-link" href="#event" data-toggle="tab">Jadwal Event</a></li>
        </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="peminjaman">
              <p>Jadwal Peminjaman</p>
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>No Identitas</th>
                      <th>Ruangan</th>
                      <th>Jam</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1 ?>
                      <?php foreach ($jadwal_peminjaman as $jp): ?>
                            <tr>
                            <td><?= $no++ ?></td>
                                <td><?= esc($jp['nama']) ?></td>
                                <td><?= esc($jp['nim']) ?></td>
                                <td><?= esc($jp['ruang']) ?></td>
                                <td><?= $jp['waktu_mulai'] ?> - <?= $jp['waktu_selesai'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                  </tbody>
                </table>        
               </div> 
               <div class="tab-pane" id="kuliah">
              <p>Jadwal Kuliah</p>
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                    <tr>
                      <th>No.</th>
                      <th>Mata Kuliah</th>
                      <th>Dosen</th>
                      <th>Ruangan</th>
                      <th>Jam</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    <?php $no = 1 ;  ?>
                      <?php foreach ($jadwal_kuliah as $jk): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($jk['matkul']) ?></td>
                                <td><?= esc($jk['nama']) ?></td>
                                <td><?= esc($jk['ruang']) ?></td>
                                <td><?= $jk['waktu_mulai'] ?> - <?= $jk['waktu_selesai'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                  </tbody>
                </table> 
                    
               </div> 
               <div class="tab-pane" id="dipesan">
              <p>Ruangan yang Dipesan</p>
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>No. Identitas</th>
                      <th>Ruangan</th>
                      <th>Tanggal</th>
                      <th>Jam</th>  
                      <th>Aksi</th>  
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1 ?>
                      <?php foreach ($ruangan_dipesan as $rd): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($rd['nama']) ?></td>
                                <td><?= esc($rd['nim']) ?></td>
                                <td><?= esc($rd['ruang']) ?></td>
                                <td><?= esc($rd['tanggal']) ?></td>
                                <td><?= $rd['waktu_mulai'] ?> - <?= $rd['waktu_selesai'] ?></td>
                                <td>
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?= $rd['id'] ?>"> Detail</button>
                                </td>
                              </tr>
                        <?php endforeach; ?>
                  </tbody>
                </table>        
               </div> 
               <div class="tab-pane" id="event">
              <p>Jadwal Event</p>
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                    <tr>
                      <th>No.</th>
                      <th>Nama ruang</th>
                      <th>Tanggal</th>
                      <th>Waktu</th>
                      <th>Lampiran</th>
                      <th>Detail</th>  
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>1</th>
                      <th>Nama Aset</th>
                      <th>Kode Aset</th>
                      <th>Jenis Aset</th>
                      <th>Unit</th>
                      <th>Kondisi</th>   
                    </tr>
                </table>        
               </div> 
            </div>

                    
                </div>
                </div>
                </div>
        </div>
        </div>
        </div>
    
<script src="<?= base_url('adminLTE/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/dist/js/adminlte.min.js') ?>"></script>

</body>
</html>

