<?php
include "connection.php";
$sulistyo_data = mysqli_query($conn, "SELECT * FROM `role`");
$sulistyo_sql = mysqli_fetch_all($sulistyo_data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah User</title>
</head>
<body class="d-flex">
<?php include "sidebar.php"; ?>
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <form action="proses-user.php" method="post">
                    <table class=" d-flex justify-content-center">
                        <tr>
                            <td>
                            <h2>Tambah User</h2>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Nama User</td>
                            </tr>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="nama_user" placeholder="Masukkan Nama User" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Username</td>
                            </tr>
                            <td>
                            <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="username" placeholder="Masukkan username" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Password</td>
                            </tr>
                            <td>
                            <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="password" placeholder="Masukkan Password" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Role</td>
                            </tr>
                            <td>
                                <select name="id_role" class="form-select mb-3">
                                    <?php foreach ($sulistyo_sql as $row): ?>
                                        <option value="<?= $row[0] ?>"><?= $row[1] ?></option>
                                    <?php endforeach ;?>
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