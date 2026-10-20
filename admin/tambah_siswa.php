<?php
include_once "../src/koneksi.php";

if(isset($_POST['btnSimpan'])) {
    $nisn     = trim($_POST['nisn']);
    $nis      = trim($_POST['nis']);
    $nama     = trim($_POST['nama']);
    $id_kelas = $_POST['id_kelas'];
    $alamat   = trim($_POST['alamat']);
    $no_telp  = trim($_POST['no_telp']);
    $id_spp   = $_POST['id_spp'];
    $arraybulan = array("Juli", "Agustus", "September", "Oktober", "November", "Desember", "Januari", "Februari",
    "Maret", "April", "Mei", "Juni");

    $pesanError = array();
    if ($nisn == "") {
        $pesanError[] = "Data <b> NISN </b> tidak boleh kosong !";
    }
    if ($nis == "") {
        $pesanError[] = "Data <b> NIS </b> tidak boleh kosong !";
    }
    if ($nama == "") {
        $pesanError[] = "Data <b> NAMA </b> tidak boleh kosong !";
    }
    // Perbaikan: cegah jika user belum memilih kelas (nilai '' atau 'kosong')
    if ($id_kelas == "" || $id_kelas == "kosong") {
        $pesanError[] = "Data <b> KELAS </b> belum dipilih !";
    }
    if ($alamat == "") {
        $pesanError[] = "Data <b> ALAMAT </b> tidak boleh kosong !";
    }
    if ($no_telp == "") {
        $pesanError[] = "Data <b> NOMOR TELEPON </b> tidak boleh kosong !";
    }
    // Perbaikan: cegah jika user belum memilih SPP (nilai '' atau 'kosong')
    if ($id_spp == "" || $id_spp == "kosong") {
        $pesanError[] = "Data <b> NOMINAL SPP </b> belum dipilih !";
    }

    if (count($pesanError) >= 1) {
        $noPesan = 0;
        foreach ($pesanError as $pesan_tampil) {
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "<br>";
    } else {
        $sql = mysqli_query($koneksi, "INSERT INTO siswa (nisn, nis, nama, id_kelas, alamat, no_telp, id_spp) VALUES(
        '$nisn', '$nis', '$nama', '$id_kelas', '$alamat', '$no_telp', '$id_spp')");

        if($sql){
            $ds = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nisn FROM siswa WHERE nisn = '$nisn'"));
            $nisn = $ds['nisn'];

            $tahunsekarang = date('Y');
            for($i=0; $i<12; $i++){
                $bulan = $arraybulan[$i];

                if ($i == 6) {
                    $tahunsekarang++;
                }
                
            
            mysqli_query($koneksi, "INSERT INTO pembayaran (nisn,bulan_tagihan,tahun_tagihan,id_spp) values ('$nisn',
            '$bulan', '$tahunsekarang', '$id_spp')");
            }
            echo "<center> <b> <font color='green' size='4'> <p> Data Berhasil Disimpan </p> </font> </b> </center> </br>
            <meta http-equiv='refresh' content='2; url=?open=data_siswa'>";
        } else {
            // Perbaikan: memunculkan pesan error spesifik jika terjadi error query
            echo "<center> <b> <font color='red' size='4'> <p> Data Gagal Disimpan! Error: ".mysqli_error($koneksi)." </p> </font> </b> </center>
            <meta http-equiv='refresh' content='2; url=?open=data_siswa'>";
        }
        exit;
    }
}
?>

<form action="" method="post">
    <table cellspacing="1" cellpadding="3">
        <tr>
            <td bgcolor="#CCCCCC" colspan="3"><strong>TAMBAH DATA SISWA</strong></td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td><input name="nisn" type="text" size="10" maxlength="10"/></td>
        </tr>
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td><input name="nis" type="text" size="20" maxlength="10"/></td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td><input name="nama" type="text" size="50" maxlength="50"/></td>
        </tr>
        <tr>
            <td>KELAS</td>
            <td>:</td>
            <td>
                <select name="id_kelas">
                    <!-- Perbaikan: value diubah menjadi '' agar terdeteksi belum memilih jika dikirim -->
                    <option value=""> ..... </option>
                    <?php
                        $tampilkanKelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                        while ($bacaData = mysqli_fetch_array($tampilkanKelas)){
                            // Perbaikan: disederhanakan tanpa variable $data['id_kelas'] yang undefined
                            echo "<option value='".$bacaData['id_kelas']."'>".$bacaData['nama_kelas']."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>ALAMAT</td>
            <td>:</td>
            <td><input name="alamat" type="text" size="50" maxlength="50"/></td>
        </tr>
        <tr>
            <td>NO TELEPON</td>
            <td>:</td>
            <td><input name="no_telp" type="text" size="50" maxlength="50"/></td>
        </tr>
        <tr>
            <td>NOMINAL</td>
            <td>:</td>
            <td>
                <select name="id_spp">
                    <!-- Perbaikan: value diubah menjadi '' -->
                    <option value=""> ..... </option>
                    <?php
                        $tampilkanSPP = mysqli_query($koneksi, "SELECT * FROM spp");
                        while ($bacaData = mysqli_fetch_array($tampilkanSPP)){
                            // Perbaikan: disederhanakan tanpa variable $data['id_spp'] yang undefined
                            echo "<option value='".$bacaData['id_spp']."'>".$bacaData['nominal']."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="btnSimpan" type="submit" value="Simpan"/></td>
        </tr>
    </table>
</form>