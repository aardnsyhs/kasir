<?php
include "../connection.php";
include "../sidebar.php";

$keyword = $_GET['keyword'];

$sql = "SELECT * FROM `sulistyo_pelanggan`
        WHERE LOWER(nama_pelanggan) LIKE '%$keyword%'
        OR LOWER(alamat) LIKE '%$keyword%'
        OR LOWER(no_telepon) LIKE '%$keyword%'
        OR LOWER(jenis_kelamin) LIKE '%$keyword%'
        OR LOWER(tempat_lahir) LIKE '%$keyword%'
        OR LOWER(tanggal_lahir) LIKE '%$keyword%'
        OR LOWER(jenis_pelanggan) LIKE '%$keyword%'";
$pelanggan = mysqli_query($conn, $sql);
$sulistyo_badge= ["Gold"=>"warning","Silver"=>"secondary", "Bronze"=>"dark",];
?>

<table class="table table-fluid table-bordered table-striped" style="width: auto;">
    <thead>
        <tr class="text-center">
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Jenis Kelamin</th>
            <th>TTL</th>
            <th>Jenis Pelanggan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pelanggan as $sulistyo_row): ?>
            <?php $sulistyo_tgl = strtotime($sulistyo_row["tanggal_lahir"]); ?>
            <tr class="text-center align-middle">
                <td><?= $sulistyo_row["id_pelanggan"];?></td>
                <td><?= $sulistyo_row["nama_pelanggan"];?></td>
                <td><?= $sulistyo_row["alamat"];?></td>
                <td><?= $sulistyo_row["no_telepon"];?></td>
                <td><?= $sulistyo_row["jenis_kelamin"];?></td>
                <td><?= $sulistyo_row["tempat_lahir"];?>, <?= date('d-m-Y', $sulistyo_tgl) ?></td>
                <td><div class="badge text-bg-<?= $sulistyo_badge[$sulistyo_row['jenis_pelanggan']] ?>"><?= $sulistyo_row['jenis_pelanggan']?></div></td>
                <td>
                    <a class="btn btn-success" href="ubah-pelanggan.php?id=<?= $sulistyo_row['id_pelanggan']?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg> Edit
                </a> 
                    <a class="btn btn-danger" href="hapus-pelanggan.php?id=<?= $sulistyo_row['id_pelanggan']?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg> Hapus
                </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>