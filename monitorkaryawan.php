<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Monitor Absensi</title>
    </head>
    <body>
        <?php include "menu.php"; ?>

        <!-- bagian isi -->
        <div class="container-fluid">

            <?php 
            include "koneksi.php";
            $id = $_GET['id'];

            $sql = mysqli_query($konek, "SELECT nama, tanggal, jam_masuk, jam_istirahat, jam_kembali, jam_pulang
            FROM karyawan
            INNER JOIN absensi ON karyawan.nokartu = absensi.nokartu WHERE karyawan.id = '$id'");

            $sql2 = mysqli_query($konek, "SELECT nama FROM karyawan WHERE karyawan.id = '$id'");
            $nama = mysqli_fetch_array($sql2);

            
            ?>
            <h3>Data <?= $nama['nama']; ?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: grey; color: white;">
                        <th style="width: 10px; text-align: center">No.</th>
                        <th style="text-align: center">Tanggal</th>
                        <th style="text-align: center">Jam Masuk</th>
                        <th style="text-align: center">Jam Istirahat</th>
                        <th style="text-align: center">Jam Kembali</th>
                        <th style="text-align: center">Jam Pulang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 0;
                        while($data = mysqli_fetch_array($sql)) {
                            $no++;

                    ?>
                    <tr>
                        <td> <?= $no; ?> </td>
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