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


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include 'navbar_admin.php'; ?>

  <div class="content-wrapper" style="padding: 20px">

    <div class="content-header">
      <div class="container-fluid">
      <form action="<?= base_url('admin/pindah_jadwal') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= esc($disetujui['id']) ?>">

            <div class="form-group">
                <label for="ruang">Pilih Ruang:</label>
                <select name="ruang" id="ruang" class="form-control" required>
                    <?php foreach ($ruang_list as $r): ?>
                        <option value="<?= $r['nama_ruang'] ?>"><?= $r['nama_ruang'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" name="tanggal" required>
            </div>

            <div class="form-group">
                <label for="waktu_mulai">Waktu Mulai:</label>
                <input type="time" class="form-control" name="waktu_mulai" required>
            </div>

            <div class="form-group">
                <label for="waktu_selesai">Waktu Selesai:</label>
                <input type="time" class="form-control" name="waktu_selesai" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?= base_url('/ruang_disetujui') ?>" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
    </div>
</div>

    
</script>
    <script src="<?= base_url('adminLTE/plugins/jquery/jquery.min.js') ?>"></script>

    <script src="<?= base_url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url('adminLTE/dist/js/adminlte.js') ?>"></script>

</body>
</html>