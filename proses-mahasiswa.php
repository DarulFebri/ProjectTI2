<?php
include "koneksi.php";

//Tambah Data
if (isset($_POST['bsimpan'])) {

    //persiapan simpan data
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nim = $_POST['nim'];
    $gender = $_POST['gender'];
    $hobi = $_POST['hobi'];
    $alamat = $_POST['alamat'];
    $id_prodi = $_POST['prodi'];

    $cek_nim = mysqli_query($koneksi, "SELECT nim FROM mahasiswa WHERE nim='$nim'");

    if (mysqli_num_rows($cek_nim) > 0) {
        echo "<script>alert('NIM sudah terdaftar!');window.location='index.php?page=mahasiswa&aksi=create'</script>";
        exit();
    }

    $simpan = mysqli_query($koneksi, "INSERT INTO mahasiswa (nama_mhs, email, nim, gender, hobi, alamat, prodi_id) VALUES ('$nama', '$email', '$nim', '$gender', '$hobi', '$alamat', '$id_prodi')");

    if ($simpan) {
        echo "<script>alert('Simpan Data Berhasil!'); window.location='index.php?page=mahasiswa';</script>";
    } else {
        echo "<script>alert('Data Gagal di Simpan'); window.location='index.php?page=mahasiswa';</script>";
    }
}

//Ubah Data
if (isset($_POST['bubah'])) {

    //persiapan simpan data
    $id_mhs = $_POST['id_mhs'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nim = $_POST['nim'];
    $gender = $_POST['gender'];
    $hobi = $_POST['hobi'];
    $alamat = $_POST['alamat'];
    $id_prodi = $_POST['prodi'];

    $ubah = mysqli_query($koneksi, "UPDATE mahasiswa SET nama_mhs='$nama', email='$email', nim='$nim', gender='$gender', hobi='$hobi', alamat='$alamat', prodi_id='$id_prodi' WHERE id_mhs='$id_mhs'");

    if ($ubah) {
        echo "<script>alert('Simpan Data Berhasil!'); window.location='index.php?page=mahasiswa';</script>";
    } else {
        echo "<script>alert('Data Gagal di Simpan'); window.location='index.php?page=mahasiswa';</script>";
    }
}

//Hapus Data
if(isset($_POST['bhapus'])){
        
    //persiapan simapan data
    $id_mhs = $_POST['id_mhs'];
    $hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mhs = '$id_mhs'");
    
    if ($hapus){
        echo "<script>alert('Data Berhasil di Hapus!'); window.location='index.php?page=mahasiswa';</script>";
    }else{
        echo "<script>alert('Data Gagal di Hapus'); window.location='index.php?page=mahasiswa';</script>";
    }
} 
