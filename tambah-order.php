<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Order</title>
</head>
<body class="d-flex">
<?php include "sidebar.php"; ?>
<main>
    <div class="container pt-3 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <table>
                    <tr>
                        <td>
                            <h2 class="mb-4">Orderan Baru</h2>
                        </td>
                        <?php
                            if (isset($_POST['add'])) {
                                if (isset($_POST['no_meja'])) {
                                    $no_meja = $_POST['no_meja'];
                                } else {
                                    $no_meja = "";
                                }
                                $id_order_temp = $_POST['id_order_temp'];
                                $id_pelanggan = $_POST['id_pelanggan'];
                                if ($no_meja == "" & $id_pelanggan == "") {
                                    echo "<script>alert('No Meja dan Pelanggan Harus Diisi!');</script>";
                                } else {
                                    $id_menu = $_POST['id_menu'];
                                    $jumlah = $_POST['jumlah'];
                                    $id_user = $_SESSION['id_user'];

                                    if ($id_order_temp == "") {
                                        $sulistyo_sql = "INSERT INTO sulistyo_order_temp
                                                        VALUES (NULL, '$no_meja', '".date('Y-m-d')."', '$id_user', '$id_pelanggan')";
                                        $sulistyo_query = mysqli_query($conn, $sulistyo_sql);
                                    }

                                    $sulistyo_sql = "SELECT * FROM `sulistyo_detail_order_temp`
                                                    WHERE id_user = '$id_user' AND id_menu = '$id_menu' AND tanggal = '".date('Y-m-d')."'";
                                    $detail_order_temp = mysqli_query($conn, $sulistyo_sql);
                                    $sulistyo_cek = mysqli_num_rows($detail_order_temp);

                                    if ($sulistyo_cek > 0) {
                                        $data_detail = mysqli_fetch_array($detail_order_temp);
                                        $jumlah_update = $jumlah + $data_detail['jumlah'];
                                        $sulistyo_sql = "UPDATE sulistyo_detail_order_temp SET jumlah = '$jumlah_update'
                                                        WHERE id_user = '$id_user' AND id_menu = '$id_menu'";
                                        $sulistyo_query = mysqli_query($conn, $sulistyo_sql);
                                    } else {
                                        $sulistyo_sql = "INSERT INTO sulistyo_detail_order_temp
                                                        VALUES (NULL, '".date('Y-m-d')."', '$id_user', '$id_menu', '$jumlah')";
                                        $sulistyo_query = mysqli_query($conn, $sulistyo_sql);
                                    }
                                }
                            } //elseif (isset($_POST['order'])) {
                            //     date_default_timezone_set("Asia/Jakarta");
                            //     $sulistyo_meja = $_POST['no_meja'];
                            //     $sulistyo_total = $_POST['total'];
                            //     $sulistyo_kasir = $_SESSION['id_user'];
                            //     $sulistyo_pelanggan = $_POST['id_pelanggan'];
                            //     $id_order_temp = $_POST['id_order_temp'];
                            //     $sulistyo_sql = "INSERT INTO `sulistyo_order` 
                            //                      VALUES (NULL, '$sulistyo_meja', now(), '$sulistyo_kasir', '$sulistyo_pelanggan', '$sulistyo_total', 'Belum Selesai')";
                            //     $sulistyo_query = mysqli_query($conn, $sulistyo_sql);

                            //     if ($sulistyo_query) {
                            //         echo "<script>
                            //                 alert('Data Order Berhasil Disimpan');
                            //                 window.location.href = 'transaksi-order.php';
                            //             </script>";
                            //     } else {
                            //         echo "<script>
                            //                 alert('Data Order Gagal Disimpan');
                            //                 window.location.href = 'transaksi-order.php';
                            //             </script>";
                            //     }
                            // }
                        ?>
                    </tr>
                    <form method="POST">
                        <?php
                            $sulistyo_sql = "SELECT * FROM `sulistyo_order_temp`
                                            WHERE id_user = '".$_SESSION['id_user']."'
                                            AND tanggal = '".date('Y-m-d')."'";
                            $sulistyo_order_temp = mysqli_query($conn, $sulistyo_sql);

                            $sulistyo_row = mysqli_fetch_array($sulistyo_order_temp);
                            
                            if ($sulistyo_row) {
                                $id_order_temp = $sulistyo_row['id_order_temp'];
                                $no_meja = $sulistyo_row['no_meja'];
                                $id_pelanggan = $sulistyo_row['id_pelanggan'];
                            } else {
                                $id_order_temp = "";
                                $no_meja = 0;
                                $id_pelanggan = 0;
                            }
                        ?>
                    <tr>
                        <tr>
                            <td>No Meja</td>
                        </tr>
                        <td>
                            <div class="btn-group mb-3" role="group">
                                <input type="hidden" name="id_order_temp" value="<?=$id_order_temp?>">
                                <?php for ($i=1; $i <= 10; $i++): ?>
                                <input type="radio" class="btn-check" name="no_meja" id="btnradio<?=$i?>" autocomplete="off" value="<?=$i?>" <?=$i == $no_meja ? 'checked' : ''?>>
                                <label class="btn btn-outline-primary" for="btnradio<?=$i?>">Meja <?=$i?></label>
                                <?php endfor; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <tr>
                            <td>Pelanggan</td>
                        </tr>
                        <td>
                            <?php
                                $sulistyo_sql = "SELECT * FROM `sulistyo_pelanggan`";
                                $sulistyo_result = mysqli_query($conn, $sulistyo_sql);
                            ?>
                            <div class="input-group mb-4" style="width: 1050px;">
                                <select class="form-select" name="id_pelanggan">
                                    <option value="">-- Pilih Pelanggan --</option>
                                    <?php foreach ($sulistyo_result as $sulistyo_pelanggan): ?>
                                    <option value="<?=$sulistyo_pelanggan['id_pelanggan']?>" <?=$id_pelanggan == $sulistyo_pelanggan['id_pelanggan'] ? 'selected' : ''?>><?=$sulistyo_pelanggan['nama_pelanggan']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <tr>
                            <td>Tambah Menu</td>
                        </tr>
                        <td>
                            <?php
                                $sulistyo_sql = "SELECT * FROM `sulistyo_menu`";
                                $sulistyo_hasil = mysqli_query($conn, $sulistyo_sql);
                            ?>
                            <div class="input-group mb-3">
                                <select class="form-select" name="id_menu">
                                    <option selected>-- Pilih Menu --</option>
                                    <?php foreach ($sulistyo_hasil as $sulistyo_menu): ?>
                                    <option value="<?=$sulistyo_menu['id_menu']?>"><?=$sulistyo_menu['nama_menu']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" min="1">
                                <input class="btn btn-primary" type="submit" value="Tambah" name="add"></input>
                            </div>
                        </td>
                        </tr>
                    </tr>
                    <tr>
                        <tr>
                            <td>
                                <?php
                                    $sulistyo_sql = "SELECT * FROM `sulistyo_detail_order_temp`
                                                     JOIN sulistyo_menu 
                                                     ON sulistyo_detail_order_temp.id_menu = sulistyo_menu.id_menu
                                                     WHERE sulistyo_detail_order_temp.id_user='".$_SESSION['id_user']."' and sulistyo_detail_order_temp.tanggal='".date('Y-m-d')."'";
                                    $sulistyo_temp = mysqli_query($conn, $sulistyo_sql);
                                ?>
                                <table class="table table-fluid table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th class="text-end">Subtotal</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; foreach ($sulistyo_temp as $k => $sulistyo_row): ?>
                                        <tr>
                                            <td><?= $k+1; ?></td>
                                            <td><?= $sulistyo_row['nama_menu'] ?></td>
                                            <td>Rp.<?= number_format($sulistyo_row['harga_menu']); ?></td>
                                            <td><?= $sulistyo_row['jumlah'] ?></td>
                                            <td class="text-end">Rp.<?= number_format($sulistyo_row['harga_menu'] * $sulistyo_row['jumlah']); ?></td>
                                            <td class="text-center">
                                                <?php
                                                    echo "<a href='hapus-detail-temp.php?id=$sulistyo_row[id_detail_order_temp]' class='btn btn-danger'><i class='bi bi-trash3'></i></a>"
                                                ?>
                                            </td>
                                        </tr>
                                        <?php $total += ($sulistyo_row['harga_menu'] * $sulistyo_row['jumlah']); endforeach; ?>
                                        <th>Grand Total</th>
                                        <th colspan="4" class="text-end">Rp.<?=number_format($total)?></th>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tr>
                    <tr>
                        <td>
                            </td>
                        </tr>
                    </form>
                </table>
                <form action="proses-order.php" method="POST">
                    <input type="hidden" name="total" value="<?=$total?>">
                    <input type="hidden" name="id_order_temp" value="<?=$id_order_temp?>">
                    <button class="btn btn-primary w-100 mt-2" name="order">Order</button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>