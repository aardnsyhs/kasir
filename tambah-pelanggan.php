<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Pelanggan</title>
</head>
<body class="d-flex">
<?php include "sidebar.php"; ?>
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <form action="proses-pelanggan.php" method="post">
                    <table class=" d-flex justify-content-center">
                        <tr>
                            <td>
                            <h2>Tambah Pelanggan</h2>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Nama Pelanggan</td>
                            </tr>
                            <td>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="nama_pelanggan" placeholder="Masukkan Nama Pelanggan" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Alamat</td>
                            </tr>
                            <td>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>No Telepon</td>
                            </tr>
                            <td>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="no_telepon" placeholder="Masukkan No Telepon" style="width: 1050px;">
                                </div>
                            </td>
                            </tr>
                        </tr>
                        <tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                            </tr>
                            <td>
                                <select name="jenis_kelamin" class="form-select mb-2">
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
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                            </tr>
                            <td>
                                <div class="input-group mb-2">
                                    <input type="date" class="form-control" name="tanggal_lahir" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Jenis Pelanggan</td>
                            </tr>
                            <td>
                                <select name="jenis_pelanggan" class="form-select mb-2">
                                        <option value="Gold">Gold</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Bronze">Bronze</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-primary w-100 mt-2" name="simpan">Tambah</button>
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