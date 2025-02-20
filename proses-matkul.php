<?php
include "koneksi.php";

//Tombol simpan

if (isset($_POST['bsimpan'])) {

    //persiapan simpan data
    $kode_mk = $_POST['kode'];
    $nama_mk = $_POST['nama'];
    $sks = $_POST['sks'];
    $prodi_id = $_POST['prodi'];
    $smt = $_POST['smt'];

    $cek_kode = mysqli_query($koneksi, "SELECT kode_mk FROM matkul WHERE kode_mk='$kode_mk'");

    if (mysqli_num_rows($cek_kode) > 0) {
        echo "<script>alert('NIM sudah terdaftar!');window.location='index.php?page=matkul';</script>";
        exit();
    }

    $simpan = mysqli_query($koneksi, "INSERT INTO matkul (kode_mk, nama_mk, sks, prodi_id, semester) VALUES ('$kode_mk', '$nama_mk', '$sks', '$prodi_id', '$smt')");


    if ($simpan) {
        echo "<script>alert('Data Berhasil Disimpan!');window.location='index.php?page=matkul';</script>";
    } else {
        echo "<script>alert('Data Gagal di Simpan');window.location='index.php?page=matkul';</script>";
    }
}

if (isset($_POST['bubah'])) {

    //persiapan simpan data
    $kode_mk = $_POST['kode'];
    $nama_mk = $_POST['nama'];
    $sks = $_POST['sks'];
    $prodi_id = $_POST['prodi'];
    $smt = $_POST['smt'];

    $ubah = mysqli_query($koneksi, "UPDATE matkul SET kode_mk='$kode_mk', nama_mk='$nama_mk', sks='$sks', prodi_id='$prodi_id', semester='$smt' WHERE kode_mk='$kode_mk'");

    if ($ubah) {
        echo "<script>alert('Simpan Data Berhasil!');window.location='index.php?page=matkul';</script>";
    } else {
        echo "<script>alert('Data Gagal di Simpan'); window.location='index.php?page=matkul';</script>";
    }
}

if (isset($_POST['bhapus'])) {

    //persiapan simapan data
    $kode_mk = $_POST['kode'];
    $hapus = mysqli_query($koneksi, "DELETE FROM matkul WHERE kode_mk = '$kode_mk'");

    if ($hapus) {
        echo "<script>alert('Data Berhasil di Hapus!'); window.location='index.php?page=matkul';</script>";
    } else {
        echo "<script>alert('Data Gagal di Hapus'); window.location='index.php?page=matkul';</script>";
    }
}
