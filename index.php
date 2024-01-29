<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Menu Utama</title>
    </head>
    <body>
        <?php include_once "koneksi.php"; ?>
        <?php include "menu.php"; ?>

        <!-- bagian isi -->
        <div class="container-fluid" style="padding-top: 10%; text-align:center">
            <h1>
                Selamat Datang <br>
                SISTEM ABSENSI KARYAWAN <br>
                BERBASIS KARTU RFID
            </h1>
        </div>

        <!-- GRAFIK ABSENSI KESLURUHA PEGAWAI -->
        <div class="container grafik-wrapper">
            <div>
              <canvas id="grafikAbsensi"></canvas>
            </div>

            <?php 
            $sql = mysqli_query($konek, 
                "SELECT a.nokartu, k.nama, COUNT(a.nokartu) as jumlah
                FROM absensi a
                JOIN karyawan k
                ON a.nokartu = k.nokartu GROUP BY nokartu;");
            $data = mysqli_fetch_all($sql, MYSQLI_ASSOC); 
            ?>
            <script>
              const ctx = document.getElementById('grafikAbsensi');

              new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: [
                    <?php 
                    foreach ($data as $d){ 
                        echo "'".$d['nama']."'";
                        echo ",";
                    } 
                    ?>
                    ],
                  datasets: [{
                    label: '# of Votes',
                    data: [
                    <?php 
                    foreach ($data as $d){ 
                        echo (int)$d['jumlah'];
                        echo ",";
                    } 
                    ?>
                    ],
                    backgroundColor: [
                      'rgba(255, 99, 132, 0.8)',
                      'rgba(255, 159, 64, 0.8)',
                      'rgba(255, 205, 86, 0.8)',
                      'rgba(75, 192, 192, 0.8)',
                      'rgba(54, 162, 235, 0.8)',
                      'rgba(153, 102, 255, 0.8)',
                      'rgba(201, 203, 207, 0.8)'
                    ],
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
              });
            </script>
            </div>
        </div>
        <!-- END GRAFIK ABSESNSI KESELURUHAN -->

        <!-- penutup isi -->
        
        <?php include "footer.php"; ?>
    </body>
</html>