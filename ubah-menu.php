<?php 
include "connection.php";
$sulistyo_kategori = mysqli_query($conn, "SELECT * FROM `sulistyo_kategori`");
$sulistyo_sql = mysqli_fetch_all($sulistyo_kategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Menu</title>
</head>
<body class="d-flex">
<?php include "sidebar.php"; ?>
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <?php
                    $sulistyo_id = $_GET['id'];
                    $sulistyo_result = mysqli_query($conn, "SELECT * FROM sulistyo_menu WHERE id_menu = $sulistyo_id");

                    while ($sulistyo_user_menu = mysqli_fetch_array($sulistyo_result)) {
                    $sulistyo_nama_menu = $sulistyo_user_menu['nama_menu'];
                    $sulistyo_id_menu = $sulistyo_user_menu['id_menu'];
                    $sulistyo_harga = $sulistyo_user_menu['harga_menu'];
                    $sulistyo_foto = $sulistyo_user_menu['foto_menu'];
                    $sulistyo_status = $sulistyo_user_menu['status_menu'];
                    }
                ?>
                <form action="proses-menu.php" method="post">
                    <table class=" d-flex justify-content-center">
                        <tr>
                            <td><input type="hidden" name="id_menu" value="<?= $sulistyo_id ?>"></td>
                        </tr>
                        <tr>
                            <td>
                            <h2>Ubah Menu</h2>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Nama Menu</td>
                            </tr>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="nama_menu" value="<?= $sulistyo_nama_menu ?>" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Harga Menu</td>
                            </tr>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="harga_menu" value="<?= $sulistyo_harga ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Kategori</td>
                            </tr>
                            <td>
                                <select name="id_kategori" class="form-select mb-3">
                                    <?php foreach ($sulistyo_sql as $row): ?>
                                        <option value="<?= $row[0] ?>"><?= $row[1] ?></option>
                                    <?php endforeach ;?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Foto Menu</td>
                            </tr>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="foto_menu" placeholder="Masukkan Foto Menu" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Status</td>
                            </tr>
                            <td>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="status">
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-fluid btn-primary w-100 mt-3" name="ubah" value="ubah">Ubah</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>