<?php
include "connection.php";

if (isset($_POST['simpan'])) {
    $sulistyo_id = $_POST['id_pelanggan'];
    $sulistyo_nama = $_POST['nama_pelanggan'];
    $sulistyo_alamat = $_POST['alamat'];
    $sulistyo_no = $_POST['no_telepon'];
    $sulistyo_jkelamin = $_POST['jenis_kelamin'];
    $sulistyo_tempat = $_POST['tempat_lahir'];
    $sulistyo_tanggal = $_POST['tanggal_lahir'];
    $sulistyo_jpelanggan = $_POST['jenis_pelanggan'];
    $sulistyo_sql = "INSERT INTO `sulistyo_pelanggan` VALUES 
                    (NULL, '$sulistyo_nama', '$sulistyo_alamat', '$sulistyo_no', '$sulistyo_jkelamin', '$sulistyo_tempat', '$sulistyo_tanggal', 
                    '$sulistyo_jpelanggan')";
    $sulistyo_query = mysqli_query($conn, $sulistyo_sql);

    if ($sulistyo_query) {
        echo "<script>
                alert('Data Pelanggan Berhasil Disimpan');
                window.location.href = 'master-pelanggan.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Pelanggan Gagal Disimpan');
                window.location.href = 'master-pelanggan.php';
            </script>";
    }
 } elseif (isset($_POST['ubah'])) {
     $sulistyo_id = $_POST['id_pelanggan'];
     $sulistyo_nama = $_POST['nama_pelanggan'];
     $sulistyo_alamat = $_POST['alamat'];
     $sulistyo_no = $_POST['no_telepon'];
     $sulistyo_jkelamin = $_POST['jenis_kelamin'];
     $sulistyo_tempat = $_POST['tempat_lahir'];
     $sulistyo_tanggal = $_POST['tanggal_lahir'];
     $sulistyo_jpelanggan = $_POST['jenis_pelanggan'];
     $sulistyo_result = mysqli_query($conn, "UPDATE `sulistyo_pelanggan` 
                                            SET `nama_pelanggan` = '$sulistyo_nama', `alamat` = '$sulistyo_alamat', `no_telepon` = '$sulistyo_no', 
                                            `jenis_kelamin` = '$sulistyo_jkelamin', `tempat_lahir` = '$sulistyo_tempat', `tanggal_lahir` = '$sulistyo_tanggal', 
                                            `jenis_pelanggan` = '$sulistyo_jpelanggan' 
                                            WHERE `sulistyo_pelanggan`.`id_pelanggan` = $sulistyo_id"
     );

     if ($sulistyo_result) {
         echo "<script>
                 alert('Data Pelanggan Berhasil Diubah');
                 window.location.href = 'master-pelanggan.php';
             </script>";
     } else {
         echo "<script>
                 alert('Data Pelanggan Gagal Diubah');
                 window.location.href = 'master-pelanggan.php';
             </script>";
     }
 }
?>