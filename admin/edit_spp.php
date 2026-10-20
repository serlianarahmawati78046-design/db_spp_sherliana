<?php
include_once "../src/koneksi.php";
if(isset($_POST['btnSimpan'])){
    $id_spp = $_POST['id_spp'];
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];

    $pesanError = array();
    if (trim($id_spp)==""){
        $pesanError[]="Data <b> ID SPP </b> tidak boleh kosong !";
    }
    if (trim($tahun)==""){
        $pesanError[]="Data <b> Tahun </b> tidak boleh kosong !";
    }
    if (trim($nominal)==""){
        $pesanError[]="Data <b> Nominal </b> tidak boleh kosong !";
    }
    if (count($pesanError)>=1){
        $noPesan=0;
        foreach ($pesanError as $indeks=>$pesan_tampil){
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "</div> <br>";
    }
    else {
        $sqlEdit = mysqli_query($koneksi, "UPDATE spp SET tahun='$tahun', nominal='$nominal'
        WHERE id_spp='$id_spp'");
        if($sqlEdit){
            echo "<center> <b> <font color= 'red' size = '4' <p> Data berhasil diubah </p>
            <meta http-equiv='refresh' content='2; url=?open=data_spp'>";
        }
        else {
            echo "<center> <b> <font color= 'red' size='4' <p> Data gagal diubah!
            <meta http-equiv='refresh' content='2; url=?open=data_spp'>";
        }
        exit;
    }
}
$id_sp = $_GET['id_spp'];
$sql = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp = '$id_sp'");
$data = mysqli_fetch_array($sql);
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
    <table class="table-list" width="650" border="0" cellspacing="1" cellpadding="3">
        <tr>
            <td bgcolor="#FF0099"><strong>UBAH DATA SPP</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td width="182"><strong>ID SPP</strong></td>
            <td width="6">:</td>
            <td width="440"><input name="id_spp" type="text" value="<?php echo $data['id_spp']; ?>"
            readonly="true"/></td>
        </tr>
        <tr>
            <td><strong>Nominal</strong></td>
            <td>:</td>
            <td><input name="nominal" type="text" value="<?php echo $data['nominal']; ?>"
            size="60" maxlength="100"/></td>
        </tr>
        <tr>
            <td><strong>Tahun</strong></td>
            <td>:</td>
            <td><input name="tahun" type="text" value="<?php echo $data['tahun']; ?>"
            size="60" maxlength="100"/></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="btnSimpan" type="submit" id="btnSimpan" value="Simpan"/></td>
        </tr>
    </table>
</form>