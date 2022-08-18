<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        td,
        th {
            font-size: 11px;
        }
    </style>


    <title>TES - Venturo Camp Tahap 2</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu {{ $tahun }}
            </div>
            <div class="card-body">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select id="my-select" class="form-control" name="tahun">
                                    <option value="">Pilih Tahun</option>
                                    <option value="2021" {{ request()->query('tahun') == '2021' ? 'selected' : '' }}>
                                        2021</option>
                                    <option value="2022" {{ request()->query('tahun') == '2022' ? 'selected' : '' }}>
                                        2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                            <a href="http://127.0.0.1:8000/api/menu" target="_blank" rel="Array Menu"
                                class="btn btn-secondary">
                                Json Menu
                            </a>
                            <a href="http://127.0.0.1:8000/api/transaksi" target="_blank" rel="Array Transaksi"
                                class="btn btn-secondary">
                                Json Transaksi
                            </a>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="margin: 0;">
                        <thead>
                            <tr class="table-dark">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu
                                </th>
                                <th colspan="12" style="text-align: center;">Periode Pada <?= $tahun ?>
                                </th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total
                                </th>
                            </tr>
                            <tr class="table-dark">
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    $bulan = [];
                                    $bulan[] = date('m', strtotime(date('Y') . '-' . $i . '-01'));
                                    echo '<th style="text-align: center;width: 75px;">' . date('M', strtotime(date('Y') . '-' . $i . '-01')) . '</th>';
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                            </tr>
                            <?php
                            foreach ($menu as $row) {
                                if ($row['kategori'] == 'makanan') {
                                    echo '<tr>';
                                    echo '<td>' . $row['menu'] . '</td>';
                            
                                    for ($i = 1; $i <= 12; $i++) {
                                        $totalSum = [];
                                        foreach ($transaksi as $val) {
                                            if ($row['menu'] == $val['menu']) {
                                                if (date('m', strtotime($val['tanggal'])) == date('m', strtotime(date('Y') . '-' . $i . '-01'))) {
                                                    $totalSum[] = $val['total'];
                                                }
                                            }
                                        }
                                        echo '<td>' . (array_sum($totalSum) ? number_format(array_sum($totalSum)) : '') . '</td>';
                                    }
                            
                                    echo '</tr>';
                                }
                            }
                            ?>
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                            </tr>
                            <?php
                            foreach ($menu as $row) {
                                if ($row['kategori'] == 'minuman') {
                                    echo '<tr>';
                                    echo '<td>' . $row['menu'] . '</td>';
                            
                                    for ($i = 1; $i <= 12; $i++) {
                                        $totalSum = [];
                                        foreach ($transaksi as $val) {
                                            if ($row['menu'] == $val['menu']) {
                                                if (date('m', strtotime($val['tanggal'])) == date('m', strtotime(date('Y') . '-' . $i . '-01'))) {
                                                    $totalSum[] = $val['total'];
                                                }
                                            }
                                        }
                                        echo '<td>' . (array_sum($totalSum) ? number_format(array_sum($totalSum)) : '') . '</td>';
                                    }
                            
                                    echo '</tr>';
                                }
                            }
                            ?>
                            <tr class="table-dark">
                                <td><b>Total</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>
