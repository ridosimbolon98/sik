<!-- header.php -->
<?php include (APPPATH.'views/inspektor/components/header.php'); ?>

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
          <img src="<?= base_url(); ?>public/img/logo_nbi.png" class=" elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block"><?= strtoupper($this->session->userdata("nama")); ?> (<?= $this->session->userdata("level") ?>)</a>
        </div>
      </div>
      <!-- /.Sidebar user -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/db" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/bagian" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Data Bagian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/area" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Data Area
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
            <a href="<?= base_url(); ?>admin/jadwal" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Data Jadwal
              </p>
            </a>
          </li>
          <li class="nav-header">LAPORAN</li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/area_temuan" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Temuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/inspeksi" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Inspeksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/report" class="nav-link active">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Report
              </p>
            </a>
          </li>
          <li class="nav-header">DOKUMEN</li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/panduan" class="nav-link">
              <i class="nav-icon fas fa-file-pdf"></i>
              <p>
                Panduan
              </p>
            </a>
          </li>
          <li class="nav-header">LOGS</li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/log" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Log User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/user_active" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Active User
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
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/report'); ?>">Report</a></li>
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
                <h3 class="card-title"><?= $title ?></h3>
              </div>

              <div class="card-body">

              <!-- filter Bulan Periode -->
                <form class="form-inline" action="<?= base_url(); ?>admin/report" method="post">
                  <div class="form-group mb-2">
                    <label class="mr-2 mb-2">Pilih Periode</label>
                    <input type="month" name="periode" class="form-control mr-2 mb-2" required>
                    <select name="area" class="form-control mr-2 mb-2" required>
                      <option value="" disabled selected>--Pilih Area--</option>
                      <option value="SEMUA">SEMUA</option>
                      <?php foreach($area as $row): ?>
                        <option value="<?= $row->kode_area ?>"><?= $row->desk_area ?></option>
                      <?php endforeach ?>
                    </select>
                    <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-chart-bar"></i> Filter</button>
                  </div>
                </form>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>No.</th>
                      <th>ID</th>
                      <th>Area</th>
                      <th>Periode</th>  
                      <th>Poin Min</th>
                      <th>EOP By</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=1;
                      foreach($report as $row): ?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= $row->id ?></td>
                        <td class="text-center"><?= $row->desk_area ?></td>
                        <td class="text-center"><?= $row->periode ?></td>
                        <td class="text-center text-danger"><?= $row->poin_min ?></td>
                        <td class="text-center"><?= $row->nama ?></td>
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
