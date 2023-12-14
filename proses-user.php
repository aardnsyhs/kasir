<?php
include "connection.php";

if (isset($_POST['simpan'])) {
    $sulistyo_role = $_POST['id_role'];
    $sulistyo_username = $_POST['username'];
    $sulistyo_pass = $_POST['password'];
    $sulistyo_password = md5($sulistyo_pass);
    $sulistyo_nama = $_POST['nama_user'];
    $sulistyo_sql = "INSERT INTO sulistyo_user 
                     VALUES (NULL, '$sulistyo_role', '$sulistyo_username', '$sulistyo_password', '$sulistyo_nama')";
    $sulistyo_query = mysqli_query($conn, $sulistyo_sql);

    if ($sulistyo_query) {
        echo "<script>
                alert('Data User Berhasil Disimpan');
                window.location.href = 'master-user.php';
            </script>";
    } else {
        echo "<script>
                alert('Data User Gagal Disimpan');
                window.location.href = 'master-user.php';
            </script>";
    }
 } elseif (isset($_POST['ubah'])) {
     $nama_user = $_POST['nama_user'];
     $id_user = $_POST['id_user'];
     $username = $_POST['username'];
     $password = $_POST['password'];
     $sulistyo_role = $_POST['id_role'];
     
     if ($password == "") {
         $result = mysqli_query($conn, "UPDATE `sulistyo_user` 
                                        SET `id_role` = '$sulistyo_role', `username` = '$username', 
                                        `nama_user` = '$nama_user' 
                                        WHERE `sulistyo_user`.`id_user` = $id_user"
        );
    } else {
        $result = mysqli_query($conn, "UPDATE `sulistyo_user` 
                                       SET `id_role` = '$sulistyo_role', `username` = '$username', `password` = MD5('$password'), 
                                       `nama_user` = '$nama_user' 
                                       WHERE `sulistyo_user`.`id_user` = $id_user"
       );
     }

     if ($result) {
         echo "<script>
                 alert('Data User Berhasil Diubah');
                 window.location.href = 'master-user.php';
             </script>";
     } else {
         echo "<script>
                 alert('Data User Gagal Diubah');
                 window.location.href = 'master-user.php';
             </script>";
     }
 }
?>