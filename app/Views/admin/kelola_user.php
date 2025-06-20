
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
          <style>
             
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
               padding-top: 12px;
             }
             .small-box .inner {
                 text-align: center; 
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
                   <li class="breadcrumb-item active">User</li>
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
                 <form action="<?= base_url('user/search') ?>" method="get">
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
             
            <div class="card-body">
               <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
            
                 <thead class="text-center">
                       <tr>
                         <th>No.</th>
                         <th>Username</th>
                         <th>Email</th>
                         <th>NIM </th>
                         <th>Role</th>
                         <th>Reset Password</th>
                         <th>Tindakan</th>
                       </tr>
                       </thead>
                       <tbody>
                       <?php $no = 1 + (10 * ($page -1)); ?>
                        <?php foreach ($users as $row) : ?>
                         <tr>
                           <td><?= $no++ ?></td>
                           <td><?= esc($row['username']) ?></td>
                           <td><?= esc($row['email']) ?></td>
                           <td><?= esc($row['NIM']) ?></td>
                           <td><?= esc($row['role']) ?></td>
                           <td class="text-center">
                           <a href="#" data-href="<?= base_url('/user/reset_password/' . $row['id']); ?>" title="Reset Password" onclick="confirmReset(this)">
                             <i class="fas fa-redo"></i>
                           </a>
                           </td>
                           <td class="text-center" >
                            <a href="#" data-href="<?= base_url('user/hapus/'.$row['id']) ?>" onclick="confirmToDelete(this)">
                               <i class="fas fa-trash-alt pl-3"></i>
                             </a>
                           </td>
     
                         </tr>
                         <?php endforeach; ?>
                       </tbody>
               </table>           
         </div>  
         <div class="card-footer">
         <div class="row">
             <div class="col-12">
                 <nav aria-label="Page navigation">
                     <ul class="pagination">
                         <?php if ($totalPages > 1): ?>
                             <?php if ($page > 1): ?>
                                 <li class="page-item">
                                     <a class="page-link" href="?page=<?= $page - 1 ?>&keyword=<?= urlencode($keyword) ?>">« Prev</a>
                                 </li>
                             <?php endif; ?>
     
                             <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                 <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                     <a class="page-link" href="?page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>"><?= $i ?></a>
                                 </li>
                             <?php endfor; ?>
     
                             <?php if ($page < $totalPages): ?>
                                 <li class="page-item">
                                     <a class="page-link" href="?page=<?= $page + 1 ?>&keyword=<?= urlencode($keyword) ?>">Next »</a>
                                 </li>
                             <?php endif; ?>
                         <?php endif; ?>
                     </ul>
                 </nav>
             </div>
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
               <form id="form-tambah-data" action="<?= base_url('/user/simpan') ?>" method="POST">
                 <div class="modal-body">
                   <div class="form-group">
                     <label for="username">Username</label>
                     <input type="text" class="form-control" id="username" name="username" placeholder="masukkan nama" required>
                   </div>
                   <div class="form-group">
                     <label for="email">email</label>
                     <input type="text" class="form-control" id="email" name="email" placeholder="masukkan email" required>
                   </div>
                   <div class="form-group" id="nim-field" style="display: none;">
                    <label for="NIM">NIM</label>
                    <input type="text" class="form-control" id="NIM" name="NIM" placeholder="Masukkan NIM">
                  </div>
                    <div class="form-group">
                      <label for="role">Role</label>
                      <select class="form-control" id="role" name="role" required>
                        <option value="" disabled selected>Pilih role...</option>
                        <option value="admin">Admin</option>
                        <option value="akademik">Akademik</option>
                        </select>
                    </div>
                   
                   <button type="submit" class="btn btn-primary">Simpan</button>
                 </div>
               </form>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-body">
             <h2 class="h2">Are you sure?</h2>
             <p>The data will be deleted and lost forever</p>
           </div>
           <div class="modal-footer">
             <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
           </div>
         </div>
       </div>
     </div>
     <?php if(session()->getFlashdata('message')): ?>
         <div class="alert alert-success">
             <?= session()->getFlashdata('message') ?>
         </div>
     <?php endif; ?>
     
     
     <script>
     function confirmReset(element) {
         const url = element.getAttribute('data-href');
         if (confirm('Apakah Anda yakin ingin mereset password menjadi "admin123"?')) {
             window.location.href = url;
         }
     }
     </script>
     <script>
       function confirmToDelete(el){
         const href = el.getAttribute('data-href');
           if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
               window.location.href = href;
           }
           
       } 
     
     
     </script>
      

         <script src="<?= base_url('adminLTE/plugins/jquery/jquery.min.js') ?>"></script>
     
         <script src="<?= base_url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
     
         <script src="<?= base_url('adminLTE/dist/js/adminlte.js') ?>"></script>
     
     </body>
     </html>

     
     