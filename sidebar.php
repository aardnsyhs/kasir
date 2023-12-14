<?php
session_start();
include "connection.php";
if ($_SESSION['status'] != 'login') {
  echo "<script>window.location.href='index.php?pesan=belum_login'</script>";
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yan's Cafe</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }

    .muncul:hover {
      background-color: #0d6efd;
    }
  </style>
  <link href="sidebars.css" rel="stylesheet">
</head>

<body>
  <div class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar">
      <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <div class="d-flex justify-content-center align-items-center">
          <i class="bi bi-cup-hot-fill"></i>
        </div>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <?php if ($_SESSION['id_role'] == 1) { ?>
            <a class="nav-link <?php echo ($active_page === 'home') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="home.php">
              <i class="bi bi-clipboard-data"></i>
              <span>Dashboard</span>
            </a>
          <?php } elseif ($_SESSION['id_role'] == 2) { ?>
            <a class="nav-link <?php echo ($active_page === 'home-manager') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="home-manager.php">
              <i class="bi bi-clipboard-data"></i>
              <span>Dashboard</span>
            </a>
          <?php } elseif ($_SESSION['id_role'] == 3) { ?>
            <a class="nav-link <?php echo ($active_page === 'home-kasir') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="home-kasir.php">
              <i class="bi bi-clipboard-data"></i>
              <span>Dashboard</span>
            </a>
          <?php } ?>
        </li>
        <li>
          <?php if ($_SESSION['id_role'] == 1) { ?>
            <a class="nav-link <?php echo ($active_page === 'master-user') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="master-user.php">
              <i class="bi bi-people-fill"></i>
              <span>User</span>
            </a>
        </li>
        <li>
          <a class="nav-link <?php echo ($active_page === 'master-role') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="master-role.php">
            <i class="bi bi-person-lock"></i>
            <span>Role</span>
          </a>
        </li>
        <li>
          <a class="nav-link <?php echo ($active_page === 'master-pelanggan') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="master-pelanggan.php">
            <i class="bi bi-person-heart"></i>
            <span>Pelanggan</span>
          </a>
        </li>
        <li>
          <a class="nav-link <?php echo ($active_page === 'master-kategori') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="master-kategori.php">
            <i class="bi bi-collection-fill"></i>
            <span>Kategori Menu</span>
          </a>
        </li>
        <li>
          <a class="nav-link <?php echo ($active_page === 'master-menu') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="master-menu.php">
            <i class="bi bi-cup-hot"></i>
            <span>Menu</span>
          </a>
        <?php } ?>
        </li>
        <li>
          <?php if ($_SESSION['id_role'] == 3 || $_SESSION['id_role'] == 1) { ?>
            <a class="nav-link <?php echo ($active_page === 'transaksi-order') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="transaksi-order.php">
              <i class="bi bi-cart-plus"></i>
              <span>Order</span>
            </a>
        </li>
        <li>
          <a class="nav-link <?php echo ($active_page === '') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="#">
            <i class="bi bi-credit-card-fill"></i>
            <span>Pembayaran</span>
          </a>
        <?php } ?>
        </li>
        <li>
          <?php if ($_SESSION['id_role'] == 2) { ?>
            <a class="nav-link <?php echo ($active_page === '') ? 'active' : ''; ?> text-white text-decoration-none muncul" href="laporan.php">
              <i class="bi bi-file-text-fill"></i>
              <span>Laporan</span>
            </a>
          <?php } ?>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="pict/avatar.png" alt="user" width="32" height="32" class="rounded-circle me-2">
          <strong><?= $_SESSION['nama_user'] ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    <div class="b-example-vr"></div>
  </div>
  <main>
    <div class="main-content mt-2">
      <div id="menu-button">
        <input type="checkbox" id="menu-checkbox">
        <label for="menu-checkbox" id="menu-label">
          <div id="hamburger"></div>
        </label>
      </div>
    </div>
  </main>
  <script src="bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>
  <script src="main.js"></script>
</body>

</html>