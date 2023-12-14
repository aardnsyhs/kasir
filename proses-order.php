<?php
session_start();
include "connection.php";

$id_order_get = $_GET['id_order'];
$id_detail_order = $_GET['id_detail_order'];

if (isset($_POST['order'])) {
    $id_user = $_SESSION['id_user'];
    $id_order_temp = $_POST['id_order_temp'];
    $total = $_POST['total'];

    $sql = "SELECT * FROM `sulistyo_order_temp`
            WHERE id_order_temp = '$id_order_temp'";
    $orderTemp = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($orderTemp)) {
        $no_meja = $row['no_meja'];
        $id_pelanggan = $row['id_pelanggan'];

        $sql = "INSERT INTO `sulistyo_order`
                VALUES (NULL, '$no_meja', now(), '$id_user', '$id_pelanggan', $total, 'Belum Selesai')";
        $insert_order = mysqli_query($conn, $sql);

        $id_order = mysqli_insert_id($conn);
    }

    $sql = "SELECT * FROM `sulistyo_detail_order_temp`
            WHERE id_user = '$id_user' AND tanggal = '".date('Y-m-d')."'";
    $detail_order_temp = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($detail_order_temp)) {
        $id_menu = $row['id_menu'];
        $jumlah = $row['jumlah'];

        $sql = "INSERT INTO `sulistyo_detail_order`
                VALUES (NULL, $id_order, $id_menu, $jumlah, 'Belum Selesai')";
        $insert_detail_order = mysqli_query($conn, $sql);
    }

    if ($insert_order && $insert_detail_order) {
        $sql = "DELETE FROM `sulistyo_order_temp`
                WHERE id_order_temp = $id_order_temp";
        $hapus_order_temp = mysqli_query($conn, $sql);

        $sql = "DELETE FROM `sulistyo_detail_order_temp`
                WHERE id_user = '$id_user' AND tanggal = '".date('Y-m-d')."'";
        $hapus_detail_order_temp = mysqli_query($conn, $sql);

        echo "
            <script>
                alert('Data Order Berhasil Disimpan');
                window.location.href='transaksi-order.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Order Gagal Disimpan');
                window.location.href='tambah-order.php';
            </script>
        ";
    }
} elseif ($id_detail_order != "" && $id_order_get != "") {
    $sulistyo_sql = "UPDATE `sulistyo_detail_order` SET status_detail_order = 'Selesai' WHERE id_detail_order = '$id_detail_order'";
    $query = mysqli_query($conn, $sulistyo_sql);

    if ($query) {
        $sulistyo_sql = "SELECT * FROM `sulistyo_detail_order`
                         WHERE id_order = '$id_order_get'
                         AND status_detail_order = 'Belum Selesai'";
        $sulistyo_detail = mysqli_query($conn, $sulistyo_sql);
        $sulistyo_cek = mysqli_num_rows($sulistyo_detail);

        if ($sulistyo_cek > 0) {
            $sulistyo_status = 'Belum Selesai';
        } else {
            $sulistyo_status = 'Menunggu Pembayaran';
        }

        $sulistyo_sql = "UPDATE `sulistyo_order` SET status_order = '$sulistyo_status'
                         WHERE id_order = '$id_order_get'";
        $sulistyo_query = mysqli_query($conn, $sulistyo_sql);

        echo "<script>
                window.location.href = 'detail-order.php?id=$id_order_get';
              </script>";
    } else {
        echo "<script>
                window.location.href = 'detail-order.php?id=$id_order_get';
              </script>";
    }
} elseif (isset($_POST['bayar'])) {
    $id_order = $_POST['id_order'];
    $sulistyo_sql = "UPDATE `sulistyo_order` SET status_order = 'Selesai' WHERE id_order = '$id_order'";
    $query = mysqli_query($conn, $sulistyo_sql);

    if ($query) {
        echo "<script>
                window.location.href = 'transaksi-order.php?id=$id_order';
              </script>";
    } else {
        echo "<script>
                window.location.href = 'transaksi-order.php?id=$id_order';
              </script>";
    }
}
?>