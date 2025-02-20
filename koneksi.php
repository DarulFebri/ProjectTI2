<?php
    //Konfigurasi koneksi ke database
    $host = "localhost";      // nama host server database
    $user =  "root";          // Username untuk database
    $password = "";           // Password untuk database
    $database = "akademik"; // Nama database yang akan diakses

    //Membuat koneksi ke database
    $koneksi = mysqli_connect($host, $user, $password, $database);

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>