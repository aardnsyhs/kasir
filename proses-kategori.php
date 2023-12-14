<?php
include "connection.php";

if (isset($_POST['simpan'])) {
    $sulistyo_nama = $_POST['nama_kategori'];
    $sulistyo_sql = "INSERT INTO sulistyo_kategori VALUES (NULL, '$sulistyo_nama')";
    $sulistyo_query = mysqli_query($conn, $sulistyo_sql);

    if ($sulistyo_query) {
        echo "<script>
                alert('Data Kategori Berhasil Disimpan');
                window.location.href = 'master-kategori.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Kategori Gagal Disimpan');
                window.location.href = 'tambah-kategori.php';
            </script>";
    }
} elseif (isset($_POST['ubah'])) {
    $sulistyo_id_kategori = $_POST['id_kategori'];
    $sulistyo_nama = $_POST['nama_kategori'];
    $sulistyo_result = mysqli_query($conn, "UPDATE `sulistyo_kategori` 
                                   SET `nama_kategori` = '$sulistyo_nama' 
                                   WHERE `id_kategori` = $sulistyo_id_kategori");
    
    if ($sulistyo_result) {
        echo "<script>
                alert('Data Kategori Berhasil Diubah');
                window.location.href = 'master-kategori.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Kategori Gagal Diubah');
                window.location.href = 'master-kategori.php';
            </script>";
    }
}
?>