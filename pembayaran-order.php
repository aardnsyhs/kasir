<?php
include "sidebar.php";
date_default_timezone_set("Asia/Jakarta");
$date = date("Y-m-d H:i:s");
$id_order = $_GET['id_order'];
$sulistyo_sql ="SELECT * FROM `sulistyo_detail_order` 
JOIN sulistyo_menu ON sulistyo_detail_order.id_menu = sulistyo_menu.id_menu 
JOIN sulistyo_order ON sulistyo_detail_order.id_order = sulistyo_order.id_order 
JOIN sulistyo_pelanggan ON sulistyo_order.id_pelanggan = sulistyo_pelanggan.id_pelanggan
WHERE `sulistyo_detail_order`.`id_order`='$id_order'";
$sulistyo_query = mysqli_query($conn, $sulistyo_sql);
                       
foreach ($sulistyo_query as $sulistyo_row){
    $sulistyo_no_meja = $sulistyo_row['no_meja'];
    $sulistyo_id_order = $sulistyo_row['id_order'];
    $sulistyo_pelanggan = $sulistyo_row['nama_pelanggan'];
    // $sulistyo_pw = if (condition) {
    //     # code...
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
</head>
<body class="d-flex">
    <main>
        <div class="container pt-3 ms-5 me-0 pe-5 scrollarea">
            <div class="row">
                <div class="col">
                <h1>Struk Pembayaran</h1>
                    <table class="table table-borderless table-light"  style="margin-left: auto; width: auto;" >
                    <tr>
                        <td class="text-center" colspan="4"><br></td>
                    </tr>
                    <tr>
                            <th class="text-center ms-o" colspan="4"><h1><i class="bi bi-cup-hot-fill"></i></h1></i></th>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4"><h2>Yan's Cafe</h2></td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="4">WiFi : sulistyoGanteng</td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2"><label style="margin-right:80px">ID Transaksi : <?=$sulistyo_id_order?></label></td>
                            <td class="text-center" colspan="2">No Meja : <?=$sulistyo_no_meja  ?></td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2"><label style="margin-right:80px"><?=$date?></label></td>           
                            <td class="text-center" colspan="2">Nama : <?=$sulistyo_pelanggan?></td>    
                        </tr>
                        <tr>
                            <td class="fw-bold text-center" colspan="4"><hr> Selesai <hr></td>
                        </tr>
                        <?php foreach ($sulistyo_query as $k => $sulistyo_row):?>
                        <tr>
                            <td class="text-center"><?= $sulistyo_row['nama_menu'] ?></td>
                            <td class="text-center">Rp.<?= number_format($sulistyo_row['harga_menu']); ?></td>
                            <td class="text-center"><?= $sulistyo_row['jumlah'] ?></td>
                            <td class="text-center">Rp.<?= number_format($sulistyo_row['harga_menu'] * $sulistyo_row['jumlah']); ?></td>
                        </tr>
                        <?php $total = $sulistyo_row['total']; endforeach; ?>
                        <tr>
                            <td class="fw-bold text-center" colspan="4"><hr></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">Total Pesanan</td>
                            <td colspan="1" class="text-center">Rp.<?=number_format($total);$pajak = $total * 0.11; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">Pajak </td>
                            <td colspan="1" class="text-center">Rp.<?= number_format($pajak); $diskon = ($total >= 100000) ? 0.1 : 0; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">Diskon </td>
                            <td colspan="1" class="text-center">Rp.<?= number_format($total * $diskon) ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-center" colspan="4"><hr></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">Total  </td>
                            <td colspan="1" class="text-center">Rp.<?= number_format($total + $pajak - ($total * $diskon)) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>