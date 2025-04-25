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
                    <h4>Formulir Peminjaman Ruang</h4>
                    <p>Pastikan jadwal ruangan yang akan anda pesan tersedia</p>
                </div>
                <div class="card-body">
                <?php if (!empty($pesan)) : ?>
                    <div class="alert alert-info">
                        <?= esc($pesan) ?>
                    </div>
                <?php endif; ?>
                    <form action="<?= base_url('form_peminjaman_ruang/simpan') ?>" method="post" enctype="multipart/form-data">
                    
                    <div class="mb-3">
                            <label for="username" class="form-label">Nama:</label>
                            <input type="text" name="nama" value="<?= session()->get('username') ?>" class="form-control mt-3" readonly class="form-control">
                        </div>
         
                    <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" name="email" value="<?= session()->get('email') ?>" class="form-control mt-3" readonly class="form-control">
                        </div>
                    <div class="mb-3">
                            <label for="nim" class="form-label">NIM/NIP:</label>
                            <input type="text" name="nim" value="<?= session()->get('NIM') ?>" class="form-control mt-3" readonly class="form-control">
                        </div>

                    <div class="mb-3">
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
                            <p><b>PASTIKAN DOMAIN EMAIL ANDA BENAR!
                                    *Email UGM Mahasiswa (example@mail.ugm.ac.id)
                                </b></p>
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
                        <p><b>*Mahasiswa Wajib melampirkan Surat Izin Kegiatan dari Wakil Dekan Bidang Pendidikan,
                                Pengajaran
                                dan Kemahasiswaan </b></p>
                        <p><b>*Mahasiswa dari Luar Fakultas Geografi Wajib melampirkan Surat Izin Kegiatan dari
                                Direktorat
                                Kemahasiswaan dan Menghubungi Bagian Rumah Tangga Fakultas Geografi (PIC:Prestian(+62
                                858-6570-3331))</b></p>
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
    <script>
    function getKlasifikasi() {
        var ruang = document.getElementById("ruang").value;

        if (ruang) {
            fetch("<?= base_url('get_klasifikasi') ?>/" + encodeURIComponent(ruang))
                .then(response => response.json())
                .then(data => {
                    document.getElementById("klasifikasi").value = data.klasifikasi || '';
                })
                .catch(error => {
                    console.error("Error:", error);
                    document.getElementById("klasifikasi").value = '';
                });
        } else {
            document.getElementById("klasifikasi").value = '';
        }
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>