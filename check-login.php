<?php
    session_start();

    include "connection.php";

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($conn, "SELECT * FROM `sulistyo_user` 
                                  WHERE username = '$username' 
                                  AND password = '$password'"
    );
    $count = mysqli_num_rows($query);
    
    if ($count > 0) {
        $login = mysqli_fetch_array($query);
        $_SESSION['id_user'] = $login['id_user'];
        $_SESSION['username'] = $login['username'];
        $_SESSION['id_role'] = $login['id_role'];
        $_SESSION['nama_user'] = $login['nama_user'];
        $_SESSION['status'] = 'login';
        
        if ($login['id_role'] == 1) {
            echo "<script>
                    alert('Login Berhasil');
                    window.location.href = 'home.php';
                  </script>";
        } elseif ($login['id_role'] == 2) {
            echo "<script>
                    alert('Login Berhasil');
                    window.location.href = 'home-manager.php';
                  </script>";
        } elseif ($login['id_role'] == 3) {
            echo "<script>
                    alert('Login Berhasil');
                    window.location.href = 'home-kasir.php';
                  </script>";
        }
    } else {
        echo "<script>
                window.location.href = 'index.php?pesan=gagal';
              </script>"; 
    }
?>