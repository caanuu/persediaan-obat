<ul class="sidebar-menu">
  <li class="header">MAIN MENU</li>

  <?php
  if ($_GET["module"] == "beranda") { ?>
    <li class="active">
      <a href="?module=beranda"><i class="fa fa-dashboard"></i> Beranda </a>
    </li>
    <?php
  } else { ?>
    <li>
      <a href="?module=beranda"><i class="fa fa-dashboard"></i> Beranda </a>
    </li>
    <?php
  }

  if ($_GET["module"] == "obat" || $_GET["module"] == "form_obat") { ?>
    <li class="active">
      <a href="?module=obat"><i class="fa fa-folder"></i> Data Obat </a>
    </li>
    <?php
  } else { ?>
    <li>
      <a href="?module=obat"><i class="fa fa-folder"></i> Data Obat </a>
    </li>
    <?php
  }

  if ($_GET["module"] == "obat_masuk" || $_GET["module"] == "form_obat_masuk") { ?>
    <li class="active">
      <a href="?module=obat_masuk"><i class="fa fa-clone"></i> Data Obat Masuk </a>
    </li>
    <?php
  } else { ?>
    <li>
      <a href="?module=obat_masuk"><i class="fa fa-clone"></i> Data Obat Masuk </a>
    </li>
    <?php
  }

  // --- MENU PREDIKSI (BARU) --- //
  if ($_GET["module"] == "prediksi") { ?>
    <li class="active">
      <a href="?module=prediksi"><i class="fa fa-line-chart"></i> Prediksi Stok </a>
    </li>
    <?php
  } else { ?>
    <li>
      <a href="?module=prediksi"><i class="fa fa-line-chart"></i> Prediksi Stok </a>
    </li>
    <?php
  }
  // ---------------------------- //
  
  if ($_GET["module"] == "lap_stok") { ?>
    <li class="active">
      <a href="?module=lap_stok"><i class="fa fa-file-text"></i> Laporan Stok Obat </a>
    </li>
    <?php
  } else { ?>
    <li>
      <a href="?module=lap_stok"><i class="fa fa-file-text"></i> Laporan Stok Obat </a>
    </li>
    <?php
  }

  if ($_GET["module"] == "lap_obat_masuk") { ?>
    <li class="active">
      <a href="?module=lap_obat_masuk"><i class="fa fa-file-text"></i> Laporan Obat Masuk </a>
    </li>
    <?php
  } else { ?>
    <li>
      <a href="?module=lap_obat_masuk"><i class="fa fa-file-text"></i> Laporan Obat Masuk </a>
    </li>
    <?php
  }

  if ($_SESSION['hak_akses'] == 'Super Admin') {
    if ($_GET["module"] == "user" || $_GET["module"] == "form_user") { ?>
      <li class="active">
        <a href="?module=user"><i class="fa fa-user"></i> Manajemen User </a>
      </li>
      <?php
    } else { ?>
      <li>
        <a href="?module=user"><i class="fa fa-user"></i> Manajemen User </a>
      </li>
      <?php
    }
  }

  if ($_GET["module"] == "password") { ?>
    <li class="active">
      <a href="?module=password"><i class="fa fa-lock"></i> Ubah Password </a>
    </li>
    <?php
  } else { ?>
    <li>
      <a href="?module=password"><i class="fa fa-lock"></i> Ubah Password </a>
    </li>
    <?php
  }
  ?>
</ul>