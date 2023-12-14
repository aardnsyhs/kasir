<?php
include "connection.php";
$sulistyo_sql ="SELECT * FROM `sulistyo_detail_order` 
JOIN sulistyo_menu ON sulistyo_detail_order.id_menu = sulistyo_menu.id_menu 
JOIN sulistyo_order ON sulistyo_detail_order.id_order = sulistyo_order.id_order 
JOIN sulistyo_kategori ON sulistyo_menu.id_kategori = sulistyo_kategori.id_kategori
WHERE `sulistyo_kategori`.`id_kategori`='2'";
$sulistyo_temp = mysqli_query($conn, $sulistyo_sql);
$akhir = 0;
$total_jmla = 0;
foreach ($sulistyo_temp as $sulistyo_row){
    $sulistyo_makanan = $sulistyo_row['harga_menu'];
    $sulistyo_jumlah = $sulistyo_row['jumlah'];
    $total_makanan = $sulistyo_makanan * $sulistyo_jumlah; 
    $akhir += $total_makanan; 
    $total_mkn = $sulistyo_row['total'];
    $total_jmla += $sulistyo_jumlah;
}

$sulistyo_sql ="SELECT * FROM `sulistyo_detail_order` 
JOIN sulistyo_menu ON sulistyo_detail_order.id_menu = sulistyo_menu.id_menu 
JOIN sulistyo_order ON sulistyo_detail_order.id_order = sulistyo_order.id_order 
JOIN sulistyo_kategori ON sulistyo_menu.id_kategori = sulistyo_kategori.id_kategori
WHERE `sulistyo_kategori`.`id_kategori`='1'";
$sulistyo_temp = mysqli_query($conn, $sulistyo_sql);
$slebew = 0;
$total_jml = 0;
foreach ($sulistyo_temp as $sulistyo_row){
    $sulistyo_minuman = $sulistyo_row['harga_menu'];
    $sulistyo_jumlah = $sulistyo_row['jumlah'];
    $total_minuman = $sulistyo_minuman * $sulistyo_jumlah; 
    $slebew += $total_minuman; 
    $total = $sulistyo_row['total'];
    $total_jml += $sulistyo_jumlah;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Cafe</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="d-flex">
    <?php include "sidebar.php" ?>
    <main>
        <div class="container pt-3 ms-5 me-0 pe-5 scrollarea">
            <div class="row">
                <div class="col">
                    <h2>Laporan Keuangan Cafe</h2>
                        <div class="mt-5 d-flex align-items-center" style="width:300px; height: 300px;">
                        <canvas id="penjualanChart"></canvas>
                        <canvas></canvas>
                        <canvas id="pendapatanBersihChart"></canvas>
                        <script>
                            const penjualanData = [<?=$slebew?>, <?=$akhir?>];
                            const jumlahPenjualan = [ <?=$total_jml?>, <?=$total_jmla?>];
                            const config = {
                                type: 'doughnut',
                                data: {
                                    labels: ['Penjualan Minuman', 'Penjualan Makanan'],
                                    datasets: [{
                                        data: penjualanData,
                                        backgroundColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)'],
                                    }]
                                },
                                options: {
                                    responsive: true,
                                }
                            };
                            const penjualanChart = new Chart(document.getElementById('penjualanChart').getContext('2d'), config);
                            config.data.labels = ['Jumlah Minuman Terjual', 'Jumlah Makanan Terjual'];
                            config.data.datasets[0].data = jumlahPenjualan;
                            config.data.datasets[0].backgroundColor = ['rgb(75, 192, 192)', 'rgb(255, 99, 132)'];
                            const pendapatanBersihChart = new Chart(document.getElementById('pendapatanBersihChart').getContext('2d'), config);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
