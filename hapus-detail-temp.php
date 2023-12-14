<?php
include "connection.php";

$sulistyo_id = $_GET['id'];
$sulistyo_sql = "DELETE FROM sulistyo_detail_order_temp WHERE id_detail_order_temp = $sulistyo_id";
$sulistyo_hapus = mysqli_query($conn, $sulistyo_sql);
$sulistyo_ai = "ALTER TABLE sulistyo_detail_order_temp AUTO_INCREMENT = $sulistyo_id";
$sulistyo_reset = mysqli_query($conn, $sulistyo_ai);

if ($sulistyo_hapus && $sulistyo_reset) {
    echo "<script>
            alert('Data Order Berhasil Dihapus');
            window.location.href = 'tambah-order.php';
        </script>";
} else {
    echo "<script>
            alert('Data Order Gagal Dihapus');
            window.location.href = 'tambah-order.php';
        </script>";
}
?>