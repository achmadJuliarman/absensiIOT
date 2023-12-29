
<?php 
    include "koneksi.php";

    //baca no kartu rfid
    $nokartu = $_GET['nokartu'];
    //kosongkan tabel tmprfid
    mysqli_query($konek, "DELETE FROM tmprfid");

    // simpan no kartu yang baru ke tabel tmprfid

    $simpan = mysqli_query($konek, "INSERT INTO tmprfid(nokartu) VALUES ('$nokartu')");
    if($simpan)
        echo "berhasil";
    else 
        echo "Gagal";


?>