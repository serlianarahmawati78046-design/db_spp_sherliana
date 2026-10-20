<?php
$koneksi = mysqli_connect("localhost","root","123456","db_spp_sherli");

//check connection
if(mysqli_connect_errno()){ 
    die ("koneksi database gagal : " .mysqli_connect_error());
}


?>