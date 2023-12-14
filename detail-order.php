<?php
include "connection.php";
include "sidebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Detail Order</title>
</head>

<body class="d-flex">
    <main>
        <div class="container pt-3 me-0 pe-5 scrollarea">
            <div class="row">
                <div class="col">
                    <table>
                        <tr>
                            <td>
                                <h2 class="mb-4">Detail Order</h2>
                            </td>
                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $sulistyo_re = "SELECT * FROM `sulistyo_order` 
                                                INNER JOIN sulistyo_pelanggan 
                                                ON sulistyo_pelanggan.id_pelanggan = sulistyo_order.id_pelanggan
                                                INNER JOIN sulistyo_user 
                                                ON sulistyo_user.id_user = sulistyo_order.id_user where id_order=$id";
                                $sulistyo_r = mysqli_query($conn, $sulistyo_re);
                                while ($sulistyo_dtorder = mysqli_fetch_array($sulistyo_r)) {
                                    $sulistyono = $sulistyo_dtorder['no_meja'];
                                    $sulistyopl = $sulistyo_dtorder['nama_pelanggan'];
                                    $sulistyotgl = $sulistyo_dtorder['tanggal'];
                                    $sulistyoidp = $sulistyo_dtorder['id_pelanggan'];
                                    $id_order = $sulistyo_dtorder['id_order'];
                                }
                                $sulistyo_sql = "SELECT * FROM `sulistyo_order`
                                                 INNER JOIN sulistyo_detail_order ON sulistyo_order.id_order = sulistyo_order.id_order 
                                                 INNER JOIN sulistyo_menu ON sulistyo_menu.id_menu = sulistyo_detail_order.id_menu 
                                                 WHERE sulistyo_order.id_order=$id";
                                $sulistyo_result = mysqli_query($conn, $sulistyo_sql);
                                while ($sulistyo_row = mysqli_fetch_array($sulistyo_result)) {
                                    $sulistyo_menu = $sulistyo_row['nama_menu'];
                                    $sulistyo_harga = $sulistyo_row['harga_menu'];
                                    $sulistyo_jumlah = $sulistyo_row['jumlah'];
                                    $sulistyo_status = $sulistyo_row['status_order'];
                                    $sulistyo_id_menu = $sulistyo_row['id_menu'];
                                }
                            }
                            $sulistyo_badge = ["Belum Selesai" => "danger", "Selesai" => "primary", "Menunggu Pembayaran" => "warning",];
                            if (isset($_POST['add'])) {
                                $id_menu = $_POST['id_menu'];
                                $jumlah = $_POST['jumlah'];

                                $sulistyo_sql = "INSERT INTO `sulistyo_detail_order` VALUES (NULL, '$id', '$id_menu', '$jumlah', 'Belum Selesai')";
                                $query = mysqli_query($conn, $sulistyo_sql);
                            }
                            //elseif (isset($_POST['order'])) {
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
                                        WHERE id_user = '" . $_SESSION['id_user'] . "'
                                        AND tanggal = '" . date('Y-m-d') . "'";
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
                                <div class="mb-3" role="group">
                                    <input type="hidden" name="id_order" value="<?= $id_order ?>">
                                    <input type="radio" class="btn-check" name="no_meja" autocomplete="off" value="<?= $id_order ?>" <?= $id_order == $id_order ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-primary">Meja <?= $sulistyono ?></label>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Pelanggan</td>
                            </tr>
                            <td>
                                <div class="input-group mb-4" style="width: 1050px;">
                                    <input class="form-control" value="<?= $sulistyopl ?>" disabled>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Tanggal</td>
                            </tr>
                            <td>
                                <div class="input-group mb-4" style="width: 1050px;">
                                    <input class="form-control" value="<?= $sulistyotgl ?>" disabled>
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
                                        <?php foreach ($sulistyo_hasil as $sulistyo_menu) : ?>
                                            <option value="<?= $sulistyo_menu['id_menu'] ?>"><?= $sulistyo_menu['nama_menu'] ?></option>
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
                                    $sulistyo_sql = "SELECT * FROM `sulistyo_detail_order` 
                                                     JOIN sulistyo_menu ON sulistyo_detail_order.id_menu = sulistyo_menu.id_menu 
                                                     WHERE `id_order`='$id'";
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
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0;
                                            foreach ($sulistyo_temp as $k => $sulistyo_row) : ?>
                                                <?php $status = $sulistyo_row['status_detail_order']; ?>
                                                <tr>
                                                    <td><?= $k + 1; ?></td>
                                                    <td><?= $sulistyo_row['nama_menu'] ?></td>
                                                    <td>Rp.<?= number_format($sulistyo_row['harga_menu']); ?></td>
                                                    <td><?= $sulistyo_row['jumlah'] ?></td>
                                                    <td class="text-end">Rp.<?= number_format($sulistyo_row['harga_menu'] * $sulistyo_row['jumlah']); ?></td>
                                                    <td class="text-center">
                                                        <div class="badge text-bg-<?= $sulistyo_badge[$sulistyo_row['status_detail_order']] ?>"><?= $sulistyo_row['status_detail_order'] ?></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($sulistyo_row['status_detail_order'] == 'Belum Selesai') {
                                                            echo "<a href='proses-order.php?id_detail_order=$sulistyo_row[id_detail_order]&id_order=$sulistyo_row[id_order]' class='btn btn-success me-1'><i class='bi bi-check2'></i> Proses</a>";
                                                            echo "<a href='hapus-detail.php?id_detail_order=$sulistyo_row[id_detail_order]&id_order=$sulistyo_row[id_order]' class='btn btn-danger'><i class='bi bi-trash3'></i></a>";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php $total += ($sulistyo_row['harga_menu'] * $sulistyo_row['jumlah']);
                                            endforeach; ?>
                                            <th>Grand Total</th>
                                            <th colspan="4" class="text-end">Rp.<?= number_format($total) ?></th>
                                            <?php
                                            $sulistyo_sql = "UPDATE `sulistyo_order` SET `total` = '$total' WHERE `sulistyo_order`.`id_order` = $id_order";
                                            $query = mysqli_query($conn, $sulistyo_sql);
                                            ?>
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
                    <?php if ($status != "Belum Selesai") : ?>
                        <form action="proses-pembayaran.php" method="POST">
                            <input type="hidden" name="total" value="<?= $total ?>">
                            <input type="hidden" name="id_order" value="<?= $id_order ?>">
                            <button class="btn btn-primary w-100 mt-2" name="bayar">Bayar</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>