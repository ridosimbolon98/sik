<!-- header.php -->
<?php include (APPPATH.'views/inspektor/components/header.php'); ?>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.form.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/multi-select/dist/css/BsMultiSelect.min.css">

  <style>
    .img-audit{
      height: 100px !important;
      width: 100px !important;
      overflow: hidden;
    }
    .test {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }
    .progress{
      width: 50%;
    }
    .loading {
      width: 100%;
      height: 100%;
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
          <img src="<?= base_url(); ?>public/img/logo_nbi.png" alt="User Image">
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
            <a href="<?= base_url(); ?>inspektor/form" class="nav-link active">
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
              <li class="breadcrumb-item"><a href="<?= base_url('inspektor/form'); ?>">Inspeksi</a></li>
              <li class="breadcrumb-item active">Form</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">

          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ada Temuan Inspeksi</h3>
              </div>
              <form id="tem_form" action="<?= base_url('inspektor/submit_form') ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
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
                    <label for="inputArea" class="col-sm-3 col-form-label">Area</label>
                    <div class="col-sm-9">
                      <select name="area" class="form-control" id="inputArea" required>
                        <option value="" disabled-selected hidden>--Pilih Area--</option>
                        <?php foreach($area as $ar): ?>
                            <option value="<?= $ar->kode_area ?>"><?= $ar->desk_area ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputTgl" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputShift" class="col-sm-3 col-form-label">Shift</label>
                    <div class="col-sm-9">
                      <select name="shift" class="form-control" id="inputShift" required>
                        <option value="" disabled-selected hidden>--Pilih Shift Inspeksi--</option>
                        <option value="1">Shift 1</option>
                        <option value="2">Shift 2</option>
                        <option value="3">Shift 3</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputItemTemuan" class="col-sm-3 col-form-label">Item Temuan</label>
                    <div class="col-sm-9">
                      <select name="item_temuan" class="form-control" id="inputItemTemuan" required>
                        <option value="" disabled-selected hidden>--Pilih Item Temuan--</option>
                        <?php foreach($item_temuan as $row): ?>
                            <option value="<?= $row->id_tem ?>"><?= $row->aspek_tem ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputKeterangan" class="col-sm-3 col-form-label">Foto Eviden</label>
                    <div class="col-sm-9">
                        <input name="eviden" type="file" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputKeterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                      <textarea type="text" class="form-control" row="5" name="keterangan" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                   <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                   <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>

              <br>
              <div class="test d-none">
                <div class="loading d-flex flex-wrap justify-content-center align-items-center">
                  <div class="progress">
                    <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    0%
                    </div>
                  </div>
                  <div class="text-center">
                    <p>Sedang proses upload gambar. Mohon menunggu.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Tidak Ada Temuan Inspeksi</h3>
              </div>
              <form action="<?= base_url('inspektor/submit_form2') ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="area_inspeksi" class="col-sm-3 col-form-label">Area</label>
                    <div class="col-sm-9">
                      <select name="area_inspeksi[]" class="form-select form-select-sm" id="area_inspeksi" multiple="multiple" aria-label="area_inspeksi" required placeholder="Pilih area inspeksi">
                        <option value="" disabled-selected hidden>--Pilih Area--</option>
                        <?php foreach($area as $ar): ?>
                            <option value="<?= $ar->kode_area ?>"><?= $ar->desk_area ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputTgl" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputShift" class="col-sm-3 col-form-label">Shift</label>
                    <div class="col-sm-9">
                      <select name="shift" class="form-control" id="inputShift" required>
                        <option value="" disabled-selected hidden>--Pilih Shift Inspeksi--</option>
                        <option value="1">Shift 1</option>
                        <option value="2">Shift 2</option>
                        <option value="3">Shift 3</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputKeterangan" class="col-sm-3 col-form-label">Foto Eviden</label>
                    <div class="col-sm-9">
                        <input name="eviden" type="file" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputKeterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                      <textarea type="text" class="form-control" row="5" name="keterangan" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
              
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
<script src="<?= base_url(); ?>assets/bootstrap/dist/js/popper.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- BM Multiselect -->
<script src="<?= base_url(); ?>assets/multi-select/dist/js/BsMultiSelect.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- Sweetalert -->
<script src="<?= base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/toastr/toastr.min.js"></script>
<!-- Page specific script -->

<script>
  <?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
  <?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
  <?php }else if($this->session->flashdata('warning')){  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
  <?php }else if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
  <?php } ?>
</script>
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

  $(document).ready(function(){
    $('#area_inspeksi').bsMultiSelect();
  });

</script>

<script>
	$(document).ready(function(){
	  $('#tem_form').ajaxForm({
		beforeSend:function(){
		  $(".test").fadeOut();
		  $('#success').empty();
		  $('.progress-bar').text('0%');
		  $('.progress-bar').css('width', '0%');
		},

		uploadProgress:function(event, position, total, percentComplete){
			let pc = percentComplete/10;
		  $(".test").fadeIn();
		  $(".test").removeClass("d-none");
		  $('.progress-bar').text(pc + '0%');
		  $('.progress-bar').css('width', pc + '0%');
		},

		success:function(data){
		  $(".test").fadeOut();
		  location.reload();
		}
	  });
	});
</script>

</body>
</html>
