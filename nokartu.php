
<?php 
    include "koneksi.php";
    // baca isi tabel tmprfid
    $sql = mysqli_query($konek, "SELECT * from tmprfid");
    $data = mysqli_fetch_array($sql);
    // baca nokartu
    $nokartu = $data['nokartu']; 
?>

<div class="form-group">
    <label>No. Kartu</label>
    <input type="text" name="nokartu" id="nokartu" placeholder="tempelkan kartu RFID" class="form-control" style="width:200px" value="<?= $nokartu;?>">
</div>