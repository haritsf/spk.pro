@php
  DEFINE('DBUSER', 'root');
  DEFINE('DBPW', '');
  DEFINE('DBHOST', 'localhost');
  DEFINE('DBNAME', 'promethee');
  
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

$jumlah = null;
// NGITUNG LEAVING
for ($a = 1; $a <= CountAlternatifs($koneksi); $a++) {
    for ($a = 1; $a <= CountAlternatifs($koneksi); $a++) {
        for ($b = 1; $b <= CountAlternatifs($koneksi); $b++) {
            $jumlah = $jumlah + $arrayIndex[$a][$b];
        }
        $leaving = $jumlah / (CountAlternatifs($koneksi) - 1);
        $bufferLeaving[$a] = $leaving;
        $jumlah = 0;
    }
}

// NGITUNG ENTERING
for ($a = 1; $a < CountAlternatifs($koneksi); $a++) {
    for ($b=1; $b < CountAlternatifs($koneksi); $b++) {
        $jumlah=$jumlah + $arrayIndex[$b][$a]; 
    }
    $entering=$jumlah / (CountAlternatifs($koneksi) - 1);
    $bufferEntering[$a]=$entering;
    $jumlah=0;
}

@endphp

@extends('layout.dashboard')

@section('content')
{{-- {{ dd($datas)}} --}}
{{-- {{ dd($nilaiAbsolut)}} --}}

@section('pages','admin')
@section('title','home')

<section class="section">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-statistic-1 shadow rounded">
                <div class="card-icon bg-primary">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Evaluasi</h4>
                    </div>
                    <div class="card-body">
                        {{ $countalternatifs*$countkriterias }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-statistic-1 shadow rounded">
                <div class="card-icon bg-primary">
                    <i class="far fa-map"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Kecamatan</h4>
                    </div>
                    <div class="card-body">
                        {{ $countalternatifs }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-statistic-1 shadow rounded">
                <div class="card-icon bg-primary">
                    <i class="far fa-edit"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Kriteria</h4>
                    </div>
                    <div class="card-body">
                        {{ $countkriterias }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary shadow rounded">
                <div class="card-body">
                    <h2>
                        <center>Ranking</center>
                    </h2>
                    <table class="table table-striped table-bordered table-md" id="totalPref">
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
                            for ($a = 1; $a < CountAlternatifs($koneksi); $a++) {
                                $netflow[$a] = ($bufferLeaving[$a] - $bufferEntering[$a]);
                            }
                            asort($netflow);
                            $n = 1;
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
        <div class="col-md-8 ml-auto mr-auto">
            <div class="card shadow rounded">
                <div class="card-body">
                    <iframe width="100%" height="720" frameborder="0"
                        src="https://haritsf.carto.com/builder/fa5de34c-50bb-4906-9ce0-6de4809fb349/embed" allowfullscreen
                        webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
