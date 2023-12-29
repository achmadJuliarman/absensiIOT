<!DOCTYPE html>
<html>
    <head>
        <?php include "header.php"; ?>
        <title>Scan Kartu</title>

        <!-- scanning membaca kartu rfid -->

        <script type="text/javascript">
            $(document).ready(function(){
                setInterval(function() {
                    $('#cekkartu').load('bacakartu.php')
                }, 1000); // pembacaan file nokartu.php, tiap 1 detik = 1000
            });
        </script>

    </head>
    <body>
        <?php include "menu.php"; ?>

        <!-- bagian isi -->
        <div class="container-fluid" style="padding-top:10%">
            <div class="container-fluid">
                <div id="cekkartu"></div>
            </div>
        </div>

        <!-- penutup isi -->
        
        <?php include "footer.php"; ?>
    </body>
</html>