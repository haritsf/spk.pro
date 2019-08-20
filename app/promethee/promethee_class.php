<?php
DEFINE('DBUSER', 'root');
DEFINE('DBPW', '');
DEFINE('DBHOST', 'localhost');
DEFINE('DBNAME', 'spk-native');

$koneksi = new mysqli(DBHOST, DBUSER, DBPW, DBNAME);
if ($koneksi) {
  // echo "Berhasil Koneksi";
}

$dbs = mysqli_select_db($koneksi, DBNAME);
if (!$dbs) {
  die("Database Not Connected : " . mysqli_error($koneksi));
  exit();
}

if ($koneksi) {
  //echo "berhasil koneksi";
} else {
  echo "Gagal Koneksi";
}

$query = mysqli_query($koneksi, "SELECT a.id, a.nama, a.code, k.nilai AS nilaiK, l.nilai AS nilaiL, rl.nilai AS nilaiRL, h.nilai AS nilaiH, air.nilai AS nilaiAir, t.nilai AS nilaiT FROM spk_alternatif a JOIN spk_kelerengan k ON a.id = k.id_alternatif JOIN spk_lahan l ON l.id_alternatif = k.id_alternatif JOIN spk_longsor rl ON rl.id_alternatif = l.id_alternatif JOIN spk_hujan h ON h.id_alternatif = rl.id_alternatif JOIN spk_air air ON air.id_alternatif = h.id_alternatif JOIN spk_tanah t ON t.id_alternatif = air.id_alternatif;");

$queryKriteria = mysqli_query($koneksi, "SELECT p, q, s, bobot FROM spk_kriteria;");

$array = array();
$arrayKriteria = array();
while ($row = mysqli_fetch_array($query)) {
  $array[] = $row;
}

while ($baris = mysqli_fetch_array($queryKriteria)) {
  $arrayKriteria[] = $baris;
}

foreach ($arrayKriteria as $key => $value) {
  for ($i = 0; $i < count($array); $i++) {
    for ($j = 0; $j < count($array); $j++) {
      $getdata = $array[$i]['nama'] . ' ' . $array[$j]['nama'];

      // Kelerengan
      $deviasi = ($array[$i]['nilaiK'] - $array[$j]['nilaiK']);
      $nilaiAbsolut = abs($deviasi);
      if ($nilaiAbsolut <= $arrayKriteria[$key = 0]['q']) {
        $preferensi = 0;
      } elseif ($arrayKriteria[$key = 0]['q'] < $nilaiAbsolut and $nilaiAbsolut <= $arrayKriteria[$key = 0]['p']) {
        $preferensi = 0.5;
      } else {
        $preferensi = 1;
      }
      $indexPrefK = $preferensi * $arrayKriteria[$key = 0]['bobot'];

      // Penggunaan Lahan
      $deviasi = ($array[$i]['nilaiL'] - $array[$j]['nilaiL']);
      if (-($arrayKriteria[$key = 1]['p']) <= $deviasi and $deviasi <= $arrayKriteria[$key = 1]['p']) {
        $preferensi = ($deviasi / $arrayKriteria[$key = 1]['p']);
      } elseif ($deviasi < -($arrayKriteria[$key = 1]['p']) or $deviasi > $arrayKriteria[$key = 1]['p']) {
        $preferensi = 1;
      }
      $indexPrefL = $preferensi * $arrayKriteria[$key = 1]['bobot'];

      // Rawan Longsor
      $deviasi = ($array[$i]['nilaiRL'] - $array[$j]['nilaiRL']);
      if (-($arrayKriteria[$key = 2]['p']) <= $deviasi and $deviasi <= $arrayKriteria[$key = 2]['p']) {
        $preferensi = ($deviasi / $arrayKriteria[$key = 2]['p']);
      } elseif ($deviasi < -($arrayKriteria[$key = 2]['p']) or $deviasi > $arrayKriteria[$key = 2]['p']) {
        $preferensi = 1;
      }
      $indexPrefRL = $preferensi * $arrayKriteria[$key = 2]['bobot'];

      // Curah Hujan
      $deviasi = ($array[$i]['nilaiH'] - $array[$j]['nilaiH']);
      if (-($arrayKriteria[$key = 3]['q']) <= $deviasi and $deviasi <= $arrayKriteria[$key = 3]['q']) {
        $preferensi = 0;
      } elseif ($deviasi < -$arrayKriteria[$key = 3]['q'] or $deviasi > $arrayKriteria[$key = 3]['q']) {
        $preferensi = 1;
      }
      $indexPrefH = $preferensi * $arrayKriteria[$key = 3]['bobot'];

      // Cadangan Air Tanah
      $deviasi = ($array[$i]['nilaiAir'] - $array[$j]['nilaiAir']);
      $nilaiAbsolut = abs($deviasi);
      if ($nilaiAbsolut <= $arrayKriteria[$key = 4]['q']) {
        $preferensi = 0;
      } elseif ($arrayKriteria[$key = 4]['q'] < $nilaiAbsolut and $nilaiAbsolut <= $arrayKriteria[$key = 4]['p']) {
        $preferensi = ($nilaiAbsolut - $arrayKriteria[$key = 4]['q']) / ($arrayKriteria[$key = 4]['p'] - $arrayKriteria[$key = 4]['q']);
      } elseif ($arrayKriteria[$key = 4]['p'] < $nilaiAbsolut) {
        $preferensi = 1;
      }
      $indexPrefAir = $preferensi * $arrayKriteria[$key = 4]['bobot'];

      // Jenis Tanah
      $deviasi = ($array[$i]['nilaiT'] - $array[$j]['nilaiT']);
      if (-($arrayKriteria[$key = 5]['p']) <= $deviasi and $deviasi <= $arrayKriteria[$key = 5]['p']) {
        $preferensi = ($deviasi / $arrayKriteria[$key = 5]['p']);
      } elseif ($deviasi < -($arrayKriteria[$key = 5]['p']) or $deviasi > $arrayKriteria[$key = 5]['p']) {
        $preferensi = 1;
      }
      $indexPrefT = $preferensi * $arrayKriteria[$key = 5]['bobot'];

      // Mulai
      $totalIndex = $indexPrefK + $indexPrefL + $indexPrefRL + $indexPrefH + $indexPrefAir + $indexPrefT;
      $arrayIndex[$i][$j] = $totalIndex;

      // PRINT
      // echo $i . ' ' . $j . ' ' . $getdata . '<br> Index Kelerengan = ' . number_format($indexPrefK, 4) . '<br> Index Lahan = ' . number_format($indexPrefL, 4) . '<br> Index Longsor = ' . number_format($indexPrefRL, 4) . '<br> Index Hujan = ' . number_format($indexPrefH, 4) . '<br> Index Air Tanah = ' . number_format($indexPrefAir, 4) . '<br> Index Tanah = ' . number_format($indexPrefT, 4) . '<br> Total Index = ' . number_format($totalIndex, 4) . '<br><br>';
    }
  }
}

?>

<br><br><br><br><br><br><br><br><br>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8">
      <div class="table-responsive">
        <table width="100%" class="table table-striped table-bordered table-hover" id="totalPref">
          <thead align="center">
            <tr>
              <th width="100">Alternatif</th>
              <?php
              for ($i = 0; $i < count($array); $i++) { ?>
                <th><?php echo $array[$i]['nama']; ?></th>
              <?php } ?>
              <th style="color:#fafafa; background-color: #999999;">Jumlah</th>
              <th style="color:#fafafa; background-color: #666666;">Leaving</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $jumlah = 0;
            for ($a = 0; $a < count($array); $a++) { ?>
              <tr>
                <td align="left"><?php echo $array[$a]['nama']; ?></td>
                <?php for ($b = 0; $b < count($array); $b++) { ?>
                  <td align="center">
                    <?php
                    if ($a == $b or $b == $a) {
                      echo '<i><b>' . number_format($arrayIndex[$a][$b], 4) . '</i></b>';
                    } else {
                      echo number_format($arrayIndex[$a][$b], 4);
                    }
                    $jumlah = $jumlah + $arrayIndex[$a][$b];
                    ?>
                  </td>

                <?php } ?>
                <td align="center" style="color:#fafafa; background-color: #999999;">
                  <?php echo number_format($jumlah, 4); ?>
                </td>
                <td align="center" style="color:#fafafa; background-color: #666666;">
                  <?php
                  $leaving = $jumlah / (count($array) - 1);
                  echo number_format($leaving, 4);
                  $bufferLeaving[$a] = $leaving;
                  $jumlah = 0; ?>
                </td>
              </tr>
            <?php } ?>
            <tr style="color:#fafafa; background-color: #999999;">
              <td>Jumlah</td>
              <?php
              for ($a = 0; $a < count($array); $a++) {
                for ($b = 0; $b < count($array); $b++) {
                  $jumlah = $jumlah + $arrayIndex[$b][$a];
                } ?>
                <td align="center">
                  <?php
                  echo number_format($jumlah, 4);
                  $jumlah = 0; ?>
                </td>
              <?php } ?>
            </tr>
            <tr style="color:#fafafa; background-color: #666666;">
              <td>Entering</td>
              <?php
              for ($a = 0; $a < count($array); $a++) {
                for ($b = 0; $b < count($array); $b++) {
                  $jumlah = $jumlah + $arrayIndex[$b][$a];
                }
                $entering = $jumlah / (count($array) - 1); ?>
                <td align="center">
                  <?php
                  echo number_format($entering, 4);
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

    <div class="col-md-4">
      <h2>
        <center>Ranking</center>
      </h2>
      <?php
      for ($a = 0; $a < count($array); $a++) {
        $netflow[$a] = ($bufferLeaving[$a] - $bufferEntering[$a]);
        // echo number_format($bufferLeaving[$a], 4) . '<br>' . number_format($bufferEntering[$a], 4) . '<br><br>';
      }
      // var_dump($netflow);
      arsort($netflow);
      $n = 1; ?>

      <table width="100%" class="table table-striped table-bordered table-hover" id="totalPref">
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
              <td><?php echo $array[$x]['nama']; ?></td>
              <td><?php echo number_format($net, 4); ?></td>
              <?php $n++;
            } ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>