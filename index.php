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

<!-- KARYAWAN DENGAN ABSENSI TERBANYAK -->
<div class="container grafik-wrapper">
    <div class="card">
        <div class="card-header">
            Karyawan dengan Absensi Terbanyak
        </div>
        <div class="card-body">
            <ul class="list-group">
                <?php 
                $sql_absen_terbanyak = mysqli_query($konek, 
                    "SELECT k.nama, COUNT(a.nokartu) as jumlah_absensi
                    FROM absensi a
                    JOIN karyawan k ON a.nokartu = k.nokartu
                    GROUP BY a.nokartu
                    ORDER BY jumlah_absensi DESC
                    LIMIT 1;");
                $row = mysqli_fetch_assoc($sql_absen_terbanyak);
                echo '<li class="list-group-item">' . $row['nama'] . '</li>';
                ?>
            </ul>
        </div>
    </div>
</div>
<!-- END KARYAWAN DENGAN ABSENSI TERBANYAK -->

<!-- GRAFIK ABSENSI KESLURUHAN PEGAWAI -->
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
                    <?php foreach ($data as $d){ echo "'".$d['nama']."',"; } ?>
                ],
                datasets: [{
                    label: 'Keseluruhan',
                    data: [
                        <?php foreach ($data as $d){ echo (int)$d['jumlah'].","; } ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
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
<!-- END GRAFIK ABSESNSI KESELURUHAN -->

<!-- penutup isi -->

<?php include "footer.php"; ?>
</body>
</html>