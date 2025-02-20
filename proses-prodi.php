<?php
    include "koneksi.php";

    //Tombol simpan

    if(isset($_POST['bsimpan'])){

        //persiapan simpan data
        $nama_prodi = $_POST['nama'];
        $jenjang = $_POST['jenjang'];
        $keterangan = $_POST['keterangan'];
        $simpan = mysqli_query($koneksi, "INSERT INTO prodi (nama_prodi, jenjang, keterangan) VALUES ('$nama_prodi', '$jenjang', '$keterangan')");

        if ($simpan){
            echo "<script>alert('Simpan Data Berhasil!'); window.location='index.php?page=prodi';</script>";
        }else{
            echo "<script>alert('Data Gagal di Simpan'); window.location='index.php?page=prodi';</script>";
        }
    }
    
     //Tombol Ubah

     if(isset($_POST['bubah'])){
        
        //persiapan simapan data
        $nama_prodi = $_POST['tnama'];
        $jenjang = $_POST['tjenjang'];
        $keterangan = $_POST['tketerangan'];
        $id_prodi = $_POST['id_prodi'];
        $ubah = mysqli_query($koneksi, "UPDATE prodi SET nama_prodi = '$nama_prodi', jenjang = '$jenjang', keterangan = '$keterangan' WHERE id_prodi = '$id_prodi'");

        if ($ubah){
            echo "<script>alert('Ubah Data Berhasil!'); window.location='index.php?page=prodi';</script>";
        }else{
            echo "<script>alert('Data Gagal di Ubah'); window.location='index.php?page=prodi';</script>";
        }
    }
    
    //Tombol Hapus

    if(isset($_POST['bhapus'])){
        
        //persiapan simapan data
        $id_prodi = $_POST['id_prodi'];
        $hapus = mysqli_query($koneksi, "DELETE FROM prodi WHERE id_prodi = '$id_prodi'");

        if ($hapus){
            echo "<script>alert('Data Berhasil di Hapus!'); window.location='index.php?page=prodi';</script>";
        }else{
            echo "<script>alert('Data Gagal di Hapus'); window.location='index.php?page=prodi';</script>";
        }
    }   
?>