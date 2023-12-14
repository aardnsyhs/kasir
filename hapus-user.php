<?php
include "connection.php";

$id = $_GET['id'];
$sql = "DELETE FROM sulistyo_user WHERE id_user = $id";
$hapus = mysqli_query($conn, $sql);
$sulistyo_ai = "ALTER TABLE sulistyo_user AUTO_INCREMENT = $id";
$sulistyo_reset = mysqli_query($conn, $sulistyo_ai);

if ($hapus && $sulistyo_reset) {
    echo "<script>
            alert('Data User Berhasil Dihapus');
            window.location.href = 'master-user.php';
        </script>";
} else {
    echo "<script>
            alert('Data User Gagal Dihapus');
            window.location.href = 'master-user.php';
        </script>";
}
?>