<?php
include "connection.php";

$id_detail_order = $_GET['id_detail_order'];
$id_order = $_GET['id_order'];

$sulistyo_sql = "DELETE FROM `sulistyo_detail_order` WHERE id_detail_order = $id_detail_order";
$sulistyo_hapus = mysqli_query($conn, $sulistyo_sql);
$sulistyo_ai = "ALTER TABLE `sulistyo_detail_order` AUTO_INCREMENT = $id_detail_order";
$sulistyo_reset = mysqli_query($conn, $sulistyo_ai);

if ($sulistyo_hapus && $sulistyo_reset) {
    $sulistyo_sql = "SELECT * FROM `sulistyo_detail_order` 
                     JOIN `sulistyo_menu` ON sulistyo_detail_order.id_menu = sulistyo_menu.id_menu
                     WHERE sulistyo_detail_order.id_order = '$id_order'";
    $sulistyo_detail = mysqli_query($conn, $sulistyo_sql);

    $sulistyo_total = 0;
    while ($sulistyo_row = mysqli_fetch_array($sulistyo_detail)) {
        $sulistyo_total = $sulistyo_total + ($sulistyo_row['jumlah'] + $sulistyo_row['harga_menu']);
    }

    $sulistyo_sql = "UPDATE `sulistyo_order` SET total = $sulistyo_total WHERE id_order = '$id_order'";
    $sulistyo_query = mysqli_query($conn, $sulistyo_sql);

    echo "
        <script>
            window.location.href='detail-order.php?id=$id_order';
        </script>
    ";
}
?>