<!-- header.php -->
<?php include (APPPATH.'views/inspektor/components/header.php'); ?>

  <style>
    .img-audit{
      height: 100px !important;
      width: 100px !important;
      overflow: hidden;
    }
    a.btndisabled {
      pointer-events: none !important;
      cursor: default;
      background-color: #cc6d77;
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
              <li class="breadcrumb-item"><a href="<?= base_url('inspektor/area_temuan'); ?>">Temuan</a></li>
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
                <h3 class="card-title">Temuan Inspeksi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Bagian</th>
                      <th>Area</th>
                      <th>Tgl Inspeksi</th>
                      <th>Shift</th>
                      <th>Aspek</th>
                      <th>Unsur</th>
                      <th>Poin</th>
                      <th>Gbr Temuan</th>
                      <th>Tanggapan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  <?php $no=1; foreach($temuan_inspeksi as $row): ?>
                    <tr>
                      <td class="text-center"><?= $row->id; ?></td>
                      <td class="text-center"><?= $row->bagian ?></td>
                      <td class="text-center"><?= $row->area ?></td>
                      <td class="text-center"><?= $row->tgl_inspeksi ?></td>
                      <td class="text-center"><?= $row->shift ?></td>
                      <td><?= $row->aspek_tem ?></td>
                      <td class="text-center"><?= $row->unsur ?></td>
                      <td class="text-center text-danger">-<?= $row->poin_min ?></td>
                      <td>
                        <button id="img-temuan" type="button" data-toggle="modal" data-target="#exampleModal" data-id="<?= $row->id; ?>">
                          <img id="img_audit" class="img-audit" src="data:image/png;base64, <?= base64_encode(file_get_contents($SITE_URL.'/temuan_inspeksi/'. $row->foto_temuan)) ?>" alt="gambar-temuan">
                        </button>
                      </td>
                      <td><?= $row->tanggapan ?></td>
                      <td class="text-center"><?= ($row->status_tem == 'f') ? "OPEN" : "CLOSED" ; ?></td>
                      <td class="text-center">
                        <button id="btn_tanggapan" <?= ($row->status_tem == 't') ? "disabled" : "" ; ?> class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubah-tanggapan" data-id="<?= $row->id ?>" data-tanggapan="<?= $row->tanggapan ?>" data-tooltip="Tambah Tanggapan"><i class="fa fa-pen-square"></i></button>
                        <a href="<?= base_url(); ?>inspektor/hapus_temuan/<?= $row->id ?>" class="btn btn-sm btn-danger <?= ($row->status_tem == 't') ? 'btndisabled' : '' ?>" data-tooltip="Hapus Temuan"><i class="fa fa-trash"></i></a>
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

  <!-- Modal Tanggapan -->
  <div class="modal fade bd-example-modal-lg" id="ubah-tanggapan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Tanggapan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>inspektor/ubah_tanggapan" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="input_tanggapan">Tanggapan User</label>
              <input type="hidden" id="id" required>
              <textarea name="tanggapan" class="form-control" id="input_tanggapan" cols="30" rows="5" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ubah tanggapan user?')">Simpan</button>
            <button type="reset" class="btn btn-secondary" >Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Tanggapan -->
 

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
      url: base_url + "inspektor/get_img_temuan",
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


  // ubah data area
  $(document).on("click", "#btn_tanggapan", function () {
    var id   = $(this).data("id");
    var tanggapan = $(this).data("tanggapan");

    $("#id").val(kode_area);
    $("#input_tanggapan").val(tanggapan);
  });

</script>

</body>
</html>
