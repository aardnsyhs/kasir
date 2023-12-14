<?php 
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Kategori</title>
</head>
<body class="d-flex">
<?php include "sidebar.php"; ?>
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <?php
                    $sulistyo_id = $_GET['id'];
                    $sulistyo_result = mysqli_query($conn, "SELECT * FROM sulistyo_kategori WHERE id_kategori = $sulistyo_id");

                    while ($sulistyo_kategori_data = mysqli_fetch_array($sulistyo_result)) {
                    $sulistyo_nama_kategori = $sulistyo_kategori_data['nama_kategori'];
                    $sulistyo_id_kategori = $sulistyo_kategori_data['id_kategori'];
                    }
                ?>
                <form action="proses-kategori.php" method="post">
                    <table class=" d-flex justify-content-center">
                        <tr>
                            <td><input type="hidden" name="id_kategori" value="<?= $sulistyo_id_kategori ?>"></td>
                        </tr>
                        <tr>
                            <td>
                            <h2>Ubah Kategori Menu</h2>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Nama Kategori</td>
                            </tr>
                            <td>
                            <div class="input-group">
                                    <input type="text" class="form-control" name="nama_kategori" value="<?= $sulistyo_nama_kategori ?>" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-primary w-100 mt-2" name="ubah" value="ubah">Ubah</button>
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