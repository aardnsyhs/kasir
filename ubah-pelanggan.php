<?php 
include "connection.php";
$sulistyo_pelanggan = mysqli_query($conn, "SELECT * FROM `sulistyo_pelanggan`");
$sulistyo_sql = mysqli_fetch_all($sulistyo_pelanggan);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Pelanggan</title>
</head>
<body class="d-flex">
<?php include "sidebar.php"; ?>
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <?php
                    $sulistyo_id = $_GET['id'];
                    $sulistyo_result = mysqli_query($conn, "SELECT * FROM sulistyo_pelanggan WHERE id_pelanggan = $sulistyo_id");

                    while ($sulistyo_user_pelanggan = mysqli_fetch_array($sulistyo_result)) {
                        $sulistyo_id_pelanggan = $sulistyo_user_pelanggan['id_pelanggan'];
                        $sulistyo_nama_pelanggan = $sulistyo_user_pelanggan['nama_pelanggan'];
                        $sulistyo_alamat = $sulistyo_user_pelanggan['alamat'];
                        $sulistyo_no = $sulistyo_user_pelanggan['no_telepon'];
                        $sulistyo_jkelamin = $sulistyo_user_pelanggan['jenis_kelamin'];
                        $sulistyo_tempat = $sulistyo_user_pelanggan['tempat_lahir'];
                        $sulistyo_tanggal = $sulistyo_user_pelanggan['tanggal_lahir'];
                        $sulistyo_jpelanggan = $sulistyo_user_pelanggan['jenis_pelanggan'];
                    }
                ?>
                <form action="proses-pelanggan.php" method="post">
                    <table class=" d-flex justify-content-center">
                        <tr>
                            <td><input type="hidden" name="id_pelanggan" value="<?= $sulistyo_id ?>"></td>
                        </tr>
                        <tr>
                            <td>
                            <h2>Ubah Pelanggan</h2>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Nama Pelanggan</td>
                            </tr>
                            <td>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="nama_pelanggan" value="<?= $sulistyo_nama_pelanggan ?>" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Alamat</td>
                            </tr>
                            <td>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="alamat" value="<?= $sulistyo_alamat ?>" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>No Telepon</td>
                            </tr>
                            <td>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="no_telepon" value="<?= $sulistyo_no ?>" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                            </tr>
                            <td>
                                <select name="jenis_kelamin" class="form-select mb-2">
                                        <option value="<?=$sulistyo_jkelamin?>"></option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Tempat Lahir</td>
                            </tr>
                            <td>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="tempat_lahir" value="<?= $sulistyo_tempat ?>" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                            </tr>
                            <td>
                                <div class="input-group mb-2">
                                    <input type="date" class="form-control" name="tanggal_lahir" value="<?= $sulistyo_tanggal ?>" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Jenis Pelangan</td>
                            </tr>
                            <td>
                                <select name="jenis_pelanggan" class="form-select mb-2">
                                        <option value="<?=$sulistyo_jpelanggan?>"></option>
                                        <option value="Gold">Gold</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Bronze">Bronze</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-fluid btn-primary w-100 mt-2" name="ubah" value="ubah">Ubah</button>
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