<?php
  DEFINE('DBUSER', 'phpmyadmin');
  DEFINE('DBPW', 'admin123');
  DEFINE('DBHOST', 'localhost');
  DEFINE('DBNAME', 'spk-promethee');
  
  $koneksi = new mysqli(DBHOST, DBUSER, DBPW, DBNAME);
  if ($koneksi) {
  }
  
  $dbs = mysqli_select_db($koneksi, DBNAME);
  if (!$dbs) {
    die("Database Not Connected : " . mysqli_error($koneksi));
    exit();
  }
  
  if ($koneksi) {
  } else {
    echo "Gagal Koneksi";
  }
  
  $id_pref = $bobot = $preferensi = null;

function CountKriterias($koneksi)
{
  $query  = mysqli_query($koneksi, "SELECT * FROM kriterias");
  $rows   = mysqli_num_rows($query);
  return $rows;
}

function CountAlternatifs($koneksi)
{
  $query  = mysqli_query($koneksi, "SELECT * FROM alternatifs");
  $rows   = mysqli_num_rows($query);
  return $rows;
}

function Preferensi($koneksi, $no, $id_pref, $nilaiDeviasi, $nilaiAbsolut)
{
  $query = mysqli_query($koneksi, "SELECT * FROM kriterias");
  while ($row  = mysqli_fetch_array($query)) {
    $id_pref[] = $row['pref'];
    $q[] = $row['q'];
    $p[] = $row['p'];
  }
  $no = $no - 1;

  switch ($id_pref[$no]) {
    case '1':
      // Usual
      if ($nilaiDeviasi == 0) {
        $preferensi = 0;
      } else {
        $preferensi = 1;
      }
      break;
    case '2':
      // Kuasi
      if (-$q[$no] <= $nilaiDeviasi and $nilaiDeviasi <= $q[$no]) {
        $preferensi = 0;
      } elseif ($nilaiDeviasi < -$q[$no] or $nilaiDeviasi > $q[$no]) {
        $preferensi = 1;
      }
      break;
    case '3':
      // Linier
      if (-$p[$no] <= $nilaiDeviasi and $nilaiDeviasi <= $p[$no]) {
        $preferensi = ($nilaiDeviasi / $p[$no]);
      } elseif ($nilaiDeviasi < -$p[$no] or $nilaiDeviasi > $p[$no]) {
        $preferensi = 1;
      }
      break;
    case '4':
      // Level
      if ($nilaiAbsolut <= $q[$no]) {
        $preferensi = 0;
      } elseif ($q[$no] < $nilaiAbsolut and $nilaiAbsolut <= $p[$no]) {
        $preferensi = 0.5;
      } elseif ($p[$no] < $nilaiAbsolut) {
        $preferensi = 1;
      }
      break;
    case '5':
      // Area
      if ($nilaiAbsolut <= $q[$no]) {
        $preferensi = 0;
      } elseif ($q[$no] < $nilaiAbsolut and $nilaiAbsolut <= $p[$no]) {
        $preferensi = ($nilaiAbsolut - $q[$no]) / ($p[$no] - $q[$no]);
      } elseif ($p[$no] < $nilaiAbsolut) {
        $preferensi = 1;
      }
      break;
    case '6':
      // Gaussian
      echo 'Preferensi Gaussian<br>';
      break;
  }

  return number_format($preferensi, 2);
}

function IndeksPreferensi($koneksi, $no, $preferensi, $id_pref, $nilaiDeviasi, $nilaiAbsolut)
{
  $query = mysqli_query($koneksi, "SELECT * FROM kriterias WHERE id = $no");
  while ($row  = mysqli_fetch_array($query)) {
    $bobot[] = $row['bobot'];
  }
  $preferensi = Preferensi($koneksi, $no, $id_pref, $nilaiDeviasi, $nilaiAbsolut);
  $indexPref = floatval($bobot[0]) * $preferensi;
  return number_format($indexPref, 2);
}

function Absolut($datas, $x, $y)
{
  $nilaiAbsolut = abs(Deviasi($datas, $x, $y));
  return $nilaiAbsolut;
}

function Deviasi($datas, $x, $y)
{
  $nilaiDeviasi = $datas[$x]['nilai'] - $datas[$y]['nilai'];
  return $nilaiDeviasi;
}

for ($x = 1; $x <= CountAlternatifs($koneksi); $x++) {
  for ($y = 1; $y <= CountAlternatifs($koneksi); $y++) {
    $totalIndex = null;
    for ($no = 1; $no <= CountKriterias($koneksi); $no++) {
      $query = mysqli_query($koneksi, "SELECT e.id AS id, a.nama AS alternatif, k.nama AS kriteria, e.nilai AS nilai FROM evals e JOIN alternatifs a ON a.id = e.alternatif JOIN kriterias k ON e.kriteria = k.id WHERE k.id = $no");
      $datas = array($query);
      while ($row = mysqli_fetch_array($query)) {
        $datas[] = $row;
      }
      $nilaiAbsolut = Absolut($datas, $x, $y);
      $nilaiDeviasi = Deviasi($datas, $x, $y);
      $preferensi = Preferensi($koneksi, $no, $id_pref, $nilaiDeviasi, $nilaiAbsolut);
      $indexPref = IndeksPreferensi($koneksi, $no, $preferensi, $id_pref, $nilaiDeviasi, $nilaiAbsolut);
      $totalIndex = $totalIndex + $indexPref;
    }
    $arrayIndex[$x][$y] = $totalIndex;
  }
}
?>

@extends('layout.client')

@section('content')

<div class="hero-wrapper">
  <div class="hero">
    <div class="container">
      <div class="text text-center text-md-left animated fadeInUp delay-0.5s">
        <h1>Analisa</h1>
        <p>Menampilkan Langkah - Langkah dalam pemrosesan Data menggunakan Metode PROMETHEE.</p>
        <div class="cta animated fadeInUp delay-1s" id="nav">
          <a class="btn btn-warning btn-md btn-icon icon-right" href="#analisa">Lanjut <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
      <div class="image d-none d-lg-block animated fadeIn delay-1s">
        <img src="{{url('img/ill.svg')}}" alt="img">
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <div class="card shadow rounded" id="analisa">
        <div class="card-header">
          <h2>Matriks Persebaran</h2>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table heigth="100%" class="table table-striped table-bordered table-hover table-md" id="totalPref">
              <thead align="center">
                <tr>
                  <th width="100">Alternatif</th>
                  <?php
                          for ($x = 1; $x <= CountAlternatifs($koneksi); $x++) { ?>
                  <th><?php echo $datas[$x]['alternatif']; ?></th>
                  <?php } ?>
                  <th style="color:#fafafa; background-color: #999999;">Jumlah</th>
                  <th style="color:#fafafa; background-color: #666666;">Leaving</th>
                </tr>
              </thead>
              <tbody>
                <?php
                        $jumlah = 0;
                        for ($a = 1; $a <= CountAlternatifs($koneksi); $a++) { ?>
                <tr>
                  <td align="left"><?php echo $datas[$a]['alternatif']; ?></td>
                  <?php for ($b = 1; $b <= CountAlternatifs($koneksi); $b++) { ?>
                  <td align="center">
                    <?php
                                if ($a == $b or $b == $a) {
                                  echo '<b>' . number_format($arrayIndex[$a][$b], 2) . '</b>';
                                } else {
                                  echo number_format($arrayIndex[$a][$b], 2);
                                }
                                $jumlah = $jumlah + $arrayIndex[$a][$b];
                                ?>
                  </td>

                  <?php } ?>
                  <td align="center" style="color:#fafafa; background-color: #999999;">
                    <?php echo number_format($jumlah, 2); ?>
                  </td>
                  <td align="center" style="color:#fafafa; background-color: #666666;">
                    <?php
                              $leaving = $jumlah / (CountAlternatifs($koneksi) - 1);
                              echo number_format($leaving, 2);
                              $bufferLeaving[$a] = $leaving;
                              $jumlah = 0; ?>
                  </td>
                </tr>
                <?php } ?>
                <tr style="color:#fafafa; background-color: #999999;">
                  <td>Jumlah</td>
                  <?php
                          for ($a = 1; $a < CountAlternatifs($koneksi); $a++) {
                            for ($b = 1; $b < CountAlternatifs($koneksi); $b++) {
                              $jumlah = $jumlah + $arrayIndex[$b][$a];
                            } ?>
                  <td align="center">
                    <?php
                              echo number_format($jumlah, 2);
                              $jumlah = 0; ?>
                  </td>
                  <?php } ?>
                </tr>
                <tr style="color:#fafafa; background-color: #666666;">
                  <td>Entering</td>
                  <?php
                          for ($a = 1; $a < CountAlternatifs($koneksi); $a++) {
                            for ($b = 1; $b < CountAlternatifs($koneksi); $b++) {
                              $jumlah = $jumlah + $arrayIndex[$b][$a];
                            }
                            $entering = $jumlah / (CountAlternatifs($koneksi) - 1); ?>
                  <td align="center">
                    <?php
                              echo number_format($entering, 2);
                              $bufferEntering[$a] = $entering;
                              $jumlah = 0;
                              ?>
                  </td>
                  <?php } ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card shadow rounded">
        <div class="card-header">
          <h2>Ranking</h2>
        </div>
        <div class="card-body">
            <?php
                                      for ($a = 1; $a < CountAlternatifs($koneksi); $a++) {
                                        $netflow[$a] = ($bufferLeaving[$a] - $bufferEntering[$a]);
                                      }
                                      arsort($netflow);
                                      $n = 1; ?>
            <table width="100%" class="table table-striped table-bordered table-hover table-md" id="totalPref">
              <thead>
                <tr>
                  <th>
                    <center>Ranking</center>
                  </th>
                  <th>
                    <center>Kecamatan</center>
                  </th>
                  <th>
                    <center>Netflow</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                                        foreach ($netflow as $x => $net) { ?>
                <tr align="center">
                  <td><?php echo $n; ?></td>
                  <td><?php echo $datas[$x]['alternatif']; ?></td>
                  <td><?php echo number_format($net, 2); ?></td>
                  <?php $n++;
                                          } ?>
                </tr>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
