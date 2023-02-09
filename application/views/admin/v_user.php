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
            <a href="<?= base_url(); ?>admin/area" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Data Area
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/user" class="nav-link active">
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
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/user'); ?>">User</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="mb-1">
          <button class="btn btn-info mr-2 mb-2" data-toggle="modal" data-target="#add-user"><i class="fa fa-plus"></i> Tambah User Baru</button>
        </div>

        <div class="row">
          <div class="col-sm-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>No.</th>
                      <th>NIK</th>
                      <th>Nama</th> 
                      <th>Username</th> 
                      <th>Level</th>
                      <th>Bagian</th>    
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($user as $row): ?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= $row->nik ?></td>
                        <td class="text-center"><?= $row->nama ?></td>
                        <td class="text-center"><?= $row->username ?></td>
                        <td class="text-center"><?= $row->level ?></td>
                        <td class="text-center"><?= $row->bagian ?></td>
                        <td class="text-center"><?= $row->status_user === 't' ? 'ENABLED' : 'DISABLED' ?></td>
                        <td class="text-center">
                          <a id="btn_ubah" href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubah-user" data-nik="<?= $row->nik ?>" data-nama="<?= $row->nama ?>" data-level="<?= $row->level ?>" data-bagian="<?= $row->bagian ?>"><i class="fa fa-pen-square"></i></a>
                          <a id="btn_reset" href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#reset-password" data-nik="<?= $row->nik ?>"><i class="fa fa-lock"></i></a>
                          <a href="<?= base_url() ?>admin/update_status_user/<?= $row->nik ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin disabled user ini?')"><i class="fa fa-eye"></i></a>
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

  <!-- Modal Add User -->
  <div class="modal fade bd-example-modal-lg" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>admin/tambah_user" method="post">
          <div class="modal-body">

            <div class="form-group row">
              <label for="inputNik" class="col-sm-3 col-form-label">NIK</label>
              <div class="col-sm-9">
                <input type="text" name="nik" class="form-control" required placeholder="Input NIK">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputNama" class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" id="inputNama" required placeholder="Input Nama">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input type="password" name="password" class="form-control" id="inputPassword" required placeholder="Input password">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputKonfPassword" class="col-sm-3 col-form-label">Konfirmasi Password</label>
              <div class="col-sm-9">
                <input type="password" name="password" class="form-control" id="inputKonfPassword" required placeholder="Input konfirmasi password">
                <span id="alertPass"></span>
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
              <label for="inputLevel" class="col-sm-3 col-form-label">Level</label>
              <div class="col-sm-9">
                <select name="level" class="form-control" id="inputLevel" required>
                  <option value="" disabled-selected hidden>--Pilih Level User--</option>
                  <option value="INSPEKTOR">INSPEKTOR</option>
                  <option value="USER">USER</option>
                </select>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btnSimpan" disabled  onclick="return confirm('Apakah anda yakin simpan user baru ini?')"><i class="fa fa-save"></i> Simpan</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Add User -->

  <!-- Modal Ubah User -->
  <div class="modal fade bd-example-modal-lg" id="ubah-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Data User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>admin/ubah_user" method="post">
          <div class="modal-body">

            <div class="form-group row">
              <label for="nik_user" class="col-sm-3 col-form-label">NIK</label>
              <div class="col-sm-9">
                <input id="nik_user1" type="hidden" name="nik1" class="form-control" required>
                <input id="nik_user" type="text" name="nik" class="form-control" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="nama_user" class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" id="nama_user" required placeholder="Input Nama">
              </div>
            </div>
            <div class="form-group row">
              <label for="bagian_user" class="col-sm-3 col-form-label">Bagian</label>
              <div class="col-sm-9">
                <select name="bagian" class="form-control" id="bagian_user" required>
                  <option value="" disabled-selected hidden>--Pilih Bagian--</option>
                  <?php foreach($bagian as $bg): ?>
                      <option value="<?= $bg->kode_bagian ?>"><?= $bg->deskripsi ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="level_user" class="col-sm-3 col-form-label">Level</label>
              <div class="col-sm-9">
                <select name="level" class="form-control" id="level_user" required>
                  <option value="" disabled-selected hidden>--Pilih Level User--</option>
                  <option value="INSPEKTOR">INSPEKTOR</option>
                  <option value="USER">USER</option>
                </select>
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
  <!-- End Ubah User -->
  
  <!-- Modal Reset Pass User -->
  <div class="modal fade bd-example-modal-lg" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reset Password User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>admin/reset_password" method="post">
          <div class="modal-body">

            <div class="form-group row">
              <label for="res_password" class="col-sm-3 col-form-label">Password Baru</label>
              <div class="col-sm-9">
                <input id="nik_user_res" type="hidden" name="nik" class="form-control">
                <input id="res_password" type="password" name="password" class="form-control" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="res_konf_password" class="col-sm-3 col-form-label">Konfirmasi Password</label>
              <div class="col-sm-9">
                <input type="password" name="konf_pass" class="form-control" id="res_konf_password" required>
                <span id="alert_pass_res"></span>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button id="tombol_reset" type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin reset password user ini?')"><i class="fa fa-save"></i> Reset Password</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Ubah User -->


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

  // cek apakah password = konfirmasi password
  let pass = document.getElementById("inputPassword");
  let pass_konf = document.getElementById("inputKonfPassword");
  let res_pass = document.getElementById("res_password");
  let res_pass_konf = document.getElementById("res_konf_password");

  pass_konf.addEventListener("input", () => {
    let alertPass = document.getElementById("alertPass");

    if (pass.value != pass_konf.value) {
      alertPass.innerHTML = "*Konfirmasi password tidak sama!";
      alertPass.setAttribute("class", "text-danger my-2");

      $("#btnSimpan").attr("disabled","");
    } else {
      $("#btnSimpan").removeAttr("disabled");
      alertPass.innerHTML = "*Konfirmasi password sudah sesuai";
      alertPass.setAttribute("class", "text-success my-2");
    }
  });
  
  // reset password
  res_pass_konf.addEventListener("input", () => {
    let alert_pass_res = document.getElementById("alert_pass_res");

    if (res_pass.value != res_pass_konf.value) {
      alert_pass_res.innerHTML = "*Konfirmasi password tidak sama!";
      alert_pass_res.setAttribute("class", "text-danger my-2");

      $("#tombol_reset").attr("disabled","");
    } else {
      $("#tombol_reset").removeAttr("disabled");
      alert_pass_res.innerHTML = "*Konfirmasi password sudah sesuai";
      alert_pass_res.setAttribute("class", "text-success my-2");
    }
  });

  // ubah data user
  $(document).on("click", "#btn_ubah", function () {
    var nik     = $(this).data("nik");
    var nama    = $(this).data("nama");
    var bagian  = $(this).data("bagian");
    var level   = $(this).data("level");

    $("#nik_user").val(nik);
    $("#nik_user1").val(nik);
    $("#nama_user").val(nama);
    $("#bagian_user").val(bagian);
    $("#level_user").val(level);
  });
  
  // reset password data user
  $(document).on("click", "#btn_reset", function () {
    var nik     = $(this).data("nik");

    $("#nik_user_res").val(nik);
  });

</script>

</body>
</html>
