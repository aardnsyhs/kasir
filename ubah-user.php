<?php 
include "connection.php";
$sulistyo_data = mysqli_query($conn, "SELECT * FROM `role`");
$sulistyo_sql = mysqli_fetch_all($sulistyo_data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah User</title>
</head>
<body class="d-flex">
<?php include "sidebar.php"; ?>
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <?php
                    $id = $_GET['id'];
                    $result = mysqli_query($conn, "SELECT * FROM sulistyo_user WHERE id_user=$id");

                    while ($user_data = mysqli_fetch_array($result)) {
                    $nama_user = $user_data['nama_user'];
                    $id_user = $user_data['id_user'];
                    $username = $user_data['username'];
                    $password = $user_data['password'];
                    $role = $user_data['id_role'];
                    }
                ?>
                <form action="proses-user.php" method="post">
                    <table>
                        <tr>
                            <td><input type="hidden" name="id_user" value="<?= $id ?>"></td>
                        </tr>
                        <tr>
                            <td>
                            <h2>Ubah User</h2>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Nama User</td>
                            </tr>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="nama_user" value="<?= $nama_user ?>" style="width: 1050px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Username</td>
                            </tr>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="username" value="<?= $username ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Password</td>
                            </tr>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="password" placeholder="Kosongkan Jika Anda Tidak Mengubah Password">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Role</td>
                            </tr>
                            <td>
                                <select name="id_role" class="form-select">
                                    <?php foreach ($sulistyo_sql as $row): ?>
                                        <option value="<?= $row[0] ?>"><?= $row[1] ?></option>
                                        <?php endforeach ;?>
                                    </select>
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