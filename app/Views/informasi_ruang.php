<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Ruang</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/custom/style.css') ?>">
    <style>
        
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <?php include 'navbar.php'; ?>


    <section class="container-fluid">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Ruang</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($cards as $card): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                <h5 class="card-title"><?= esc($card['nama_ruang']) ?></h5>
                                    <p class="card-text pt-2">Klasifikasi: <?= esc($card['klasifikasi']) ?></p>
                                    <p class="card-text">Kapasitas: <?= esc($card['kapasitas']) ?> Orang</p>
                                    <p class="card-text">Status: <?= esc($card['status']) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <strong>Copyright &copy; 2023-2025 <a href="https://geo.ugm.ac.id">Fakultas Geografi</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block"><b>Version</b> 2.0</div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
