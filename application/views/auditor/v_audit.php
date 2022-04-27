<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/toastr/toastr.min.css">
  <style>
    .img-audit{
      height: 100px !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url(); ?>home/form" class="nav-link" target="_blank">Form Audit 5R</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Pemberitahuan</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 15 update audit baru
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>auth/logout" role="button">
          <i class="fas fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>assets/adminlte/index3.html" class="brand-link">
      <img src="<?= base_url(); ?>assets/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Auditor AUDIT 5R</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        
      <!-- Sidebar user -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url(); ?>assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block"><?= strtoupper($this->session->userdata("username")); ?></a>
        </div>
      </div>
      <!-- /.Sidebar user -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="<?= base_url(); ?>auditor/db" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>auditor" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Audit
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>auditor/anggota" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Data Anggota
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>auditor/jadwal" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Data Jadwal
              </p>
            </a>
          </li>

        </ul>
      </nav>

    </div>
  </aside>
  <!-- /.Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Audit 5R</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('auditor'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Audit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Table Audit 5R Periode <?= $periode; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <!-- Filter Periode -->
                <form class="form-inline" action="<?= base_url(); ?>auditor" method="post">
                  <div class="form-group mb-2">
                    <label for="">Pilih Periode</label>
                    <input type="month" name="periode" class="form-control form-control-sm mx-2" required>
                    <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-filter"></i> Tampilkan</button>
                  </div>
                </form>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Area</th>
                      <th>Tgl Audit</th>
                      <th>5R</th>
                      <th>Aspek</th>
                      <th>Temuan</th>
                      <th>Keterangan</th>
                      <th>Jumlah</th>
                      <th>Gbr Temuan</th>
                      <th>Gbr Sesudah</th>
                      <th>Tim Audit</th>
                      <th>Rekomendasi</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  <?php $no=1;
                    if($audit != null){ 
                      foreach($audit as $row): ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td><?= $row->kd_lok_audit ?></td>
                      <td><?= $row->tgl_audit ?></td>
                      <td><?= $row->kd_5r_audit ?></td>
                      <td><?= $row->desk_aspek ?></td>
                      <td><?= $row->desk_pt ?></td>
                      <td><?= $row->ket_audit ?></td>
                      <td><?= $row->jlh_tem_audit ?></td>
                      <td><button id="img-temuan" type="button" data-toggle="modal" data-target="#exampleModal" data-id="<?= $row->gambar; ?>"><img id="img_audit" class="img-audit" src="<?= $SITE_URL.'/temuan_audit/' ?><?= $row->gambar; ?>" alt="gambar-temuan"></button></td>
                      <td><button id="img-temuan" type="button" data-toggle="modal" data-target="#exampleModal" data-id="<?= $row->gambar_sesudah; ?>"><img id="img_audit" class="img-audit" src="<?= $SITE_URL.'/temuan_audit/' ?><?= $row->gambar_sesudah; ?>" alt="gambar-sesudah-belum-ada"></button></td>
                      <td>
                        <?php
                        $i=0;
                        $auditors = json_decode($row->tim_audit);
                        while($i < count($auditors)){
                          echo ($i+1).". ".$auditors[$i]."<br>";
                          $i++;
                        }
                        ?>
                      </td>
                      <td><?= $row->rekomendasi ?></td>
                      <td class="text-center"><?= ($row->status == 'f') ? "OPEN" : "CLOSED" ; ?></td>
                      <td class="text-center">
                        <a id="update-temuan" class="btn btn-sm btn-primary" href="javascript:;" data-toggle="modal" data-target="#update-rekom" data-id="<?= $row->id_audit; ?>" data-rekom="<?= $row->rekomendasi; ?>" data-dept="<?= $row->kd_dept_audit; ?>" data-due_date="<?= $row->due_date; ?>">Update</a>
                        <a href="<?= base_url(); ?>auditor/close_audit/<?= $row->id_audit ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin close audit ini?')"> Close</a>
                      </td>
                    </tr>
                  <?php 
                      endforeach; 
                    } else {
                      echo '<tr><td colspan="13" class="text-center">Silakan Pilih Filter Periode Terlebih Dahulu.</td></tr>';
                    }  
                  ?>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0 Beta
    </div>
    <strong>Developt by IT NBI &copy; 2022 </strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Modal Detail Gambar Temuan -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Gambar Temuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img class="img-fluid rounded" id="img-temuan-if" src="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Detail Gambar Temuan -->
  
  <!-- Modal Update Rekomendasi -->
  <div class="modal fade bd-example-modal-lg" id="update-rekom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Rekomendasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>auditor/update_rekom" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="rekom">Rekomendasi</label>
              <input type="hidden" name="id_audit" class="form-control" id="id_audit">
              <input type="hidden" name="id_dep" class="form-control" id="id_dept">
              <textarea class="form-control" name="rekomendasi" id="rekom" rows="3" required></textarea>
            </div>
            <div class="form-group">
              <label for="rekom">Due Date</label>
              <input type="date" class="form-control" name="due_date" id="due_date" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="simpanUK">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Update Rekomendasi -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>assets/adminlte/dist/js/demo.js"></script>
<!-- Sweetalert -->
<script src="<?= base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/toastr/toastr.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $(document).on("click", "#img-temuan", function () {
    const bu = window.location.origin + "/temuan_audit/";
    var id = $(this).data("id");
    var gambar = bu+id;

    $("#img-temuan-if").attr("src", gambar);
  });

  $(document).on("click", "#update-temuan", function () {
    var id = $(this).data("id");
    var rekom = $(this).data("rekom");
    var due_date = $(this).data("due_date");
    var dept = $(this).data("dept");

    $("#id_audit").val(id);
    $("#id_dept").val(dept);
    $("#rekom").val(rekom);
    $("#due_date").val(due_date);
  });

  $('#simpanUK').click(function(){
    return confirm('Apakah anda yakin update rekomendasi?');
  });
</script>

<script>
<?php if($this->session->flashdata('success')){ ?>
  toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
  toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php }else if($this->session->flashdata('warning')){  ?>
  toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
<?php }else if($this->session->flashdata('info')){  ?>
  toastr.info("<?php echo $this->session->flashdata('info'); ?>");
<?php } ?>
</script>

</body>
</html>