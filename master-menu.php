<?php
include "connection.php";

$default_per_page = 2;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$per_page = isset($_GET['entries']) ? $_GET['entries'] : $default_per_page;
$start = ($current_page - 1) * $per_page;

$sulistyo_sql = "SELECT * FROM `sulistyo_menu` 
                 JOIN sulistyo_kategori 
                 ON sulistyo_menu.id_kategori = sulistyo_kategori.id_kategori
                 LIMIT $start, $per_page";
$sulistyo_menu = mysqli_query($conn, $sulistyo_sql);
$sulistyo_badge = ["Belum Selesai" => "danger", "Selesai" => "primary", "Menunggu Pembayaran" => "warning",];
$total_data_query = "SELECT COUNT(*) as total FROM `sulistyo_menu`";
$total_data_result = mysqli_query($conn, $total_data_query);
$row = $total_data_result->fetch_assoc();
$total_data = $row['total'];
$total_pages = ceil($total_data / $per_page);
$start_count = ($current_page - 1) * $per_page + 1;
$end_count = min($start + $per_page, $total_data);

if (isset($_POST['cari'])) {
    $search = $_POST['search'];
    $id_kategori = $_POST['id_kategori'];

    if ($id_kategori != "") {
        $sulistyo_sql = "SELECT * FROM `sulistyo_menu` 
                         JOIN sulistyo_kategori 
                         ON sulistyo_menu.id_kategori = sulistyo_kategori.id_kategori
                         WHERE LOWER(nama_menu) LIKE '%$search%'
                         AND sulistyo_kategori.id_kategori = $id_kategori";
    } else {
        $sulistyo_sql = "SELECT * FROM `sulistyo_menu` 
                         JOIN sulistyo_kategori 
                         ON sulistyo_menu.id_kategori = sulistyo_kategori.id_kategori
                         WHERE LOWER(nama_menu) LIKE '%$search%'
                         OR LOWER(harga_menu) LIKE '%$search%'
                         OR LOWER(nama_kategori) LIKE '%$search%'
                         OR LOWER(status_menu) LIKE '%$search%'";
    }
} else {
    $sulistyo_sql = "SELECT * FROM `sulistyo_menu` 
                     JOIN sulistyo_kategori 
                     ON sulistyo_menu.id_kategori = sulistyo_kategori.id_kategori
                     LIMIT $start, $per_page";
}

$result = mysqli_query($conn, $sulistyo_sql);

// if (isset($_POST['cari'])) {
//     $keyword = $_POST['keyword'];
//     $sulistyo_sql = "SELECT * FROM `sulistyo_menu` 
//                      JOIN sulistyo_kategori 
//                      ON sulistyo_menu.id_kategori = sulistyo_kategori.id_kategori
//                      WHERE LOWER(nama_menu) LIKE '%$keyword%'
//                      OR LOWER(harga_menu) LIKE '%$keyword%'
//                      OR LOWER(nama_kategori) LIKE '%$keyword%'
//                      OR LOWER(status_menu) LIKE '%$keyword%'";
// } else {
//     $sulistyo_sql = "SELECT * FROM `sulistyo_menu` 
//                      JOIN sulistyo_kategori 
//                      ON sulistyo_menu.id_kategori = sulistyo_kategori.id_kategori";
// }

// $result = mysqli_query($conn, $sulistyo_sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Yan's Cafe | Menu</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="d-flex">
    <?php
    $active_page = 'master-menu';
    include "sidebar.php";
    ?>
    <main>
        <div class="pt-3 me-0 pe-5 scrollarea" style="margin-left: 60px;">
            <div class="row">
                <div class="col">
                    <h2>Menu</h2>
                    <a class="btn btn-primary" href="tambah-menu.php">
                        <i class="bi bi-person-add"></i> Tambah Daftar Menu
                    </a>
                    <div class="mt-3 table-responsive">
                        <!-- <form class="d-flex align-items-center" role="search" method="post">
                            <input class="form-control form-control-sm input-search mb-1 mt-1" type="search" name="keyword" placeholder="Cari Daftar Menu" autocomplete="off">  
                            <button class="btn btn-sm btn-outline-dark ms-1" type="submit" name="cari" style="height: 30px;">Cari</button>
                        </form> -->
                        <table>
                            <tr>
                                <td>
                                    <form method="GET" class="mb-2 mx-auto">
                                        Show <select name="entries" onchange="this.form.submit()">
                                            <?php $entries_options = [2, 4, 6, 8]; ?>
                                            <?php foreach ($entries_options as $option) : ?>
                                                <?php $selected = ($option == $per_page) ? 'selected' : ''; ?>
                                                <option value="<?= $option ?>" <?= $selected ?>><?= $option ?></option>
                                            <?php endforeach; ?>
                                        </select> Entries
                                    </form>
                                </td>
                                <td>
                                    <form class="d-flex" role="search" method="post">
                                        <div class="mb-2 pt-1 d-flex align-items-center" style="margin-left: 263px;">
                                            Search
                                            <input class="ms-2 form-control form-control-sm" type="text" name="search" autocomplete="off">
                                            <?php
                                            $kategori = mysqli_query($conn, "SELECT * FROM `sulistyo_kategori`");
                                            ?>
                                            <select class="ms-2 form-select form-select-sm" name="id_kategori" id="form-kategori">
                                                <option value="">ALL</option>
                                                <?php
                                                foreach ($kategori as $kat) {
                                                    echo "<option value='" . $kat['id_kategori'] . "'>" . $kat['nama_kategori'] . "</option>";
                                                } ?>
                                            </select>
                                            <button class="btn btn-sm btn-outline-dark ms-1" type="submit" name="cari" style="height: 30px;">Cari</button>
                                        </div>
                    </div>
                    </form>
                    </td>
                    </tr>
                    </table>
                    <table class="table table-fluid table-bordered table-striped" style="width: auto;">
                        <thead>
                            <tr class="text-center">
                                <th>ID Menu</th>
                                <th>Nama Menu</th>
                                <th>Harga Menu</th>
                                <th>Kategori</th>
                                <th>Foto Menu</th>
                                <th>Status Menu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($sulistyo_row = $result->fetch_assoc()) : ?>
                                <tr class="text-center align-middle">
                                    <td><?= $sulistyo_row["id_menu"]; ?></td>
                                    <td><?= $sulistyo_row["nama_menu"]; ?></td>
                                    <td><?= $sulistyo_row["harga_menu"]; ?></td>
                                    <td><?= $sulistyo_row["nama_kategori"]; ?></td>
                                    <td><img style="width: 90px;" src="pict/<?= $sulistyo_row["foto_menu"]; ?>" alt="Foto Menu"></td>
                                    <td><?= $sulistyo_row["status_menu"]; ?></td>
                                    <td>
                                        <a class="btn btn-success" href="ubah-menu.php?id=<?= $sulistyo_row['id_menu'] ?>">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a class="btn btn-danger" href="hapus-menu.php?id=<?= $sulistyo_row['id_menu'] ?>">
                                            <i class="bi bi-trash"></i> Hapus
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
                            <?php echo "Showing $start_count - $end_count of $total_data Data"; ?>
                        </div>
                        <div class="col-md-4 offset-md-4">
                            <nav>
                                <ul class="pagination justify-content-end" style="margin: 0px; padding: 0px;">
                                    <?php if ($current_page > 1) : ?>
                                        <li class="page-item"><a class="page-link" href="?page=<?= $current_page - 1 ?>&entries=<?= $per_page ?>">Previous</a></li>
                                    <?php elseif ($current_page == 1) : ?>
                                        <li class="page-item"><a class="page-link disabled" href="?page=<?= $current_page - 1 ?>&entries=<?= $per_page ?>">Previous</a></li>
                                    <?php endif; ?>
                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                        <?php if ($i == $current_page) : ?>
                                            <li class="page-item active" aria-current="page">
                                                <?php
                                                echo "<a class='page-link' href='?page=$i&entries=$per_page'>$i</a>";
                                                ?>
                                            </li>
                                        <?php else : ?>
                                            <?php
                                            echo "<li class='page-item'><a class='page-link' href='?page=$i&entries=$per_page'>$i</a></li>";
                                            ?>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <?php if ($current_page < $total_pages) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $current_page + 1 ?>&entries=<?= $per_page ?>">Next</a>
                                        </li>
                                    <?php elseif ($current_page == $total_pages) : ?>
                                        <li class="page-item">
                                            <a class="page-link disabled" href="?page=<?= $current_page + 1 ?>&entries=<?= $per_page ?>">Next</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>