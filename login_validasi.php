<?php
session_start();

include 'src/koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username ='$username' 
AND password = '$password'")
or die(mysql_error());
$cek = mysqli_num_rows($login);

if($cek > 0){
    $data = mysqli_fetch_assoc($login);

    if($data['level']=="admin"){
        $_SESSION['username']= $username;
        $_SESSION['level']= "admin";
        $_SESSION['id_petugas'] = $data['id_petugas'];
        echo '<script language="javascript">alert("Anda berhasil Login Admin!");
        document.location="admin/halaman_admin.php"; </script>';
    }else if($data['level']=="petugas"){
        $_SESSION['username']= $username;
        $_SESSION['level']= "petugas";
        $_SESSION['id_petugas']= $data['id_petugas'];
        echo '<script language="javascript">alert("Anda berhasil Login Petugas!");
        document.location="petugas/halaman_petugas.php";</script>';
    }else{
        header("location:index.php?pesan=gagal");
    }
}else{
    header("location:index.php?pesan=gagal");
}
?>