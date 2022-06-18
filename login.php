<?php
	@ob_start();
	session_start();
    include 'config.php';
	if(!isset($_SESSION['status'])){
    } else {
        header('location:index.php');
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POS | Log in</title>

 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<?php 
    if(isset($_POST['login'])){
        $user = mysqli_real_escape_string($conn,$_POST['username']);
        $pass = mysqli_real_escape_string($conn,$_POST['password']);
        $queryuser = mysqli_query($conn,"SELECT * FROM login WHERE username='$user'");
        $cariuser = mysqli_fetch_assoc($queryuser);
            
            if( password_verify($pass, $cariuser['password']) ) {
                $_SESSION['id_login'] = $cariuser['id_login'];
                $_SESSION['username'] = $cariuser['username'];
                $_SESSION['nama_toko'] = $cariuser['nama_toko'];
                $_SESSION['alamat'] = $cariuser['alamat'];
                $_SESSION['telepon'] = $cariuser['telepon'];
                $_SESSION['status'] = "login";

                if($cariuser){ 
                    echo '<script>alert("Data yang anda masukan benar");window.location="index.php"</script>';
                }else{
                    echo '<script>alert("Data yang anda masukan salah");history.go(-1);</script>';
                }
                echo '<script>alert("Anda Berhasil Login");window.location="index.php"</script>';
            } else {
                echo '<script>alert("Username atau password salah");history.go(-1);</script>';
            }	
        };
  
        ?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>POS</b> Sembako</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login untuk melanjutkan</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="user" name="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="pass" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>