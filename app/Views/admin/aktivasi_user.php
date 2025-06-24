
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
             
             
            <div class="card-body">
               <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
            
                 <thead class="text-center">
                       <tr>
                         <th>No.</th>
                         <th>Username</th>
                         <th>Email</th>
                         <th>NIM </th>
                         <th>Status</th>
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
                           <td><?= esc($row['status']) ?></td>
                            <td>
                              <form action="<?= base_url('admin/proses_aktivasi') ?>" method="POST" style="display:inline;">
                                  <?= csrf_field() ?> 
                                  <input type="hidden" name="user_id" value="<?= $row['id'] ?>"> 
                                  <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm"
                                      onclick="return confirm('Anda yakin ingin mengaktivasi akun <?= esc($row['username']) ?>?')">
                                      Aktivasi
                                    </button>
                                  </div>
                              </form>
                          </td>
     
                         </tr>
                         <?php endforeach; ?>
                       </tbody>
               </table>           
         </div>  
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
      
       </div>
     </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
     

      

         <script src="<?= base_url('adminLTE/plugins/jquery/jquery.min.js') ?>"></script>
     
         <script src="<?= base_url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
     
         <script src="<?= base_url('adminLTE/dist/js/adminlte.js') ?>"></script>
     
     </body>
     </html>

     
     