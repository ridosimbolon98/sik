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
            <a href="<?= base_url(); ?>admin/area_temuan" class="nav-link active">
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
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/area_temuan'); ?>">Temuan</a></li>
              <li class="breadcrumb-item active"><?= $kd_area ?></li>
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
                <h3 class="card-title">Data Temuan Inspeksi Area: <?= $kd_area ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Tgl Inspeksi</th>
                      <th>Shift</th>
                      <th>Aspek Temuan</th>
                      <th>Inspektor</th>
                      <th>Bagian</th>
                      <th>Area</th>
                      <th>Unsur</th>
                      <th>Poin Min</th>
                      <th>Evidence</th>
                      <th>Keterangan</th>
                      <th>Tanggapan</th>
                      <th>Status</th>
                      <th>Tgl Input</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($temuan_area as $row): ?>
                      <tr>
                        <td class="text-center"><?= $row->id; ?></td>
                        <td class="text-center"><?= $row->tgl_inspeksi ?></td>
                        <td class="text-center"><?= $row->shift ?></td>
                        <td class="text-center"><?= $row->aspek_tem ?></td>
                        <td class="text-center"><?= $row->inspektor ?></td>
                        <td class="text-center"><?= $row->nama_bagian ?></td>
                        <td class="text-center"><?= $row->nama_area ?></td>
                        <td class="text-center"><?= $row->unsur ?></td>
                        <td class="text-center"><?= $row->poin_min ?></td>
                        <td class="text-center">
                          <button id="img-temuan" type="button" data-toggle="modal" data-target="#exampleModal" data-id="<?= $row->id; ?>">
                            <img id="img_audit" class="img-audit" src="data:image/png;base64, <?= base64_encode(file_get_contents($SITE_URL.'/temuan_inspeksi/'. $row->foto_temuan)) ?>" alt="gambar-temuan">
                          </button>
                        </td>
                        <td class="text-center"><?= $row->keterangan ?></td>
                        <td class="text-center"><?= $row->tanggapan ?></td>
                        <td class="text-center"><?= $row->status_tem === 'f' ? 'OPEN' : 'CLOSED' ?></td>
                        <td class="text-center"><?= $row->created_at ?></td>
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

  <!-- Modal Detail Gambar Temuan -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Gambar Temuan</h5>
          <button type="button" class="close btnClose" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="gbr_tem" class="d-block w-100"  alt="Gambar Temuan">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Detail Gambar Temuan -->

</div>
<!-- ./wrapper -->

<!-- scripts.php -->
<?php include (APPPATH.'views/inspektor/components/scripts.php'); ?>
<!-- scripts.php -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "print", "colvis"]
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
    const bu = window.location.origin + "/temuan_inspeksi/";
    const base_url = window.location.origin + "/sik/";
    var idImg = $(this).data("id");

    $.ajax({
      type: 'POST',
      url: base_url + "admin/get_img_temuan",
      data: {data: idImg},
      cache: false,
      success: function(msg){
        var data_gbr = JSON.parse(msg);
        var iter = 0;
        console.log(data_gbr);
        $("#gbr_tem").attr("src", bu+data_gbr);
      }
    });
  });
</script>

</body>
</html>
