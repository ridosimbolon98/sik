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
      <span class="brand-text font-weight-light">Admin AUDIT 5R</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        
      <!-- Sidebar user -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url(); ?>assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= strtoupper($this->session->userdata("username")); ?></a>
        </div>
      </div>
      <!-- /.Sidebar user -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>admin/db2" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/pabrik" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Audit Pabrik
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/non_pabrik" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Audit Non-Pabrik
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/user" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/auditor" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Data Auditor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/jadwal" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Data Jadwal
              </p>
            </a>
          </li>
          <li class="nav-header">LAPORAN</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Monitoring Audit
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>admin/mt_pabrik" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pabrik</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>admin/mt_nonpabrik" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Non-Pabrik</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/lap" class="nav-link active">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Ketidaksesuaian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/pareto" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Pareto Temuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/ranking" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Ranking
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/tl" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Tindak Lanjut
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- /.Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Ketidaksesuaian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/lap">Data Bagian</a></li>
              <li class="breadcrumb-item active">Lap Ketidaksesuaian</li>
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
                <h3 class="card-title">Data Table Audit 5R Area <?= $area; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Area</th>
                      <th>Lokasi</th>
                      <th>Keterangan</th>
                      <th>Kondisi Sebelum</th>
                      <th>Rekomendasi</th>
                      <th>Kondisi Sesudah</th>
                      <th>PIC</th>
                      <th>Due Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($audit as $row): ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td class="text-center"><?= $row->kd_lok_audit ?></td>
                      <td class="text-center"><?= $row->bagian_dept ?></td>
                      <td><?= $row->ket_audit ?></td>
                      <td class="text-center">
                        <button id="img-temuan" type="button" data-toggle="modal" data-target="#exampleModal" data-id="<?= $row->id_audit; ?>">
                          <img id="img_audit" class="img-audit" src="<?= $SITE_URL.'/temuan_audit/' ?><?= json_decode($row->gambar,true)[0]; ?>" alt="gambar-temuan">
                        </button>
                      </td>
                      <td class="text-justify"><?= $row->rekomendasi ?></td>
                      <td class="text-center">
                        <?php if($row->gambar_sesudah != '0') { ?>
                          <button id="img-temuan2" type="button" data-toggle="modal" data-target="#exampleModal1" data-id2="<?= $row->id_audit; ?>">
                            <img id="img_audit1" class="img-audit" src="<?= $SITE_URL.'/temuan_audit/' ?><?= json_decode($row->gambar_sesudah,true)[0]; ?>" alt="gambar-sesudah">
                          </button>
                        <?php } else { ?>
                          <img id="img_audit" class="img-thumbnail rounded" src="" alt="gambar-sesudah-belum-ada">
                        <?php }  ?> 
                      </td>
                      <td class="text-center"><?= $row->koor_dept ?></td>
                      <td class="text-center"><?= $row->due_date ?></td>
                      <td class="text-center"><?= ($row->status == 'f') ? "OPEN" : "CLOSED" ; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->


  <?php include (APPPATH.'views/footer/footer.php'); ?>

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

          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div id="imgSlide" class="carousel-inner">
              <div class="carousel-item active">
                <img id="firstImg" class="d-block w-100" src="" alt="Gambar Temuan">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Detail Gambar Temuan -->

  <!-- Modal Detail Gambar Sesudah -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Gambar Sesudah</h5>
          <button type="button" class="close btnClose" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div id="imgSlide2" class="carousel-inner">
              <div class="carousel-item active">
                <img id="firstImg2" class="d-block w-100" src="" alt="Gambar Temuan">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">Tutup</button>
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
        <form action="<?= base_url(); ?>admin/update_rekom" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="rekom">Rekomendasi</label>
              <input type="hidden" name="id_audit" class="form-control" id="id_audit">
              <input type="hidden" name="id_dep" class="form-control" value="<?= $id_dep; ?>">
              <textarea class="form-control" name="rekomendasi" id="rekom" rows="3"></textarea>
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
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
    const base_url = window.location.origin + "/audit/";
    var idImg = $(this).data("id");

    $.ajax({
      type: 'POST',
      url: base_url + "admin/getImg",
      data: {data: idImg},
      cache: false,
      success: function(msg){
        var data_gbr = JSON.parse(msg);
        var iter = 0;
        while (iter < JSON.parse(data_gbr).length) {
          $("#imgSlide").append(
            "<div class='carousel-item s_img'><img class='d-block w-100' src='"+bu+JSON.parse(data_gbr)[iter]+"' alt='Gambar Temuan "+iter+"'></div>"
          );
          iter++;
        }
        $("#firstImg").attr("src", bu+JSON.parse(data_gbr)[0]);
      }
    });
  });

  $(document).on("click", ".btnClose", function () {
    location.reload();
  });

  $(document).on("click", "#img-temuan2", function () {
    const bu = window.location.origin + "/temuan_audit/";
    const base_url = window.location.origin + "/audit/";
    var idImg = $(this).data("id2");

    $.ajax({
      type: 'POST',
      url: base_url + "admin/getImgSesudah",
      data: {data: idImg},
      cache: false,
      success: function(msg){
        var data_gbr = JSON.parse(msg);
        var iter = 0;
        while (iter < JSON.parse(data_gbr).length) {
          $("#imgSlide2").append(
            "<div class='carousel-item s_img'><img class='d-block w-100' src='"+bu+JSON.parse(data_gbr)[iter]+"' alt='Gambar Temuan "+iter+"'></div>"
          );
          iter++;
        }
        $("#firstImg2").attr("src", bu+JSON.parse(data_gbr)[0]);
      }
    });
  });

</script>
</body>
</html>
