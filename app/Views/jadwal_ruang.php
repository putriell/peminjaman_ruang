<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Ruang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/custom/style.css') ?>">
    <style>
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
        }

        .schedule-table th,
        .schedule-table td {
            border: 1px solid #dee2e6;
            text-align: center;
            padding: 5px;
            font-size: 0.9rem;
        }

        .schedule-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .occupied {
            background-color: #dc3545;
            color: white;
        }

        .sticky-column {
            position: sticky;
            left: 0;
            background-color: #fff;
            z-index: 1;
        }
        </style>
</head>
<body>
<div class="wrapper">

    <?php include 'navbar.php'; ?>
    <section class="container-fluid">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
        
        <h4>Jadwal Peminjaman Ruang dan Event</h4>
        <form method="POST">
            <label for="tanggal">Pilih Tanggal:</label>
            <input type="date" id="tanggal" name="filter_date" class="form-control" value="<?= esc($filter_date) ?>">
            <button type="submit" class="btn btn-primary mt-2">Filter</button>
        </form>
        </div>

        <div style="overflow-x: auto;">
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th class="sticky-column">Ruang</th>
                        <?php for ($hour = 5; $hour < 24; $hour++): ?>
                            <th><?= str_pad($hour, 2, '0', STR_PAD_LEFT) ?>:00</th>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftarruang as $ruang): ?>
                        <tr>
                            <td class="sticky-column"><?= esc($ruang['nama_ruang']) ?></td>
                            <?php for ($hour = 5; $hour < 24; $hour++): ?>
                                <?php 
                                    $occupied = false;
                                    foreach ($jadwal as $item) {
                                        if ($item['ruang'] === $ruang['nama_ruang']) {
                                            $startHour = (int)date('H', strtotime($item['waktu_mulai']));
                                            $endHour = (int)date('H', strtotime($item['waktu_selesai']));
                                            if ($hour >= $startHour && $hour <= $endHour) {
                                                $occupied = true;
                                                break;
                                            }
                                        }
                                    }
                                ?>
                                <td class="<?= $occupied ? 'bg-danger text-white' : '' ?>">
                                    <?= $occupied ? 'X' : '' ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-body">
        <h5>Detail Jadwal</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipe</th>
                    <th>Nama</th>
                    <th>Ruang</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($jadwal) > 0): ?>
                    <?php foreach ($jadwal as $item): ?>
                        <tr>
                            <td><?= esc($item['tipe']) ?></td>
                            <td><?= esc($item['nama']) ?></td>
                            <td><?= esc($item['ruang']) ?></td>
                            <td><?= date('H:i', strtotime($item['waktu_mulai'])) ?></td>
                            <td><?= date('H:i', strtotime($item['waktu_selesai'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada jadwal untuk tanggal ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
