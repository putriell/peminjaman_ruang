<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/custom/styles.css') ?>">

    
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <?php include 'navbar.php'; ?>


    <!-- ISI KONTEN -->
    <section class="container-fluid custom-bg" style="background-image: url('<?= base_url('adminLTE/dist/img/ugm/bg-new.jpg') ?>'); background-size: cover; background-position: center;">

        <div class="row justify-content-center align-items-center text-center vh-100">
            <div class="col-md-12">
                <h1>Website Peminjaman Ruang dan Kendaraan</h1>
                <p>Pastikan Anda Membaca Prosedur Peminjaman Terlebih dahulu!</p>
                <div class="d-grid">
                    <!-- Tombol AJUKAN -->
                    <a href="#" class="btn custom-btn" type="button" data-bs-toggle="modal"
                        data-bs-target="#ajukanModal">AJUKAN</a>
                </div>
            </div>
        </div>

        <!-- Modal untuk memilih jenis pengajuan -->
        <div class="modal fade" id="ajukanModal" tabindex="-1" aria-labelledby="ajukanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ajukanModalLabel">Pilih Jenis Pengajuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Silakan pilih pengajuan yang ingin dilakukan:</h5>
                        <div class="d-grid gap-2">
                            <a href="form-peminjaman-ruang.php" class="btn btn-primary">Peminjaman Ruang</a>
                            <a href="form-peminjaman-kendaraan.php" class="btn btn-secondary disabled">Peminjaman
                                Kendaraan</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Ketentuan -->
        <div class="modal fade" id="ketentuanModal" tabindex="-1" aria-labelledby="ketentuanModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ketentuanModalLabel">Ketentuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <h3>KETENTUAN PEMINJAMAN FASILITAS FAKULTAS GEOGRAFI</h3>
                        <h3> 3961/UN1/FGE. 1.2/KPG/TR.01.00/2023</h3>
                        <h4>A.MEMINJAM FASILITAS RUANG</h4>
                        <h5>1. Kewajiban</h5>
                        <p><strong>Setiap peminjam ruang wajib:</strong>
                        </p>
                        <ol type="a">
                            <li>Mengisi formulir peminjaman ruang Fakultas Geografi UGM secara
                                online.</li>
                            <li>Melapor kepada petugas keamanan Fakultas Geografi UGM sebelum
                                dan sesudah
                                melakukan kegiatan.
                            </li>
                            <li>Ikut bertanggung jawab atas terpeliharanya keamanan, ketertiban,
                                serta
                                kebersihan lokasi kegiatan dan sekitarnya.
                            </li>
                            <li>Melapor kepada petugas keamanan Fakultas Geografi UGM sebelum
                                dan sesudah
                                melakukan kegiatan.
                            </li>
                            <li>Ikut bertanggung jawab atas terpeliharanya keamanan, ketertiban,
                                serta
                                kebersihan lokasi kegiatan dan sekitarnya.
                            </li>
                            <li>Memarkirkan kendaraan sesuai peraturan yang berlaku di Fakultas
                                Geografi
                                UGM.
                            </li>
                            <li>Menghentikan kegiatan apabila lokasi kegiatan dan sekitarnya
                                akan digunakan
                                untuk acara Fakultas Geografi UGM yang bersifat lebih penting
                                dan mendesak.
                            </li>
                            <li>Mengganti kerusakan aset Fakultas Geografi UGM yang timbul
                                akibat kegiatan.
                            </li>
                        </ol>
                        <h5>2. Hak</h5>
                        <p>Peminjam berhak menggunakan ruang sesuai peraturan yang
                            berlaku di
                            Fakultas Geografi UGM.
                        </p>
                        <h5>3.Larangan</h5>
                        <p>Setiap peminjam ruang dilarang:
                        </p>
                        <ol type="a">
                            <li>Merusak aset
                                Fakultas Geografi
                                UGM.
                            </li>
                            <li>Mengubah tata
                                ruang(susunan
                                meja,kursi,dll.).
                            </li>
                            <li>Menempelkan/memaku
                                sesuatu pada
                                tembok/dinding.
                            </li>
                            <li>Merokok di dalam
                                ruangan.
                            </li>
                        </ol>
                        <h5>4.Sanksi</h5>
                        <p>Peminjam ruang yang melanggar ketentuan
                            dikenakan sanksi
                            administrasi berupa teguran dan/atau
                            penggantian
                            kerusakan aset Fakultas Geografi UGM yang
                            timbul akibat
                            kegiatan.</p>
                        <h4>B. PEMINJAM FASILITAS PERALATAN</h4>
                        <h5>1. Kewajiban</h5>
                        <p>
                            Setiap peminjam peralatan
                            wajib:</p>
                        <ol type="a">
                            <li>Mengisi formulir
                                permohonan
                                peminiaman alat Fakultas
                                Geografi
                                UGM secara online.
                            </li>
                            <li>Bertanggung jawab atas
                                segala risiko
                                pemakaian peralatan.
                            </li>
                            <li>Mengganti kerusakan
                                peralatan
                                Fakultas Geograh UGM
                                yang timbul
                                akibat pemakaian
                                peralatan.
                            </li>

                        </ol>
                        <h5>2.Hak</h5>
                        <p>Setiap peminjam
                            peralatan berhak
                            menggunakan alat
                            sesuai
                            peraturan Fakultas
                            Geografi UGM.
                        </p>
                        <h5>3.Larangan</h5>
                        <p>Setiap
                            peminjam
                            peralatan
                            dilarang
                            merusak
                            dan/atau
                            mengubah
                            peralatan
                            Fakultas
                            Geografi
                            UGM.
                        </p>
                        <h5>4.Sanksi
                        </h5>
                        <p>Peminjam
                            peralatan
                            yang
                            melanggar
                            ketentuan
                            dikenakan
                            sanksi
                            administrasi
                            berupa
                            teguran
                            dan/atau
                            pernggantian
                            kerusakan
                            peralatan
                            Fakultas
                            Geografi
                            UGM
                            yang
                            timbul
                            akibat
                            pemakaian.
                        </p>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Ketentuan -->
        <div class="modal fade" id="prosedurModal" tabindex="-1" aria-labelledby="prosedurModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="prosedurModalLabel">Prosedur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <h3>PROSEDUR PENGAJUAN PEMINJAMAN RUANG
                            FAKULTAS GEOGRAFI UNIVERSITAS GADJAH MADA
                        </h3>
                        <p>Dalam hal peminjaman ruang di Fakultas Geografi Universitas Gadjah Mada, peminjam
                            ruang
                            dikelompokkan menjadi 2 kategori, yaitu peminjam dari internal UGM dan eksternal UGM
                        </p>

                        <h4>A. Internal UGM</h4>
                        <p>Peminjam yang masuk dalam kategori internal UGM adalah dosen, tenaga
                            kependidikan,
                            mahasiswa, Unit Kegiatan Mahasiswa (UKM) Fakultas Geografi Universitas
                            Gadjah Mada.</p>
                        <h4>B. Eksternal UGM</h4>
                        <p>Peminjam yang masuk dalam kategori eksternal UGM adalah semua pihak
                            yang tidak
                            termasuk dalam kategori peminjam internal UGM. Peminjam eksternal
                            UGM dikenakan
                            biaya sewa ruang sesuai dengan Peraturan Rektor Universitas Gadjah
                            Mada Nomor 16
                            Tahun 2022 tentang Perubahan Kedua Atas Peraturan Rektor Universitas
                            Gadjah Mada
                            Nomor 9 Tahun 2022 Tentang Standar Tarif Universitas Gadjah Mada
                        </p>
                        <h4>Tata Cara Peminjaman Ruang di Fakultas Geografi Universitas Gadjah
                            Mada</h4>
                        <h5>A. Internal UGM</h5>
                        <ol type="1">
                            <li>Peminjam dapat mengakses aplikasi peminjaman ruang melalui
                                website Fakultas
                                Geografi UGM
                            </li>
                            <li>Sebelum mengisi formulir peminjaman ruang, peminjam dapat
                                menyiapkan
                                dokumen sebagai berikut :
                                <ol type="a">
                                    <li>Surat izin kegiatan dari fakultas bagi mahasiswa atau
                                        unit
                                        kegiatan mahasiswa (UKM) tingkat fakultas yang akan
                                        melakukan
                                        kegiatan kemahasiswaan seperti seminar, olimpiade,
                                        workshop, dll.
                                        Untuk kegiatan rapat rutin tidak perlu melampirkan surat
                                        izin
                                        kegiatan. </li>
                                    <li>Surat izin kegiatan dari universitas/direktur
                                        kemahasiswaan bagi
                                        mahasiswa atau unit kegiatan mahasiswa (UKM) yang akan
                                        melakukan
                                        kegiatan kemahasiswaan.
                                    </li>
                                    <li>Surat permohonan peminjaman ruang untuk unit kerja di
                                        lingkungan
                                        UGM, di luar Fakultas Geografi UGM. </li>
                                </ol>
                            </li>
                            <li>Peminjam mengisi formulir peminjaman ruang secara lengkap,
                                kemudian submit
                                pengajuan.
                            </li>
                            <li>Admin akan memeriksa permohonan pengajuan peminjaman ruang.
                                Apabila
                                dokumen sudah lengkap dan benar serta ruang dapat dipinjam,
                                admin akan
                                menyetujui peminjaman ruang. Apabila dokumen belum sesuai dan
                                atau ruang
                                sudah dipakai untuk kegiatan lain, admin akan menolak permohonan
                                peminjaman
                                ruang.
                            </li>
                            <li>Notifikasi permohonan peminjaman ruang disetujui atau ditolak,
                                dikirim oleh
                                admin ke alamat email peminjam ruang.
                            </li>
                        </ol>
                        <h5>B. Eksternal UGM</h5>
                        <ol type="1">
                            <li>Peminjam mengajukan surat permohonan peminjaman ruang
                                yang ditujukan
                                kepada Wakil Dekan Bidang Keuangan, Aset dan Sumber Daya
                                Manusia
                                Fakultas Geografi Universitas Gadjah Mada
                            </li>
                            <li>Peminjam mengirimkan surat permohonan peminjaman ruang
                                ke alamat
                                e-mail dekan.geografi@ugm.ac.id.
                            </li>
                            <li>Setelah pimpinan mendisposisi surat izin, selanjutnya
                                Koordinator
                                Bidang Administrasi, Keuangan dan Umum Fakultas Geografi
                                UGM akan
                                memproses permohonan tersebut.
                            </li>
                            <li>Peminjam eksternal UGM dikenakan biaya sewa ruang sesuai
                                dengan
                                Peraturan Rektor Universitas Gadjah Mada Nomor 16 Tahun
                                2022 tentang
                                Perubahan Kedua Atas Peraturan Rektor Universitas Gadjah
                                Mada Nomor
                                9 Tahun 2022 Tentang Standar Tarif Universitas Gadjah
                                Mada.
                            </li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <strong>Copyright &copy; 2023-2025 <a href="https://geo.ugm.ac.id">Fakultas Geografi</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0
            </div>
        </div>
        </div>
    </section>


    <!-- Tambahkan ini di bagian bawah halaman sebelum </body> -->
    <!-- Tambahkan ini di bagian bawah halaman sebelum </body> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>