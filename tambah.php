<!-- proses penyimpanan -->


<?php 

    include "koneksi.php";

    // jika tombol simpan di klik
    if(isset($_POST['btnSimpan'])){
        $noKartu = $_POST['nokartu'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];

        $simpan = mysqli_query($konek, "INSERT INTO karyawan(nokartu, nama, alamat) VALUES ('$noKartu', '$nama', '$alamat')");

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

    //kosongkan tabel tmprfid
    mysqli_query($konek,"DELETE FROM tmprfid");
?>




<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Tambah Data</title>

        <!-- pembacaan no kartu otomatis -->
        <script type="text/javascript">
            $(document).ready(function(){
                setInterval(function() {
                    $('#norfid').load('nokartu.php')
                }, 1000); // pembacaan file nokartu.php, tiap 1 detik = 1000
            });
        </script>




        <!-- penutup -->
    </head>
    <body>
        <?php include "menu.php"; ?>

        <!-- bagian isi -->
        <div class="container-fluid">
            <h3>Tambah Data Karyawan</h3>

            <form method="POST">

                <div id="norfid"></div>

                <div class="form-group">
                    <label>Nama Karyawan</label>
                    <input type="text" name="nama" id="nama" placeholder="nama karyawan" class="form-control" style="width:200px">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea type="text" name="alamat" id="alamat" placeholder="alamat karyawan" class="form-control" style="width:400px"></textarea>
                </div>

                <button class="btn btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
            </form>
           

        </div>

        <!-- penutup isi -->
        
        <?php include "footer.php"; ?>
    </body>
</html>