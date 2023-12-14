<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<?php
session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
	if ($_SESSION['id_role'] == 1) {
		echo "<script>window.location.href='home.php'</script>";
	}elseif ($_SESSION['id_role'] == 2) {
	echo "<script>window.location.href='home-manager.php'</script>";
	}elseif ($_SESSION['id_role'] == 3) {
		echo "<script>window.location.href='home-kasir.php'</script>";
		}
}
?>
<body class="d-flex align-items-center justify-content-center container-fluid" style="background-color: black;">
  <div class="bg-dark w-25 login">
    <div class="d-flex justify-content-center align-items-center">
      <i class="bi bi-person-circle fs-1 text-white"></i>
    </div>
    <div class="mb-2 text-center">
      <h4>
        Please Login
      </h4>
    </div>
    <?php
      if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == 'gagal') {
          echo "<div class='alert alert-danger text-center text-dark' role='alert'>
                  Login Gagal, Username atau Password Salah!
                </div>";
        }
        elseif ($_GET['pesan'] == 'logout') {
          echo "<div class='alert alert-info text-center text-dark' role='alert'>
                  Anda Telah Berhasil Logout
                </div>";
        }
        else {
          echo "<div class='alert alert-info text-center text-dark' role='alert'>
                  Anda harus login untuk mengakses halaman tersebut
                </div>";
        }
      }
    ?>
    <form class="form-floating" action="check-login.php" method="post" autocomplete="off">
      <div class="form-group">
        <label class="form-label" for="username">Username</label>
        <input class="form-control mb-3" type="text" name="username" required>
      </div>
      <div class="form-group" style="margin-bottom: 10px">
        <label class="form-label" for="password">Password</label>
        <input class="form-control mb-3" type="password" name="password" required>
      </div>
        <button class="btn btn-outline-info w-100 fw-bold" name="submit">LOGIN</button>
      </a>
    </form>
  </div>
</body>
</html>