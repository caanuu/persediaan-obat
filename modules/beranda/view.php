<section class="content-header" style="padding-bottom: 30px;">
  <h1>
    <i class="fa fa-tachometer icon-title"></i> Dashboard
    <small>Overview & Statistik</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="?module=beranda"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Beranda</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-lg-12 col-xs-12">
      <div class="callout callout-info">
        <h4><i class="fa fa-heartbeat"></i> Selamat Datang!</h4>
        <p>Halo <strong><?php echo $_SESSION['nama_user']; ?></strong>, Anda telah login sebagai
          <strong><?php echo $_SESSION['hak_akses']; ?></strong>. Kelola data persediaan obat dengan mudah dan cepat di
          sini.</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <?php
          // fungsi query untuk menampilkan data dari tabel obat
          $query = mysqli_query($mysqli, "SELECT COUNT(kode_obat) as jumlah FROM is_obat")
            or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

          // tampilkan data
          $data = mysqli_fetch_assoc($query);
          ?>
          <h3><?php echo $data['jumlah']; ?></h3>
          <p>Data Obat</p>
        </div>
        <div class="icon">
          <i class="fa fa-medkit"></i>
        </div>
        <?php
        if ($_SESSION['hak_akses'] != 'Manajer') { ?>
          <a href="?module=form_obat&form=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip">
            Tambah Obat Baru <i class="fa fa-arrow-circle-right"></i>
          </a>
          <?php
        } else { ?>
          <div class="small-box-footer" style="height: 25px;"></div>
          <?php
        }
        ?>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <?php
          // fungsi query untuk menampilkan data dari tabel obat masuk
          $query = mysqli_query($mysqli, "SELECT COUNT(kode_transaksi) as jumlah FROM is_obat_masuk")
            or die('Ada kesalahan pada query tampil Data obat Masuk: ' . mysqli_error($mysqli));

          // tampilkan data
          $data = mysqli_fetch_assoc($query);
          ?>
          <h3><?php echo $data['jumlah']; ?></h3>
          <p>Transaksi Masuk</p>
        </div>
        <div class="icon">
          <i class="fa fa-truck"></i>
        </div>
        <?php
        if ($_SESSION['hak_akses'] != 'Manajer') { ?>
          <a href="?module=form_obat_masuk&form=add" class="small-box-footer" title="Tambah Data" data-toggle="tooltip">
            Input Transaksi <i class="fa fa-arrow-circle-right"></i>
          </a>
          <?php
        } else { ?>
          <div class="small-box-footer" style="height: 25px;"></div>
          <?php
        }
        ?>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <?php
          // Menghitung jumlah record data obat untuk laporan stok (sesuai logic asli)
          $query = mysqli_query($mysqli, "SELECT COUNT(kode_obat) as jumlah FROM is_obat")
            or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

          // tampilkan data
          $data = mysqli_fetch_assoc($query);
          ?>
          <h3><?php echo $data['jumlah']; ?></h3>
          <p>Laporan Stok</p>
        </div>
        <div class="icon">
          <i class="fa fa-cubes"></i>
        </div>
        <a href="?module=lap_stok" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip">
          Lihat Laporan <i class="fa fa-print"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <?php
          // Menghitung jumlah record transaksi untuk laporan masuk (sesuai logic asli)
          $query = mysqli_query($mysqli, "SELECT COUNT(kode_transaksi) as jumlah FROM is_obat_masuk")
            or die('Ada kesalahan pada query tampil Data obat Masuk: ' . mysqli_error($mysqli));

          // tampilkan data
          $data = mysqli_fetch_assoc($query);
          ?>
          <h3><?php echo $data['jumlah']; ?></h3>
          <p>Laporan Masuk</p>
        </div>
        <div class="icon">
          <i class="fa fa-file-text"></i>
        </div>
        <a href="?module=lap_obat_masuk" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip">
          Lihat Laporan <i class="fa fa-print"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="row" style="margin-top: 20px;">
    <div class="col-md-12 text-center">
      <p style="color: #aaa; font-style: italic; font-size: 13px;">Sistem Informasi Manajemen Apotek v2.0 - Developed by
        Indra Studio</p>
    </div>
  </div>
</section>```