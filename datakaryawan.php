<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Data Karyawan</title>
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
                        <th style="width: 200px; text-align: center">No. Kartu</th>
                        <th style="width: 400px; text-align: center">Nama</th>
                        <th style="text-align: center">Alamat</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        include "koneksi.php";
                        //baca data karyawan
                        $sql = mysqli_query($konek, "SELECT * FROM karyawan");

                        $dataPegawai = mysqli_fetch_all($sql, MYSQLI_ASSOC);
                        $no = 0;
                    foreach($dataPegawai as $dp) {
                        $no++;
                    ?>
                    <tr> 
                        <td> <?php echo $no; ?> </td>
                        <td> <?php echo $dp['nokartu']; ?></td>
                        <td> <?php echo $dp['nama']; ?></td>
                        <td> <?php echo $dp['alamat']; ?></td>
                        <?php $sqlAbsen = 
                        mysqli_query($konek,
                            "SELECT COUNT(nokartu) AS jumlah, tanggal, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun 
                            FROM absensi WHERE nokartu = '{$dp['nokartu']}' GROUP BY tahun ASC,bulan DESC;"); 
                        ?>
                        <?php $dataAbsen = mysqli_fetch_all($sqlAbsen, MYSQLI_ASSOC); ?>
                        <?php $totalAbsenBulanan = []; ?>
                        <?php $bulanAbsen = []; ?>
                        <?php foreach($dataAbsen as $da) : ?>
                            <?php
                            if (empty($da)) {
                                array_push($totalAbsenBulanan, 0);
                                echo 'kosong';
                            }else{
                                array_push($totalAbsenBulanan, $da['jumlah']);
                                array_push($bulanAbsen, $da['bulan'].' '.$da['tahun']);
                            }
                                
                            ?>
                        <?php endforeach; ?>
                        <?php 
                            $totalAbsenBulanan = implode(", ",$totalAbsenBulanan); 
                            $bulanAbsen = implode(", ",$bulanAbsen); 
                        ?>
                        <td style="text-align: center">
                            <a class="btn btn-primary" href="edit.php?id=<?php echo $dp['id']?>">
                            Edit</a> 
                            <a class="btn btn-danger" href="hapus.php?id=<?php echo $dp['id']?>">Hapus</a> 
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDetail" id="btn-detail"
                            data-nama="<?= $dp['nama']; ?>" data-nokartu="<?= $dp['nokartu']; ?>" 
                            data-alamat="<?= $dp['alamat']; ?>" data-totalabsen="<?= $totalAbsenBulanan; ?>"
                            data-bulanabsen="<?= $bulanAbsen; ?>">
                              Detail
                            </button>
                            <!-- <a class="btn btn-success" href="monitorkaryawan.php?id=<?php echo $data['id']?>">Periksa</a> -->
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <a href="tambah.php"><button class="btn btn-primary">Tambah Data Karyawan</button></a>
        </div>

        <!-- Button trigger modal -->


<!-- MODAL BOX DETAIL -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item" id="no-kartu"></li>
          <li class="list-group-item" id="nama"></li>
          <li class="list-group-item" id="alamat"></li>
        </ul>
        <div class="container">
            <div>
                <canvas id="grafik-detail-pegawai"></canvas>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL BOX DEATAIL -->

<!-- script untuk mengisi body modal box detail  -->
<script>
    let myChart;
    $(document).on('click', '#btn-detail', function() {
        const nama = $(this).data('nama');
        const noKartu = $(this).data('nokartu');
        const alamat = $(this).data('alamat');
        var totalAbsen = $(this).data('totalabsen');
        var bulanAbsen = $(this).data('bulanabsen');

        console.log(totalAbsen);
        console.log(bulanAbsen);
        if(typeof totalAbsen === 'string'){
            totalAbsen = totalAbsen.split(', ').map(Number);
        }else{
            totalAbsen = [Number(totalAbsen)];
        }

        if(bulanAbsen.search(',') != -1){
            bulanAbsen = bulanAbsen.split(', ');
        }else{
            bulanAbsen = [String(bulanAbsen)];
        }
        console.log(totalAbsen);
        console.log(bulanAbsen);
        
        $('#modalDetail .modal-title').html(nama);
        $('#modalDetail .modal-body #no-kartu').html('<b>No Kartu \t: </b>'+noKartu);
        $('#modalDetail .modal-body #nama').html('<b>Nama \t: </b>'+nama);
        $('#modalDetail .modal-body #alamat').html('<b>Alamat \t: </b>'+alamat);

        // grafik
        const ctx = document.getElementById('grafik-detail-pegawai');
        // console.log(ctx);
        if (myChart) {
            myChart.destroy();
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: bulanAbsen,
                    datasets: [{
                        label: 'Total Absensi ' + nama,
                        data: totalAbsen,
                        backgroundColor: [
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(255, 99, 132, 0.8)',
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
        } else {
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: bulanAbsen,
                    datasets: [{
                        label: 'Total Absensi ' + nama,
                        data: totalAbsen,
                        backgroundColor: [
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(255, 99, 132, 0.8)',
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
        }
        
    });


</script>
        <!-- penutup isi -->
        
        <?php include "footer.php"; ?>
    </body>
</html>