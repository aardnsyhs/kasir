<?php 
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Role</title>
</head>
<body class="d-flex">
<?php include "sidebar.php"; ?>
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <?php
                    $id = $_GET['id'];
                    $result = mysqli_query($conn, "SELECT * FROM role WHERE id_role=$id");

                    while ($role_data = mysqli_fetch_array($result)) {
                    $nama_role = $role_data['nama_role'];
                    $id_role = $role_data['id_role'];
                    }
                ?>
                <form action="proses-role.php" method="post">
                    <table>
                        <tr>
                            <td><input type="hidden" name="id_role" value="<?= $id_role ?>"></td>
                        </tr>
                        <tr>
                            <td>
                            <h2>Ubah Role</h2>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Nama Role</td>
                            </tr>
                            <td>
                            <div class="input-group">
                                    <input type="text" class="form-control" name="nama_role" value="<?= $nama_role ?>" style="width: 1050px;">
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