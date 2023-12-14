<?php
 include 'connection.php';
 if (isset($_POST['bayar'])) {
    $id_order = $_POST['id_order'];
    $sulistyo_status = 'Selesai';

    $sulistyo_sql = "UPDATE `sulistyo_order` SET status_order = '$sulistyo_status'
                     WHERE id_order = '$id_order'";
    $sulistyo_query = mysqli_query($conn, $sulistyo_sql);
if ($sulistyo_query) {
   

    echo "<script>
    alert('Pembayaran Berhasil Berikut Struknya');
            window.location.href = 'pembayaran-order.php?id_order=$id_order';
          </script>";
}      
 else {
    echo "<script>
        alert('Pembayaran Gagal');
         window.location.href = 'transaksi_order.php';
          </script>";
    }
 }
?>