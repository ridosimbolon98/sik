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
            <a href="<?= base_url(); ?>admin/area_temuan" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Temuan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/inspeksi" class="nav-link active">
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
        <div class="row mb-1">
          <div class="col-sm-4">
            <form action="<?= base_url('admin/inspeksi') ?>" method="post">
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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/inspeksi'); ?>">Inspeksi</a></li>
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
                <h3 class="card-title">Daftar Inspeksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>No.</th>
                      <th>ID</th>
                      <th>Area</th>
                      <th>Tgl Inspeksi</th>
                      <th>Shift</th>
                      <th>Keterangan</th>
                      <th>Gbr Temuan</th>
                      <th>Periode</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  <?php $no=1; foreach($inspeksi as $row): ?>
                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td class="text-center"><?= $row->id; ?></td>
                      <td class="text-center"><?= preg_replace("/[^a-zA-Z0-9,]/", "", $row->area); ?></td>
                      <td class="text-center"><?= $row->tgl_inspeksi ?></td>
                      <td class="text-center"><?= $row->shift ?></td>
                      <td class="text-center"><?= $row->keterangan ?></td>
                      <td>
                        <button id="img-temuan" type="button" data-toggle="modal" data-target="#exampleModal" data-id="<?= $row->id; ?>">
                          <img id="img_audit" class="img-audit" src="data:image/png;base64, <?= base64_encode(file_get_contents($SITE_URL.'/temuan_inspeksi/'. $row->evidence)) ?>" alt="gambar-temuan">
                        </button>
                      </td>
                      <td class="text-center"><?= $row->periode ?></td>
                      <td class="text-center">
                        <a href="<?= base_url(); ?>admin/hapus_inspeksi/<?= $row->id ?>" class="btn btn-sm btn-danger" data-tooltip="Hapus Data Inspeksi" onclick="return confirm('Apakah anda yakin hapus data inspeksi ini?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

   <!-- Modal Detail Gambar Temuan -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Gambar Inspeksi</h5>
          <button type="button" class="close btnClose" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="gbr_tem" class="d-block w-100"  alt="Gambar Inspeksi">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Detail Gambar Temuan -->

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


  // menampilkan detail gambar temuan/evidence
  $(document).on("click", "#img-temuan", function () {
    const bu = window.location.origin + "/temuan_inspeksi/";
    const base_url = window.location.origin + "/sik/";
    var idImg = $(this).data("id");

    $.ajax({
      type: 'POST',
      url: base_url + "admin/get_img_inspeksi",
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
