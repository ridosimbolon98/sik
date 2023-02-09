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
            <a href="<?= base_url(); ?>admin/db" class="nav-link active">
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
            <a href="<?= base_url(); ?>admin/report" class="nav-link">
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
          <div class="col-sm-4">
            <form action="<?= base_url('admin/db') ?>" method="post">
              <div class="input-group input-group-sm">
                <input type="number" class="form-control" name="tahun" min="2023" step='1' value='<?= $tahun ?>'>
                <span class="input-group-append">
                  <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-filter"></i> Filter</button>
                </span>
              </div>
            </form>
          </div>
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/db'); ?>">Dashboard</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="my-1">
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3><?= $tem_baru ?></h3>

                  <p>Temuan Baru</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= $tem_open ?></h3>

                  <p>Temuan Open</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?= $tem_blm_dtgp ?></h3>

                  <p>Belum Ditanggapi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?= $tem_close ?></h3>

                  <p>Temuan Close</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="my-1">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Grafik Temuan Tahun: <?= $tahun ?></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="lineChartTA"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<script>
$(function () {
    
  const labels = [
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'Mei',
    'Jun',
    'Jul',
    'Agu',
    'Sep',
    'Oktr',
    'Nov',
    'Des'
  ];

  const data = {
    labels: labels,
    datasets: [
      {
        label: 'Jumlah Temuan Inspeksi',
        backgroundColor: '#2fe0ffc6',
        borderColor: '#188ca1c6',
        data: [
          <?= $jml_tem_jan[0]->jml ?>, 
          <?= $jml_tem_feb[0]->jml ?>, 
          <?= $jml_tem_mar[0]->jml ?>, 
          <?= $jml_tem_apr[0]->jml ?>, 
          <?= $jml_tem_mei[0]->jml ?>, 
          <?= $jml_tem_jun[0]->jml ?>, 
          <?= $jml_tem_jul[0]->jml ?>, 
          <?= $jml_tem_agu[0]->jml ?>, 
          <?= $jml_tem_sep[0]->jml ?>, 
          <?= $jml_tem_okt[0]->jml ?>, 
          <?= $jml_tem_nov[0]->jml ?>, 
          <?= $jml_tem_des[0]->jml ?>, 
        ],
        tension: 0.2
      }
    ]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
	  plugins: {
        title: {
          display: true,
          text: 'Chart Temuan Inspeksi Per Periode',
          padding: {
            top: 10,
            bottom: 10
          }
        },
        legend : {
          display: false
        }
      }
	  }
  };

  const myChart = new Chart(
    document.getElementById('lineChartTA'),
    config
  );


});
</script>

</body>
</html>
