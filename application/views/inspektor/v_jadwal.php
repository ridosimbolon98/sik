<!-- header.php -->
<?php include (APPPATH.'views/inspektor/components/header.php'); ?>

  <style>
    .img-audit{
      height: 100px !important;
      width: 100px !important;
      overflow: hidden;
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
            <a href="<?= base_url(); ?>inspektor/index" class="nav-link">
              <i class="nav-icon fas fa-unlock-alt"></i>
              <p>
                Temuan Hari Ini
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>inspektor/area_temuan" class="nav-link">
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
            <a href="<?= base_url(); ?>inspektor/jadwal" class="nav-link active">
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
              <li class="breadcrumb-item"><a href="<?= base_url('inspektor/jadwal'); ?>">Jadwal</a></li>
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
                <h3 class="card-title">Daftar Jadwal Inspektor</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Inspektor</th>
                      <th>Tgl Inspeksi</th>
                      <th>Shift</th>
                      <th>Status</th>    
                      <th>Tgl Realisasi</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($jadwal as $row): ?>
                      <tr>
                        <td class="text-center"><?= $row->id_jadwal; ?></td>
                        <td class="text-center"><?= $row->id_user ?></td>
                        <td class="text-center"><?= $row->tgl_inspeksi ?></td>
                        <td class="text-center"><?= $row->shift_inspeksi ?></td>
                        <td class="text-center"><?= $row->status_inspeksi == true ? 'BELUM' : 'SUDAH' ?></td>
                        <td class="text-center"><?= $row->tgl_realisasi ?></td>
                        <td class="text-center"><?= $row->keterangan ?></td>
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

</script>

</body>
</html>
