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
            <a href="<?= base_url(); ?>admin/area" class="nav-link active">
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
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/report_jadwal" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Realisasi Jadwal
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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/area'); ?>">Area</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="mb-1">
          <button class="btn btn-info mr-2 mb-2" data-toggle="modal" data-target="#add-area"><i class="fa fa-plus"></i> Tambah Area Baru</button>
        </div>

        <div class="row">
          <div class="col-sm-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Area Inspeksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>No.</th>
                      <th>Kode Bagian</th>
                      <th>Kode Area</th> 
                      <th>Area</th> 
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($area as $row): ?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= $row->kode_bagian ?></td>
                        <td class="text-center"><?= $row->kode_area ?></td>
                        <td class="text-center"><?= $row->desk_area ?></td>
                        <td class="text-center"><?= $row->status === 't' ? 'ENABLED' : 'DISABLED' ?></td>
                        <td class="text-center">
                          <a id="btn_ubah" href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubah-area" data-kode_area="<?= $row->kode_area ?>" data-kode_bagian="<?= $row->kode_bagian ?>" data-desk_area="<?= $row->desk_area ?>"><i class="fa fa-pen-square"></i></a>
                          <a href="<?= base_url() ?>admin/update_status_area/<?= $row->kode_area ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin disabled area ini?')"><i class="fa fa-eye"></i></a>
                        </td>
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

  <!-- Modal Add Area -->
  <div class="modal fade bd-example-modal-lg" id="add-area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Area Inspeksi Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>admin/tambah_area" method="post">
          <div class="modal-body">
            <div class="form-group row">
              <label for="inputKdArea" class="col-sm-3 col-form-label">Kode Area</label>
              <div class="col-sm-9">
                <input type="text" name="kode_area" class="form-control" id="inputKdArea1" required placeholder="Input kode area">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputBagian" class="col-sm-3 col-form-label">Bagian</label>
              <div class="col-sm-9">
                <select name="bagian" class="form-control" id="inputBagian" required>
                  <option value="" disabled-selected hidden>--Pilih Bagian--</option>
                  <?php foreach($bagian as $bg): ?>
                      <option value="<?= $bg->kode_bagian ?>"><?= $bg->deskripsi ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputNama" class="col-sm-3 col-form-label">Nama Area</label>
              <div class="col-sm-9">
                <input type="text" name="nama_area" class="form-control" id="inputNama" required placeholder="Input Nama Area">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin simpan area baru ini?')"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Add Area -->

  <!-- Modal Ubah Area -->
  <div class="modal fade bd-example-modal-lg" id="ubah-area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Data Area Inspeksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>admin/ubah_area" method="post">
          <div class="modal-body">

            <div class="form-group row">
              <label for="input_kd_area" class="col-sm-3 col-form-label">Kode Area</label>
              <div class="col-sm-9">
                <input type="text" disabled class="form-control" id="input_kd_area1" >
                <input type="hidden" name="kode_area" hidden class="form-control" id="input_kd_area" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputBagian" class="col-sm-3 col-form-label">Bagian</label>
              <div class="col-sm-9">
                <select name="bagian" class="form-control" id="input_bagian" required>
                  <option value="" disabled-selected hidden>--Pilih Bagian--</option>
                  <?php foreach($bagian as $bg): ?>
                      <option value="<?= $bg->kode_bagian ?>"><?= $bg->deskripsi ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="input_area" class="col-sm-3 col-form-label">Nama Area</label>
              <div class="col-sm-9">
                <input type="text" name="nama_area" class="form-control" id="input_area" required>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin simpan perubahan data ini?')"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Ubah Area -->


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

  // ubah data area
  $(document).on("click", "#btn_ubah", function () {
    var kode_area   = $(this).data("kode_area");
    var kode_bagian = $(this).data("kode_bagian");
    var desk_area   = $(this).data("desk_area");

    $("#input_kd_area1").val(kode_area);
    $("#input_kd_area").val(kode_area);
    $("#input_bagian").val(kode_bagian);
    $("#input_area").val(desk_area);
  });

</script>

</body>
</html>
