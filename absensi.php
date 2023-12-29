<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Rekapitulasi Absensi</title>
    </head>
    <body>
        <?php include "menu.php"; ?>

        <!-- bagian isi -->
        <div class="container-fluid">
            <h3>Data Karyawan</h3>
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: grey; color: white;">
                        <th style="width: 10px; text-align: center">No.</th>
                        <th style="text-align: center">Nama</th>
                        <th style="text-align: center">Tanggal</th>
                        <th style="text-align: center">Jam Masuk</th>
                        <th style="text-align: center">Jam Istirahat</th>
                        <th style="text-align: center">Jam Kembali</th>
                        <th style="text-align: center">Jam Pulang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include "koneksi.php";

                        // baca tabel absensi dan relasikan dengan tabel karyawna berdasarkan no kartu RFID untuk tanggal hari ini


                        // baca tanggal saat ini
                        date_default_timezone_set('Asia/Jakarta');
                        $tanggal = date('Y-m-d');


                        // filter absensi berdasarkan tanggal saat ini
                        $sql = mysqli_query($konek, "SELECT b.nama, a.tanggal, a.jam_masuk, a.jam_istirahat,a.jam_kembali, a.jam_pulang FROM absensi a, karyawan b WHERE a.nokartu=b.nokartu AND a.tanggal='$tanggal'");

                        $no = 0;
                        while($data = mysqli_fetch_array($sql)) {
                            $no++;

                    ?>
                    <tr>
                        <td> <?= $no; ?> </td>
                        <td> <?= $data['nama']; ?> </td>
                        <td> <?= $data['tanggal']; ?></td>
                        <td> <?= $data['jam_masuk']; ?></td>
                        <td> <?= $data['jam_istirahat']; ?></td>
                        <td> <?= $data['jam_kembali']; ?></td>
                        <td> <?= $data['jam_pulang']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>


        <!-- penutup isi -->
        
        <?php include "footer.php"; ?>
    </body>
</html>