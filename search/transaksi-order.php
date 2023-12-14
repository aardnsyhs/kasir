<?php
include "../connection.php";
$a = $_GET['keyword'];

$sulistyo_order = "SELECT * FROM `sulistyo_order` 
JOIN `sulistyo_user` ON `sulistyo_order`.id_user=`sulistyo_user`.id_user 
JOIN sulistyo_pelanggan ON `sulistyo_order`.id_pelanggan=sulistyo_pelanggan.id_pelanggan 
WHERE id_order 
LIKE '%$a%' OR no_meja 
LIKE '%$a%' OR total 
LIKE '%$a%' OR nama_user 
LIKE '%$a%' OR nama_pelanggan 
LIKE '%$a%' OR tanggal 
LIKE '%$a%' OR status_order 
LIKE '%$a%'";
$result = mysqli_query($conn, $sulistyo_order);
$sulistyo_badge= ["Belum Selesai"=>"danger","Selesai"=>"primary", "Menunggu Pembayaran"=>"warning",];
?>

<body class="d-flex">
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <table class="table table-fluid table-bordered table-striped" style="width: auto;">
                    <thead>
                        <tr class="text-center">
                            <th>ID Order</th>
                            <th>No Meja</th>
                            <th>Total</th>
                            <th>Kasir</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $sulistyo_row): ?>
                        <tr class="text-center align-middle">
                            <td><?=$sulistyo_row['id_order']?></td>
                            <td>Meja <?=$sulistyo_row['no_meja']?></td>
                            <td>Rp.<?=number_format($sulistyo_row['total']);?></td>
                            <td><?=$sulistyo_row['nama_user']?></td>
                            <td><?=$sulistyo_row['nama_pelanggan']?></td>
                            <td><?=$sulistyo_row['tanggal']?></td>
                            <td><div class="badge text-bg-<?= $sulistyo_badge[$sulistyo_row['status_order']] ?>"><?= $sulistyo_row['status_order']?></div></td>
                            <td>
                                <a class="btn btn-success" href="detail-order.php?id=<?= $sulistyo_row['id_order']?>">
                                    <i class="bi bi-list-ul"></i> Detail Order
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>