<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $periode ?> | PT.NBI</title>
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/home.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/fontawesome/css/font-awesome.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="logo">
    <img src="<?= base_url(); ?>public/img/logo1.png" alt="LOGO">
  </div>
  <div class="push-left">
    <button id="menu-toggler" data-class="menu-active" class="hamburger">
      <span class="hamburger-line hamburger-line-top"></span>
      <span class="hamburger-line hamburger-line-middle"></span>
      <span class="hamburger-line hamburger-line-bottom"></span>
    </button>

    <!--  Menu compatible with wp_nav_menu  -->
    <ul id="primary-menu" class="menu nav-menu">
      <li class="menu-item current-menu-item"><a class="nav__link txt-black"  href="<?= base_url('welcome') ?>">Home</a></li>
      <li class="menu-item current-menu-item"><a class="nav__link txt-black"  href="#reports">Reports</a></li>
	  <li class="menu-item current-menu-item"><a class="nav__link txt-black"  href="#pareto-temuan">Pareto</a></li>
      <li class="menu-item current-menu-item"><a class="nav__link txt-black"  href="https://api.whatsapp.com/send/?phone=6287834887863&text&app_absent=0" target="_blank">Support</a></li>
      <li class="menu-item ">
        <a class="nav__link txt-primary btn-out-primary"  href="<?= base_url('auth') ?>">Login</a>
      </li>
    </ul>

  </div>
</nav>
<!-- End Navbar -->

<!-- Main -->
<div class="container">
  <div id="reports" class="row">
    <div class="flex-container">
      <div class="flex-item bg-secondary">
        <div class="flx1">
          <i class="fa fa-bar-chart"></i>
        </div>
        <div class="flx">
          <h3><?= $jlh_tb[0]->count ?></h3>
          <p>Semua Temuan</p>
        </div>
      </div>
      <div class="flex-item bg-primary">
        <div class="flx1">
          <i class="fa fa-bar-chart"></i>
        </div>
        <div class="flx">
          <h3><?= $jlh_op[0]->count ?></h3>
          <p>Semua TO</p>
        </div>
      </div>
      <div class="flex-item bg-danger">
        <div class="flx1">
          <i class="fa fa-bar-chart"></i>
        </div>
        <div class="flx">
          <h3><?= $jlh_os[0]->count ?></h3>
          <p>TO Sebelumnya</p>
        </div>
      </div>
      <div class="flex-item bg-warning">
        <div class="flx1">
          <i class="fa fa-bar-chart"></i>
        </div>
        <div class="flx">
          <h3><?= $jlh_btl[0]->count ?></h3>
          <p>Belum TL</p>
        </div>
      </div>
      <div class="flex-item bg-info">
        <div class="flx1">
          <i class="fa fa-bar-chart"></i>
        </div>
        <div class="flx">
          <h3><?= $jlh_stl[0]->count ?></h3>
          <p>Sudah TL</p>
        </div>
      </div>
      <div class="flex-item bg-dark">
        <div class="flx1">
          <i class="fa fa-bar-chart"></i>
        </div>
        <div class="flx">
          <h3><?= $jlh_tcall[0]->count ?></h3>
          <p>Sudah Closed</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row-filter">
    <div class="form">
      <form action="<?= base_url('welcome') ?>" method="post">
        <div class="input-group">
          <input id="thn_filter" type="number" name="periode" min="2021" step='1' value='<?= $tahun ?>'>
          <button class="btn-primary">Filter</button>
        </div>
      </form>
    </div>
  </div>

  <div class="row-chart">
    <div class="card">
      <div class="card-item">
        <canvas id="lineChartTA"></canvas>
      </div>
    </div>
    <div class="card">
      <div class="card-item">
        <canvas id="barChartTA"></canvas>
      </div>
    </div>
  </div>
  
  <div class="row-chart">
    <div class="card">
      <div class="card-item">
        <canvas id="barpChartTA" ></canvas>
      </div>
    </div>
    <div class="card">
      <div class="card-item">
        <canvas id="barnChartTA" ></canvas>
      </div>
    </div>
  </div>

  <div class="row-table">
    <div class="card">
      <table class="table1">
        <thead>
          <tr>
            <th>No</th>
            <th>Alur Pelaksanaan</th>
            <th>Ekspektasi</th>
            <th>Realisasi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>AUDIT AWAL-AKHIR</td>
            <td>100%</td>
            <td><?= round(($jlh_tca[0]->count/$jlh_tall[0]->count)*100) ?>%</td>
          </tr>
          <tr>
            <td>2</td>
            <td>AUDIT AWAL-TINDAK LANJUT</td>
            <td>100%</td>
            <td><?= round(($jlh_stla[0]->count/$jlh_tall[0]->count)*100) ?>%</td>
          </tr>
          <tr>
            <td>3</td>
            <td>AUDIT AWAL-OTORISASI</td>
            <td>100%</td>
            <td><?= round(($jlh_sota[0]->count/$jlh_tall[0]->count)*100) ?>%</td>
          </tr>
          <tr>
            <td>4</td>
            <td>AUDIT AWAL</td>
            <td>100%</td>
            <td><?= round(($jlh_btla[0]->count/$jlh_tall[0]->count)*100) ?>%</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="card">
      <table class="table1">
        <thead>
          <tr>
            <th>Area</th>
            <th>Jadwal</th>
            <th>Realisasi</th>
            <th>Persentasi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>PABRIK</td>
            <td><?= ($jpt[0]->count + $jpf[0]->count) ?></td>
            <td><?= $jpt[0]->count ?></td>
            <td><?= round(($jpt[0]->count)/($jpt[0]->count + $jpf[0]->count)*100) ?>%</td>
          </tr>
          <tr>
            <td>NON-PABRIK</td>
            <td><?= $jnpt[0]->count + $jnpf[0]->count ?></td>
            <td><?= $jnpt[0]->count ?></td>
            <td><?= round(($jnpt[0]->count)/($jnpt[0]->count + $jnpf[0]->count)*100) ?>%</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row-table2">
    <!-- Pareto -->
    <div id="pareto-temuan" class="card-pareto">
      <div class="pareto-header">
        <p>Pareto Temuan Audit 5R Tahun <?= $prd ?></p>
      </div>
      <table class="table2">
        <thead>
          <tr>
            <th>5R</th>
            <th>Aspek</th>
            <th>Pareto</th>
            <th>Auditie</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td rowspan="9" class="">RINGKAS</td>
            <td rowspan="3" class=""><?= $pareto_ringkas[0]->desk_aspek ?></td>
            <td class=""><?= $pareto_ringkas[0]->desk_pt ?></td>
            <td class=""><?= $pareto_ringkas[0]->area_dept ?></td>
            <td class=""><?= $pareto_ringkas[0]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_ringkas[1]->desk_pt ?></td>
            <td class=""><?= $pareto_ringkas[1]->area_dept ?></td>
            <td class=""><?= $pareto_ringkas[1]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_ringkas[2]->desk_pt ?></td>
            <td class=""><?= $pareto_ringkas[2]->area_dept ?></td>
            <td class=""><?= $pareto_ringkas[2]->total ?></td>
          </tr>

          <tr>
            <td rowspan="3" class=""><?= $pareto_ringkas[3]->desk_aspek ?></td>
            <td class=""><?= $pareto_ringkas[3]->desk_pt ?></td>
            <td class=""><?= $pareto_ringkas[3]->area_dept ?></td>
            <td class=""><?= $pareto_ringkas[3]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_ringkas[4]->desk_pt ?></td>
            <td class=""><?= $pareto_ringkas[4]->area_dept ?></td>
            <td class=""><?= $pareto_ringkas[4]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_ringkas[5]->desk_pt ?></td>
            <td class=""><?= $pareto_ringkas[5]->area_dept ?></td>
            <td class=""><?= $pareto_ringkas[5]->total ?></td>
          </tr>

          <tr>
            <td rowspan="3" class=""><?= $pareto_ringkas[6]->desk_aspek ?></td>
            <td class=""><?= $pareto_ringkas[6]->desk_pt ?></td>
            <td class=""><?= $pareto_ringkas[6]->area_dept ?></td>
            <td class=""><?= $pareto_ringkas[6]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_ringkas[7]->desk_pt ?></td>
            <td class=""><?= $pareto_ringkas[7]->area_dept ?></td>
            <td class=""><?= $pareto_ringkas[7]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_ringkas[8]->desk_pt ?></td>
            <td class=""><?= $pareto_ringkas[8]->area_dept ?></td>
            <td class=""><?= $pareto_ringkas[8]->total ?></td>
          </tr>

          <tr>
            <td rowspan="9" class="">RAPI</td>
            <td rowspan="3" class=""><?= $pareto_rapi[0]->desk_aspek ?></td>
            <td class=""><?= $pareto_rapi[0]->area_dept ?></td>
            <td class=""><?= $pareto_rapi[0]->desk_pt ?></td>
            <td class=""><?= $pareto_rapi[0]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_rapi[1]->desk_pt ?></td>
            <td class=""><?= $pareto_rapi[1]->area_dept ?></td>
            <td class=""><?= $pareto_rapi[1]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_rapi[2]->desk_pt ?></td>
            <td class=""><?= $pareto_rapi[2]->area_dept ?></td>
            <td class=""><?= $pareto_rapi[2]->total ?></td>
          </tr>

          <tr>
            <td rowspan="3" class=""><?= $pareto_rapi[3]->desk_aspek ?></td>
            <td class=""><?= $pareto_rapi[3]->desk_pt ?></td>
            <td class=""><?= $pareto_rapi[3]->area_dept ?></td>
            <td class=""><?= $pareto_rapi[3]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_rapi[4]->desk_pt ?></td>
            <td class=""><?= $pareto_rapi[4]->area_dept ?></td>
            <td class=""><?= $pareto_rapi[4]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_rapi[5]->desk_pt ?></td>
            <td class=""><?= $pareto_rapi[5]->area_dept ?></td>
            <td class=""><?= $pareto_rapi[5]->total ?></td>
          </tr>

          <tr>
            <td rowspan="3" class=""><?= $pareto_rapi[6]->desk_aspek ?></td>
            <td class=""><?= $pareto_rapi[6]->desk_pt ?></td>
            <td class=""><?= $pareto_rapi[6]->area_dept ?></td>
            <td class=""><?= $pareto_rapi[6]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_rapi[7]->desk_pt ?></td>
            <td class=""><?= $pareto_rapi[7]->area_dept ?></td>
            <td class=""><?= $pareto_rapi[7]->total ?></td>
          </tr>
          <tr>
            <td class=""><?= $pareto_rapi[8]->desk_pt ?></td>
            <td class=""><?= $pareto_rapi[8]->area_dept ?></td>
            <td class=""><?= $pareto_rapi[8]->total ?></td>
          </tr>

          <tr>
              <td rowspan="9" class="">RESIK</td>
              <td rowspan="3" class=""><?= $pareto_resik[0]->desk_aspek ?></td>
              <td class=""><?= $pareto_resik[0]->desk_pt ?></td>
              <td class=""><?= $pareto_resik[0]->area_dept ?></td>
              <td class=""><?= $pareto_resik[0]->total ?></td>
          </tr>
          <tr>
              <td class=""><?= $pareto_resik[1]->desk_pt ?></td>
              <td class=""><?= $pareto_resik[1]->area_dept ?></td>
              <td class=""><?= $pareto_resik[1]->total ?></td>
          </tr>
          <tr>
              <td class=""><?= $pareto_resik[2]->desk_pt ?></td>
              <td class=""><?= $pareto_resik[2]->area_dept ?></td>
              <td class=""><?= $pareto_resik[2]->total ?></td>
          </tr>

          <tr>
              <td rowspan="3" class=""><?= $pareto_resik[3]->desk_aspek ?></td>
              <td class=""><?= $pareto_resik[3]->desk_pt ?></td>
              <td class=""><?= $pareto_resik[3]->area_dept ?></td>
              <td class=""><?= $pareto_resik[3]->total ?></td>
          </tr>
          <tr>
              <td class=""><?= $pareto_resik[4]->desk_pt ?></td>
              <td class=""><?= $pareto_resik[4]->area_dept ?></td>
              <td class=""><?= $pareto_resik[4]->total ?></td>
          </tr>
          <tr>
              <td class=""><?= $pareto_resik[5]->desk_pt ?></td>
              <td class=""><?= $pareto_resik[5]->area_dept ?></td>
              <td class=""><?= $pareto_resik[5]->total ?></td>
          </tr>

          <tr>
              <td rowspan="3" class=""><?= $pareto_resik[6]->desk_aspek ?></td>
              <td class=""><?= $pareto_resik[6]->desk_pt ?></td>
              <td class=""><?= $pareto_resik[6]->area_dept ?></td>
              <td class=""><?= $pareto_resik[6]->total ?></td>
          </tr>
          <tr>
              <td class=""><?= $pareto_resik[7]->desk_pt ?></td>
              <td class=""><?= $pareto_resik[7]->area_dept ?></td>
              <td class=""><?= $pareto_resik[7]->total ?></td>
          </tr>
          <tr>
              <td class=""><?= $pareto_resik[8]->desk_pt ?></td>
              <td class=""><?= $pareto_resik[8]->area_dept ?></td>
              <td class=""><?= $pareto_resik[8]->total ?></td>
          </tr>


          <tr>
              <td rowspan="3" class="">RAWAT</td>
              <td rowspan="3" class=""><?= $pareto_rawat[0]->desk_aspek ?></td>
              <td class=""><?= $pareto_rawat[0]->desk_pt ?></td>
              <td class=""><?= $pareto_rawat[0]->area_dept ?></td>
              <td class=""><?= $pareto_rawat[0]->total ?></td>
          </tr>
          <tr>
              <td class=""><?= $pareto_rawat[1]->desk_pt ?></td>
              <td class=""><?= $pareto_rawat[1]->area_dept ?></td>
              <td class=""><?= $pareto_rawat[1]->total ?></td>
          </tr>
          <tr>
              <td class=""><?= $pareto_rawat[2]->desk_pt ?></td>
              <td class=""><?= $pareto_rawat[2]->area_dept ?></td>
              <td class=""><?= $pareto_rawat[2]->total ?></td>
          </tr>
      </table>
    </div>
    <!-- End Pareto -->
  </div>
</div>
<!-- End Main -->

<footer class="footer">
  <div>
	<p>Developed by IT Support NBI Demak - 2022 - PT Nusantara Building Industries</p>
  </div>
</footer>


<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/home.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
<script>
  const base_url = window.location.origin + "/audit/";
  let thn = document.getElementById("thn_filter");
  $(document).ready(function() {
    $.ajax({
      type: 'POST',
      url: base_url + "welcome/getDataPBR",
	  data: {tahun: thn.value},
      cache: false,
      success: function(res){
        var data_pbr = JSON.parse(res);
        console.log(data_pbr);
        let label = [];
        let datas = [];
        data_pbr.forEach(item => {
          label.push(item.area_dept);
          datas.push(item.count);
        });
        console.log(label);
        console.log(datas);
        const data3 = {
          labels: label,
          datasets: [{
            backgroundColor: '#bc3535',
            borderColor: '#bc3535',
            data: datas,
            tension: 0.2
          }]
        };
        const config3 = {
          type: 'bar',
          data: data3,
          options: {
            plugins: {
              title: {
                display: true,
                text: 'Chart Temuan Audit Pabrik',
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
        const myChart3 = new Chart(
          document.getElementById('barpChartTA'),
          config3
        );
      }
    });

    $.ajax({
      type: 'POST',
      url: base_url + "welcome/getDataNPBR",
	  data: {tahun: thn.value},
      cache: false,
      success: function(res){
        var data_pbr = JSON.parse(res);
        console.log(data_pbr);
        let label = [];
        let datas = [];
        data_pbr.forEach(item => {
          label.push(item.area_dept);
          datas.push(item.count);
        });
        console.log(label);
        console.log(datas);
        const data4 = {
          labels: label,
          datasets: [{
            backgroundColor: '#158f52',
            borderColor: '#158f52',
            data: datas,
            tension: 0.2
          }]
        };
        const config4 = {
          type: 'bar',
          data: data4,
          options: {
            plugins: {
              title: {
                display: true,
                text: 'Chart Temuan Audit Non Pabrik',
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
        const myChart4 = new Chart(
          document.getElementById('barnChartTA'),
          config4
        );
      }
    });
  });
</script>
<script>
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
  const labels2 = [
    'CAP', //Closed All Periode
    'OAP', //Open All Periode
    'STL', //Sudah Tindak Lanjut
    'BOT', //Belum Otorisasi
    'SOBTL', //Sudah Otorisasi Belum Tindak Lanjut
    'All' //Temuan All
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Line Chart Temuan Audit',
      backgroundColor: '#2fe0ffc6',
      borderColor: '#188ca1c6',
      data: [
        <?= $jan[0]->count ?>, 
        <?= $feb[0]->count ?>, 
        <?= $mar[0]->count ?>, 
        <?= $apr[0]->count ?>, 
        <?= $mei[0]->count ?>, 
        <?= $jun[0]->count ?>, 
        <?= $jul[0]->count ?>, 
        <?= $agu[0]->count ?>, 
        <?= $sep[0]->count ?>, 
        <?= $okt[0]->count ?>, 
        <?= $nov[0]->count ?>, 
        <?= $des[0]->count ?>, 
      ],
      tension: 0.2
    }]
  };
  const data2 = {
    labels: labels2,
    datasets: [{
      label: 'Bar Chart Temuan Audit',
      data: [
        <?= $jlh_tca[0]->count ?>, 
        <?= $jlh_toa[0]->count ?>, 
        <?= $jlh_stla[0]->count ?>, 
        <?= $jlh_btla[0]->count ?>, 
        <?= $jlh_sota[0]->count ?>, 
        <?= $jlh_tall[0]->count ?>, 
      ],
      backgroundColor: [
        '#bf55ce',
        '#b38735',
        '#2fe0ffc6',
        '#6eb324',
        '#3db7a7',
        '#2b37a5'
      ],
      hoverOffset: 4
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
	  plugins: {
        title: {
          display: true,
          text: 'Chart Temuan Audit Per Periode',
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
  const config2 = {
    type: 'doughnut',
    data: data2,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('lineChartTA'),
    config
  );
  const myChart2 = new Chart(
    document.getElementById('barChartTA'),
    config2
  );
</script>

</body>
</html>