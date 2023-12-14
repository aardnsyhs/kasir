<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Role</title>
</head>
<body class="d-flex">
<?php include "sidebar.php"; ?>
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <form action="proses-role.php" method="post">
                    <table class=" d-flex justify-content-center">
                        <tr>
                            <td>
                            <h2>Tambah Role</h2>
                            </td>
                        </tr>
                        <tr>
                            <tr>
                                <td>Nama Role</td>
                            </tr>
                            <td>
                            <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="nama_role" placeholder="Masukkan Nama Role" style="width: 1050px;">
                                </div>
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