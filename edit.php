<!-- proses penyimpanan -->


<?php 

    include "koneksi.php";

    // baca id data yang akan di edit
    $id = $_GET['id'];
    
    // baca data karyawan berdasarkan id
    $cari = mysqli_query($konek, "SELECT * FROM karyawan WHERE id = '$id'");
    $hasil = mysqli_fetch_array($cari);

    // jika tombol simpan di klik
    if(isset($_POST['btnSimpan'])){
        $noKartu = $_POST['nokartu'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];

        $simpan = mysqli_query($konek, "UPDATE karyawan set nokartu='$noKartu', nama='$nama', alamat='$alamat' WHERE id='$id'");

        // jika berhasil tersimpan, tampilkan pesan
        if($simpan) {
            echo "
                <script>
                    alert('tersimpan');
                    location.replace('datakaryawan.php');
                </script>
            
            ";
        } else {
            echo "
                <script>
                    alert('tersimpan');
                    location.replace('datakaryawan.php');
                </script>
    
            ";
        }
    }






?>





<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Edit Data Karyawan</title>
    </head>
    <body>
        <?php include "menu.php"; ?>

        <!-- bagian isi -->
        <div class="container-fluid">
            <h3>Tambah Data Karyawan</h3>

            <form method="POST">
                <div class="form-group">
                    <label>No. Kartu</label>
                    <input type="text" name="nokartu" id="nokartu" placeholder="no kartu RFID" class="form-control" style="width:200px" value="<?= $hasil['nokartu']; ?>">
                </div>

                <div class="form-group">
                    <label>Nama Karyawan</label>
                    <input type="text" name="nama" id="nama" placeholder="nama karyawan" class="form-control" style="width:200px" value="<?= $hasil['nama']; ?>">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea type="text" name="alamat" id="alamat" placeholder="alamat karyawan" class="form-control" style="width:400px"><?= $hasil['alamat']; ?></textarea>
                </div>

                <button class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
            </form>
           

        </div>

        <!-- penutup isi -->
        
        <?php include "footer.php"; ?>
    </body>
</html>