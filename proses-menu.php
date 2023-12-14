<?php
include "connection.php";

if (isset($_POST['simpan'])) {
    $sulistyo_kategori = $_POST['id_kategori'];
    $sulistyo_menu = $_POST['nama_menu'];
    $sulistyo_harga = $_POST['harga_menu'];
    $sulistyo_foto = $_POST['foto_menu'];
    $sulistyo_nama = $_POST['status'];
    $sulistyo_sql = "INSERT INTO sulistyo_menu 
                     VALUES (NULL, '$sulistyo_menu', '$sulistyo_harga', '$sulistyo_kategori', '$sulistyo_foto' ,'$sulistyo_nama')";
    $sulistyo_query = mysqli_query($conn, $sulistyo_sql);

    if ($sulistyo_query) {
        echo "<script>
                alert('Data Menu Berhasil Disimpan');
                window.location.href = 'master-menu.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Menu Gagal Disimpan');
                window.location.href = 'master-menu.php';
            </script>";
    }
 } elseif (isset($_POST['ubah'])) {
     $sulistyo_menu = $_POST['nama_menu'];
     $sulistyo_harga = $_POST['harga_menu'];
     $sulistyo_id = $_POST['id_menu'];
     $sulistyo_foto = $_POST['foto_menu'];
     $sulistyo_status = $_POST['status'];
     $sulistyo_result = mysqli_query($conn, "UPDATE `sulistyo_menu` 
                                             SET `nama_menu` = '$sulistyo_menu', `harga_menu` = '$sulistyo_harga', `foto_menu` = '$sulistyo_foto', `status_menu` = '$sulistyo_status' 
                                             WHERE `sulistyo_menu`.`id_menu` = $sulistyo_id"
     );

     if ($sulistyo_result) {
         echo "<script>
                 alert('Data Menu Berhasil Diubah');
                 window.location.href = 'master-menu.php';
             </script>";
     } else {
         echo "<script>
                 alert('Data Menu Gagal Diubah');
                 window.location.href = 'master-menu.php';
             </script>";
     }
 }
?>