<?php
include "connection.php";

$default_per_page = 4;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$per_page = isset($_GET['entries']) ? $_GET['entries'] : $default_per_page;
$start = ($current_page - 1) * $per_page;

$sulistyo_sql = "SELECT * FROM `sulistyo_order` 
                 INNER JOIN sulistyo_pelanggan 
                 ON sulistyo_pelanggan.id_pelanggan = sulistyo_order.id_pelanggan
                 INNER JOIN sulistyo_user 
                 ON sulistyo_user.id_user = sulistyo_order.id_user
                 LIMIT $start, $per_page";
$sulistyo_order = mysqli_query($conn, $sulistyo_sql);
$sulistyo_badge= ["Belum Selesai"=>"danger","Selesai"=>"primary", "Menunggu Pembayaran"=>"warning",];
$total_data_query = "SELECT COUNT(*) as total FROM `sulistyo_order`";
$total_data_result = mysqli_query($conn, $total_data_query);
$row = $total_data_result->fetch_assoc();
$total_data = $row['total'];
$total_pages = ceil($total_data / $per_page);
$start_count = ($current_page - 1) * $per_page + 1;
$end_count = min($start + $per_page, $total_data);

if(isset($_POST['cari'])) {
    $a=$_POST['keyword'];
    $q= "SELECT * FROM `sulistyo_order` 
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
 } else {
    $q= "SELECT * FROM `sulistyo_order` 
    JOIN `sulistyo_user` ON `sulistyo_order`.id_user=`sulistyo_user`.id_user 
    JOIN sulistyo_pelanggan ON `sulistyo_order`.id_pelanggan=sulistyo_pelanggan.sulistyo_pelanggan"; 
 }
    $order= mysqli_query($conn, $q);
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <title>Yan's Cafe | Order</title>
</head>
<body class="d-flex">
<?php
$active_page = 'transaksi-order';
include "sidebar.php";
?>
<main>
    <div class="container pt-3 ms-5 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <h2>Data Order</h2>
                <a class="btn btn-primary" href="tambah-order.php">
                    <i class="bi bi-bag-plus-fill"></i> Order
                </a>
                <div class="mt-3 table-responsive">
                    <table>
                        <tr>
                            <td>
                                <form method="GET" class="mb-2 mx-auto">
                                    Show <select name="entries" onchange="this.form.submit()">
                                        <?php $entries_options = [2, 4, 6, 8]; ?>
                                        <?php foreach ($entries_options as $option): ?>
                                            <?php $selected = ($option == $per_page) ? 'selected' : '';?>
                                            <option value="<?=$option?>" <?=$selected?>><?=$option?></option>
                                            <?php endforeach; ?>
                                        </select> Entries
                                    </form>
                                </td>
                                <td>
                                <form class="d-flex mt-2" role="search" method="post">
                                    <div class="mb-2 d-flex align-items-center" style="margin-left: 527px;">
                                        Search
                                        <input class="ms-2 form-control form-control-sm" type="search" id="keyword" name="keyword" placeholder="Cari Daftar Orderan" autocomplete="off">
                                        <button class="btn btn-sm btn-outline-dark ms-1" type="submit" name="cari" style="height: 30px;">Cari</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </table>
                    <div id="container">
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
                                <?php while ($sulistyo_row = $sulistyo_order->fetch_assoc()): ?>
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
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        <div class="row text-dark">
                            <div class="col-md-4" style="padding: 0px;">
                                <?php echo "Showing $start_count - $end_count of $total_data Data";?>
                            </div>
                        <div class="col-md-4 offset-md-4">
                            <nav>
                                <ul class="pagination justify-content-end" style="margin: 0px; padding: 0px;">
                                    <?php if($current_page > 1): ?>
                                        <li class="page-item"><a class="page-link" href="?page=<?=$current_page - 1?>&entries=<?=$per_page?>">Previous</a></li>
                                    <?php elseif($current_page == 1): ?>
                                        <li class="page-item"><a class="page-link disabled" href="?page=<?=$current_page - 1?>&entries=<?=$per_page?>">Previous</a></li>
                                    <?php endif; ?>
                                    <?php for ($i=1; $i <= $total_pages; $i++): ?>
                                            <?php if($i == $current_page): ?>
                                                <li class="page-item active" aria-current="page">
                                                    <?php
                                                    echo "<a class='page-link' href='?page=$i&entries=$per_page'>$i</a>";
                                                    ?>
                                                </li>
                                            <?php else: ?>
                                                <?php
                                                    echo "<li class='page-item'><a class='page-link' href='?page=$i&entries=$per_page'>$i</a></li>";
                                                ?>
                                            <?php endif; ?>
                                        <?php endfor;?>
                                    <?php if($current_page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?=$current_page + 1?>&entries=<?=$per_page?>">Next</a>
                                    </li>
                                    <?php elseif($current_page == $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link disabled" href="?page=<?=$current_page + 1?>&entries=<?=$per_page?>">Next</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    const keyword = document.getElementById('keyword');
    const container = document.getElementById('container');

    keyword.addEventListener('keyup', function() {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                container.innerHTML = xhr.responseText;
            }
        }
        xhr.open('GET', 'search/transaksi-order.php?keyword=' + keyword.value, true);
        xhr.send();
    });
</script>
</body>
</html>