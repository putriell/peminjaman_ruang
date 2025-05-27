<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Ruang</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <?php include 'navbar.php'; ?>

    <!-- ISI KONTEN -->
    <section class="container-fluid">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Formulir Peminjaman Kendaraan</h4>
                </div>
                <div class="card-body">
                <?php if (!empty($pesan)) : ?>
                    <div class="alert alert-info">
                        <?= esc($pesan) ?>
                    </div>
                <?php endif; ?>
                    <form action="<?= base_url('form_kendaraan/simpan') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" name="id_user" value="<?= session()->get('id_user') ?>">
                    </div>

                    <div class="mb-3">
                            <label for="nama" class="form-label">Nama:</label>
                            <input type="text"  value="<?= session()->get('username') ?>" class="form-control mt-3" readonly class="form-control">
                        </div>

                    
                    <?= csrf_field(); ?>    

                        <div class="mb-3">
                            <label for="unit_kerja" class="form-label">Unit Kerja :</label>
                            <input type="text" name="unit_kerja" class="form-control mt-3" placeholder="Enter here"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pic" class="form-label">Nama PIC:</label>
                            <input type="text" name="nama_pic" class="form-control mt-3" placeholder="Enter here"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP:</label>
                            <input type="text" name="no_hp" class="form-control mt-3" placeholder="Enter here"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam:</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control mt-3">
                        </div>
                        <div class="mb-3">
                            <label for="jam_pinjam" class="form-label">Jam pinjam:</label>
                            <input type="time" name="jam_pinjam" id="jam_pinjam" class="form-control mt-3">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali:</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control mt-3">
                        </div>
                        <div class="mb-3">
                            <label for="jam_kembali" class="form-label">Jam Kembali:</label>
                            <input type="time" name="jam_kembali" id="jam_kembali" class="form-control mt-3">
                        </div>
                        <div class="mb-3">
                            <label for="keperluan">Keperluan:</label>
                            <textarea class="form-control mt-3" name="keperluan" cols="50" rows="3"></textarea>
                        </div>
                       <div class="mb-3">
                            <label for="kendaraan" class="form-label">Pilih Kendaraan</label>
                            <select class="form-control" name="kendaraan" id="kendaraan" required>
                                <option value="">-Pilih Kendaraan-</option>
                                <?php foreach ($kendaraan as $row) : ?>
                                    <option value="<?= esc($row['mobil']) ?>" >
                                        <?= esc($row['mobil']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label for="lampiran" class="form-label">File Lampiran (Maksimal 2MB):</label>
                        <input type="file" name="lampiran" id="lampiran" class="form-control mt-3" accept=".pdf">

                        <input type="checkbox" name="tanpa_lampiran" id="tanpa_lampiran">
                        <label for="tanpa_lampiran">Tidak ada lampiran</label>
                        <p><b>Apabila terjadi Error dalam mengajukan Peminjaman Silahkan Hubungi : 0895356226897 (Bayu
                                IT)
                        </p>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" name="submit"
                                value=<?php echo date("h:i:sa"); ?>>Submit</button>
                        </div>


                    </form>
                    
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>