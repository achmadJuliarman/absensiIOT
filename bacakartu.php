<?php 
    include "koneksi.php";

    // baca tabel status untuk mode absensi
    $sql = mysqli_query($konek, "SELECT * FROM status");
    $data = mysqli_fetch_array($sql);
    $mode_absen = $data['mode'];

    //uji mode absen
    $mode = "";
    if($mode_absen==1)
        $mode = "Masuk";
    else if($mode_absen==2)
        $mode = "Istirahat";
    else if($mode_absen==3)
        $mode = "Kembali";
    else if($mode_absen==4)
        $mode = "Pulang";

    // baca tabel tmprfid
    $baca_kartu =  mysqli_query($konek, "SELECT * FROM tmprfid");
    $data_kartu = mysqli_fetch_array($baca_kartu);
    $nokartu = $data_kartu['nokartu'];
?>

<div class="container-fluid" style="text-align: center;">

    <?php if($nokartu=="") { ?>

    <h3>Absen : <?= $mode ?></h3>
    <h3>Silahkan Tempelkan Kartu RFID anda</h3>
    <img src="images/rfid.png" style="width: 200px"><br>
    <img src="images/animasi2.gif">

    <?php } else { 
        //cek nomor kartu rfid tersebut terdaftar di tabel karyawan atau belum
        $cari_karyawan = mysqli_query($konek, "SELECT * FROM karyawan WHERE nokartu='$nokartu'");
        $jumlah_data = mysqli_num_rows($cari_karyawan);

        if($jumlah_data==0)
            echo "<h1>Maaf kartu tidak dikenali</h1>";
        else {
            $data_karyawan = mysqli_fetch_array($cari_karyawan);
            $nama = $data_karyawan['nama'];

            // tanggal dan jam hari ini 
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');
            $jam = date('H:i:s');

            // cek di tabel absensi apakah nomor kartu tersebut suda ada sesuai tanggal saat ini. apabila belum ada, maka dianggap absen masuk, tapi kalau sudah ada, maka data sesuai mode absensi

            $cari_absen = mysqli_query($konek, "SELECT * FROM absensi WHERE nokartu='$nokartu' AND tanggal='$tanggal'");
            //hitung jumlah datanya
            $jumlah_absen = mysqli_num_rows($cari_absen);
            if($jumlah_absen == 0){
                echo "<h1>Selamat Datang <br> $nama</h1>";
                mysqli_query($konek, "INSERT INTO absensi(nokartu, tanggal, jam_masuk) VALUES ('$nokartu','$tanggal','$jam')");
            } else {
                //update sesuai pilihan mode absen
                if($mode_absen == 2) {
                    echo "<h1>Selamat Istirahat <br> $nama </h1>";
                    mysqli_query($konek, "UPDATE absensi SET jam_istirahat='$jam' WHERE nokartu='$nokartu' and tanggal='$tanggal'");
                } else if($mode_absen == 3) {
                    echo "<h1>Selamat Datang Kembali <br> $nama </h1>";
                    mysqli_query($konek, "UPDATE absensi SET jam_kembali='$jam' WHERE nokartu='$nokartu' and tanggal='$tanggal'");
                } else if($mode_absen == 4) {
                    echo "<h1>Selamat Jalan <br> $nama </h1>";
                    mysqli_query($konek, "UPDATE absensi SET jam_pulang='$jam' WHERE nokartu='$nokartu' and tanggal='$tanggal'");
                }
            }
        }
        //kosongkan tabel tmprfid
        mysqli_query($konek, "DELETE FROM tmprfid");
    } ?>
</div>