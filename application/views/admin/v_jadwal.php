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
            <a href="<?= base_url(); ?>admin/jadwal" class="nav-link active">
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
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/jadwal'); ?>">Jadwal</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="mb-1">
          <button class="btn btn-info mr-2 mb-2" data-toggle="modal" data-target="#add-jadwal"><i class="fa fa-plus"></i> Tambah Jadwal Inspeksi Baru</button>
        </div>

        <div class="row">
          <div class="col-sm-12">

            <div class="card card-secondary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Jadwal Asli</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Jadwal Terhapus</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr class="text-center">
                          <th>ID</th>
                          <th>Inspektor</th>
                          <th>Tgl Inspeksi</th> 
                          <th>Periode</th> 
                          <th>Shift</th>
                          <th>Realisasi</th>    
                          <th>Tgl Realisasi</th>
                          <th>Keterangan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($jadwal as $row): ?>
                          <tr>
                            <td class="text-center"><?= $row->id_jadwal; ?></td>
                            <td class="text-center"><?= $row->id_user ?></td>
                            <td class="text-center"><?= $row->tgl_inspeksi ?></td>
                            <td class="text-center"><?= $row->periode ?></td>
                            <td class="text-center"><?= $row->shift_inspeksi ?></td>
                            <td class="text-center"><?= $row->status_inspeksi === 'f' ? 'BELUM' : 'SUDAH' ?></td>
                            <td class="text-center"><?= $row->tgl_realisasi ?></td>
                            <td class="text-center"><?= $row->keterangan ?></td>
                            <td class="text-center">
                              <a href="<?= base_url() ?>admin/hapus_jadwal/<?= $row->id_jadwal ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin hapus jadwal ini?')"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                        <tr class="text-center">
                          <th>ID</th>
                          <th>Inspektor</th>
                          <th>Tgl Inspeksi</th> 
                          <th>Periode</th> 
                          <th>Shift</th>
                          <th>Realisasi</th>    
                          <th>Tgl Realisasi</th>
                          <th>Keterangan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($jadwal_temp as $row): ?>
                          <tr>
                            <td class="text-center"><?= $row->id_jadwal; ?></td>
                            <td class="text-center"><?= $row->id_user ?></td>
                            <td class="text-center"><?= $row->tgl_inspeksi ?></td>
                            <td class="text-center"><?= $row->periode ?></td>
                            <td class="text-center"><?= $row->shift_inspeksi ?></td>
                            <td class="text-center"><?= $row->status_inspeksi == true ? 'BELUM' : 'SUDAH' ?></td>
                            <td class="text-center"><?= $row->tgl_realisasi ?></td>
                            <td class="text-center"><?= $row->keterangan ?></td>
                            <td class="text-center">
                              <a href="<?= base_url() ?>admin/restore_jadwal/<?= $row->id_jadwal ?>" class="btn btn-sm btn-success" onclick="return confirm('Apakah anda yakin restore jadwal ini?')"><i class="fa fa-trash-restore"></i></a>
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
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Add Jadwal -->
  <div class="modal fade bd-example-modal-lg" id="add-jadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>admin/tambah_jadwal" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="date_time">Tanggal Inspeksi</label>
              <input type="date" name="tgl_inspeksi" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="shift">Shift</label>
              <select name="shift" class="form-control" id="shift" aria-label="inspektor" required>
                <option value="" disabled-selected hidden>--Pilih Shift--</option>
                <option value="1">Shift 1</option>
                <option value="2">Shift 2</option>
                <option value="3">Shift 3</option>
              </select>
            </div>
            <div class="form-group">
              <label for="inspektor">Inspektor</label>
              <select name="inspektor" class="form-control" id="inspektor" aria-label="inspektor" required>
                <option value="" disabled selected>--Pilih Inspektor--</option>
                <?php foreach($user as $row): ?>
                  <option value="<?= $row->username; ?>"><?= strtoupper($row->nama); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="">Simpan</button>
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Add Jadwal -->


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
