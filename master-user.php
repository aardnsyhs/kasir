<?php
include "connection.php";

$default_per_page = 4;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$per_page = isset($_GET['entries']) ? $_GET['entries'] : $default_per_page;
$start = ($current_page - 1) * $per_page;

$sulistyo_sql = "SELECT * FROM `sulistyo_user` JOIN role ON sulistyo_user.id_role = role.id_role LIMIT $start, $per_page";
$sulistyo_menu = mysqli_query($conn, $sulistyo_sql);
$sulistyo_badge= ["Belum Selesai"=>"danger","Selesai"=>"primary", "Menunggu Pembayaran"=>"warning",];
$total_data_query = "SELECT COUNT(*) as total FROM `sulistyo_user`";
$total_data_result = mysqli_query($conn, $total_data_query);
$row = $total_data_result->fetch_assoc();
$total_data = $row['total'];
$total_pages = ceil($total_data / $per_page);
$start_count = ($current_page - 1) * $per_page + 1;
$end_count = min($start + $per_page, $total_data);

if (isset($_POST['cari'])) {
    $search = $_POST['search'];
    $id_role = $_POST['id_role'];
    
    if ($id_role != "") {
        $sulistyo_sql = "SELECT * FROM `sulistyo_user` 
                         JOIN role 
                         ON sulistyo_user.id_role = role.id_role
                         WHERE LOWER(nama_user) LIKE '%$search%'
                         AND sulistyo_user.id_role = $id_role";
    } else {
        $sulistyo_sql = "SELECT * FROM `sulistyo_user` 
                         JOIN role 
                         ON sulistyo_user.id_role = role.id_role
                         WHERE LOWER(nama_user) LIKE '%$search%'";
    }
    
} else {
    $sulistyo_sql = "SELECT * FROM `sulistyo_user` JOIN role ON sulistyo_user.id_role = role.id_role LIMIT $start, $per_page";
}
$sulistyo_user = mysqli_query($conn, $sulistyo_sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Yan's Cafe | User</title>
</head>
<body class="d-flex">
<?php
$active_page = 'master-user';
include "sidebar.php";
?>
<main>
    <div class="container pt-3 ms-5 me-0 pe-5 scrollarea">
        <div class="row">
            <div class="col">
                <h2>Data User</h2>
                    <a class="btn btn-primary" href="tambah-user.php">
                        <i class="bi bi-person-add"></i> Tambah Data User
                    </a>
                <div class="mt-3">
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
                                    <form class="d-flex" method="post">
                                        <div class="mb-2 d-flex align-items-center" style="margin-left: 41px;">
                                            Search
                                        <input class="ms-2 form-control form-control-sm" name="search" type="search" id="keyword" placeholder="Cari Daftar User" autocomplete="off">  
                                        <?php
                                            $user = mysqli_query($conn, "SELECT * FROM `role`");
                                        ?>
                                        <select class="ms-2 form-select form-select-sm" name="id_role" id="form-kategori">
                                            <option value="">ALL</option>
                                            <?php 
                                            foreach ($user as $kat) {
                                                echo "<option value='".$kat['id_role']."'>".$kat['nama_role']."</option>";
                                            } ?>
                                        </select>
                                        <button class="btn btn-sm btn-outline-dark ms-1" type="submit" name="cari" style="height: 30px;">Cari</button>
                                        </div>
                                    </form>
                                    </td>
                                </tr>
                        </table>
                    <div id="container">
                <table class="table table-fluid table-bordered table-striped">
                    <thead>
                        <tr class="text-center align-middle">
                            <th>ID User</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($sulistyo_row = $sulistyo_user->fetch_assoc()): ?>
                            <tr class="text-center align-middle">
                                <td><?= $sulistyo_row['id_user']; ?></td>
                                <td><?= $sulistyo_row['nama_user']; ?></td>
                                <td><?= $sulistyo_row['username']; ?></td>
                                <td><?= $sulistyo_row['nama_role']; ?></td>
                                <td>
                                    <a class="btn btn-success" href="ubah-user.php?id=<?= $sulistyo_row['id_user']?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg> Edit</a> 
                                    <a class="btn btn-danger" href="hapus-user.php?id=<?= $sulistyo_row['id_user']?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg> Hapus</a>
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
    xhr.open('GET', 'search/master-user.php?keyword=' + keyword.value, true);
    xhr.send();
    });
</script>
</body>
</html>