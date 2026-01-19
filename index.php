<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Login | Aplikasi Persediaan Obat</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Aplikasi Persediaan Obat pada Apotek">
  <meta name="author" content="Indra Styawantoro" />

  <link rel="shortcut icon" href="assets/img/favicon.png" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body class="login-page">
  <div class="login-box">
    <div class="login-logo">
      <img src="assets/img/logo-blue.png" alt="Logo" height="50">
      <br>
      <b>Apotek</b> Sehat
    </div>

    <?php
    if (empty($_GET['alert'])) {
      echo "";
    } elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-times-circle'></i> Gagal Login!</h4>
                Username atau Password salah.
              </div>";
    } elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check-circle'></i> Sukses!</h4>
                Anda telah berhasil logout.
              </div>";
    }
    ?>

    <div class="login-box-body">
      <p class="login-box-msg">Silahkan masuk ke akun Anda</p>

      <form action="login-check.php" method="POST">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required />
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password" required />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="LOGIN" />
          </div>
        </div>
      </form>

    </div>
    <div style="text-align: center; margin-top: 20px; color: #a0aec0; font-size: 13px;">
      Copyright &copy; 2017 - <?php echo date('Y'); ?> <br>
      <a href="www.indrasatya.com" style="color: #667eea;">www.indrasatya.com</a>
    </div>
  </div>

  <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>