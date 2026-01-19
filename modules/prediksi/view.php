<section class="content-header">
    <h1>
        <i class="fa fa-line-chart icon-title"></i> Prediksi Kebutuhan Obat
        <small>Metode Least Square (Peramalan Stok)</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Prediksi</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info-circle"></i> Info Algoritma</h4>
                Sistem ini menggunakan metode <strong>Least Square</strong> untuk meramalkan penjualan bulan depan
                berdasarkan data penjualan 3 bulan terakhir.
                <br>Jika <strong>Prediksi > Sisa Stok</strong>, sistem akan merekomendasikan Restock.
            </div>

            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="dataTables1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="center" width="40">No.</th>
                                    <th class="center">Kode</th>
                                    <th class="center">Nama Obat</th>
                                    <th class="center">Sisa Stok</th>
                                    <th class="center" style="background-color: #f9f9f9;">Bulan Lalu-2</th>
                                    <th class="center" style="background-color: #f9f9f9;">Bulan Lalu-1</th>
                                    <th class="center" style="background-color: #f9f9f9;">Bulan Ini</th>
                                    <th class="center" style="background-color: #dff0d8;">Prediksi Bulan Depan</th>
                                    <th class="center">Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;

                                // 1. Ambil data master obat
                                $queryObat = mysqli_query($mysqli, "SELECT kode_obat, nama_obat, stok, satuan FROM is_obat ORDER BY nama_obat ASC")
                                    or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

                                while ($data = mysqli_fetch_assoc($queryObat)) {
                                    $kode_obat = $data['kode_obat'];
                                    $stok_real = $data['stok'];

                                    // 2. Ambil Data Penjualan 3 Bulan Terakhir untuk Obat ini
                                    // Variabel Y = Penjualan Real
                                    $Y = [];

                                    // Loop mundur 2 bulan kebelakang sampai bulan ini (Total 3 periode)
                                    // i=2 (2 bulan lalu), i=1 (1 bulan lalu), i=0 (bulan ini)
                                    for ($i = 2; $i >= 0; $i--) {
                                        $periode = date('Y-m', strtotime("-$i month"));

                                        $qSales = mysqli_query($mysqli, "SELECT SUM(jumlah_keluar) as total FROM is_obat_keluar 
                                                     WHERE kode_obat='$kode_obat' AND DATE_FORMAT(tanggal_keluar, '%Y-%m') = '$periode'");
                                        $dSales = mysqli_fetch_assoc($qSales);

                                        // Jika tidak ada penjualan, anggap 0
                                        $val = ($dSales['total'] == null) ? 0 : (int) $dSales['total'];
                                        $Y[] = $val;
                                    }

                                    // 3. Algoritma Least Square
                                    // Data X (Periode Waktu) -> Kita gunakan kode ganjil agar Sigma X = 0 untuk memudahkan
                                    // X = -1, 0, 1
                                    $X = [-1, 0, 1];
                                    $n = 3; // Jumlah data
                                
                                    $sigma_Y = 0;
                                    $sigma_XY = 0;
                                    $sigma_X2 = 0; // Sigma X Kuadrat
                                
                                    for ($j = 0; $j < $n; $j++) {
                                        $sigma_Y += $Y[$j];
                                        $sigma_XY += ($X[$j] * $Y[$j]);
                                        $sigma_X2 += ($X[$j] * $X[$j]);
                                    }

                                    // Hitung Konstanta a dan b
                                    // a = Sigma Y / n
                                    // b = Sigma XY / Sigma X^2
                                    if ($n != 0 && $sigma_X2 != 0) {
                                        $a = $sigma_Y / $n;
                                        $b = $sigma_XY / $sigma_X2;
                                    } else {
                                        $a = 0;
                                        $b = 0;
                                    }

                                    // 4. Prediksi Bulan Depan
                                    // Bulan depan urutannya adalah X = 2 (karena urutan X: -1, 0, 1, [2])
                                    $next_X = 2;
                                    $rumus = $a + ($b * $next_X);

                                    // Pembulatan ke atas (Safety Stock) dan tidak boleh minus
                                    $prediksi = ceil($rumus);
                                    if ($prediksi < 0)
                                        $prediksi = 0;

                                    // 5. Tentukan Status/Rekomendasi
                                    if ($stok_real < $prediksi) {
                                        // Jika stok kurang dari prediksi -> Danger
                                        $kurang = $prediksi - $stok_real;
                                        $status = "<span class='label label-danger' style='font-size:12px;'>BELI ($kurang $data[satuan])</span>";
                                    } elseif ($stok_real == 0 && $prediksi > 0) {
                                        $status = "<span class='label label-danger' style='font-size:12px;'>STOK HABIS</span>";
                                    } else {
                                        // Aman
                                        $status = "<span class='label label-success' style='font-size:12px;'>AMAN</span>";
                                    }

                                    echo "<tr>
                        <td class='center'>$no</td>
                        <td class='center'>$data[kode_obat]</td>
                        <td>$data[nama_obat]</td>
                        <td align='right' style='font-weight:bold;'>$stok_real</td>
                        
                        <td align='center'>$Y[0]</td>
                        <td align='center'>$Y[1]</td>
                        <td align='center'>$Y[2]</td>
                        
                        <td align='center' style='background-color: #dff0d8; font-weight:bold; color:#3c763d;'>$prediksi</td>
                        <td class='center'>$status</td>
                      </tr>";
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <p class="help-block"><i class="fa fa-lightbulb-o"></i> Prediksi dihitung otomatis berdasarkan tren
                        penjualan (transaksi keluar) 3 bulan terakhir.</p>
                </div>
            </div>
        </div>
    </div>
</section>```