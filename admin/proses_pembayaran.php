<?php
session_start();
    include_once "../src/koneksi.php";
    if($_GET['act']=='bayar'){

    $id_pembayaran= $_GET['id_pembayaran'];
    $nisn = $_GET['nisn'];
    $today = date("Ymd");
    $query = mysqli_query($koneksi, "SELECT max(no_bayar) AS last FROM pembayaran WHERE no_bayar LIKE '$today%'");
    $data = mysqli_fetch_array($query);
    $lastNoBayar = $data['last'];
    $lastNoUrut = (int) substr($lastNoBayar, 6, 4);
    $nextNoUrut = $lastNoUrut + 1;
    $nextNoBayar = $today.sprintf('%04s', $nextNoUrut);
    $tgl_pembayaran = date('Y-m-d');
    $admin = $_SESSION['id_petugas'];
    mysqli_query($koneksi, "UPDATE pembayaran SET no_bayar = '$nextNoBayar',
                                    tgl_pembayaran = '$tgl_pembayaran',
                                    keterangan = 'LUNAS',
                                    id_petugas = '$admin'
                            WHERE id_pembayaran='$id_pembayaran'");

    header('location: halaman_admin.php?open=data_pembayaran&nisn=' . $nisn);
    }
?>
