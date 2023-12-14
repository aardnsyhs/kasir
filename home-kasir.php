<?php
$_SESSION['page'] ='home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Yan's Cafe | Dashboard</title>
</head>
<body class="d-flex">
    <?php $active_page = 'home'; include "sidebar.php"; ?>
    <main>
        <div class="container pt-3 pe-5 mt-5 scrollarea" style="margin-left: 320px; padding: 0;">
            <div class="row">
                <div class="col">
                    <div class="card mt-5 text-center" style="width: 18rem;">
                        <img src="pict/avatar.png" class="card-img-top" alt="user">
                        <div class="card-body">
                            <h5 class="card-title"><?= $_SESSION['nama_user'] ?></h5>
                        </div>
                        <div class="card-footer">
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            See Profile
                        </button>
                        </div>
                    </div>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header text-bg-dark">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel"><?= $_SESSION['nama_user'] ?></h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body text-bg-dark">
                            <h4>Ardiansyah Sulistyo</h4>
                            <h6>XI RPL B</h6>
                            <p>Bersekolah di SMKN 2 Cimahi</p>
                            <ul class="list-group">
                                <li class="list-group-item text-bg-dark">
                                    <a class="icon-link icon-link-hover text-decoration-none text-white" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0); --bs-link-hover-color-rgb: 33, 37, 41;" href="#">
                                        <i class="bi bi-github"></i> Github
                                    </a>
                                </li>
                                <li class="list-group-item text-bg-dark">
                                    <a class="icon-link icon-link-hover text-decoration-none text-white" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0); --bs-link-hover-color-rgb: 33, 37, 41;" href="#">
                                        <i class="bi bi-instagram"></i> Instagram
                                    </a>
                                </li>
                                <li class="list-group-item text-bg-dark">
                                    <a class="icon-link icon-link-hover text-decoration-none text-white" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0); --bs-link-hover-color-rgb: 33, 37, 41;" href="#">
                                        <i class="bi bi-envelope-paper"></i> E-mail
                                    </a>
                                </li>
                            </ul>
                            <hr style="margin-top: 260px;">
                            <div class="fixed-bottom px-5 position-absolute text-center">
                                <p>&copy; 2023 Ardiansyah Sulistyo Made With ❤</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body> 
</html>