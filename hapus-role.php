<?php
include "connection.php";

$id = $_GET['id'];
$sql = "DELETE FROM role WHERE id_role = $id";
$hapus = mysqli_query($conn, $sql);
$sulistyo_ai = "ALTER TABLE role AUTO_INCREMENT = $id";
$sulistyo_reset = mysqli_query($conn, $sulistyo_ai);

if ($hapus && $sulistyo_reset) {
    echo "<script>
            alert('Data Role Berhasil Dihapus');
            window.location.href = 'master-role.php';
        </script>";
} else {
    echo "<script>
            alert('Login Berhasil');
            window.location.href = 'master-role.php';
        </script>";
}
?>