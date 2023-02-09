<!-- header.php -->
<?php include (APPPATH.'views/inspektor/components/header.php'); ?>

  <style>
    .img-audit{
      height: 100px !important;
      width: 100px !important;
      overflow: hidden;
    }
    #dept-widget:hover{
      cursor: pointer;
    }
  </style>

  <!-- Topbar -->
  <?php include (APPPATH.'views/inspektor/components/topbar.php'); ?>
  <!-- Topbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        
      <!-- Sidebar user -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url(); ?>public/img/logo_nbi.png" class="elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block"><?= strtoupper($this->session->userdata("nama")); ?> (<?= $this->session->userdata("level") ?>)</a>
        </div>
      </div>
      <!-- /.Sidebar user -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-header">TRANSAKSI</li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>inspektor/form" class="nav-link">
              <i class="nav-icon fas fa-pen-square"></i>
              <p>
                Form Inspeksi
              </p>
            </a>
          </li>
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>inspektor" class="nav-link">
              <i class="nav-icon fas fa-unlock-alt"></i>
              <p>
                Temuan Hari Ini
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>inspektor/area_temuan" class="nav-link active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Temuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>inspektor/area_inspeksi" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Inspeksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>inspektor/tanggapan" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Data Tanggapan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>inspektor/jadwal" class="nav-link">
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
  <!-- Sidebar Menu -->

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('inspektor'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Temuan</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-sm-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Area yang sudah di inspeksi</h3>
              </div>
              <div class="card-body">
                <div class="row">

                <?php foreach($area as $row): ?>
                  <div class="col-md-3 col-sm-6 col-12">
                    <div id="area_aud" class="info-box">
                      <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>

                      <div id="dept-widget" class="info-box-content" data-kd_area="<?= $row->kd_area ?>">
                        <span class="info-box-text"><?= $row->desk_area ?></span>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Main content -->
    
  </div>
  <!-- /.content-wrapper -->


  <?php include (APPPATH.'views/footer/footer.php'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- scripts.php -->
<?php include (APPPATH.'views/inspektor/components/scripts.php'); ?>
<!-- scripts.php -->

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

  $(document).on("click", "#dept-widget", function () {
    const base_url = window.location.origin + "/sik/";
    var kd_area = $(this).data("kd_area");
    console.log(kd_area);
    window.location.href = base_url + "inspektor/temuan/"+kd_area;
  });
</script>

</body>
</html>
