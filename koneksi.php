<?php
    $konek = mysqli_connect("localhost", "root", "", "absenrfid");
    if ($konek->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>