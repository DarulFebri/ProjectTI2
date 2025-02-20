<?php
require "koneksi.php";

//Tombol simpan

if (isset($_POST['bsimpan'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $prodi_id = $_POST['prodi'];

    // Cek apakah file diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto'];
        $fileName = $foto['name'];
        $fileTemp = $foto['tmp_name'];
        $upload_dir = "upload/";

        // Pindahkan file ke direktori tujuan
        move_uploaded_file($fileTemp, $upload_dir . $fileName);

        // Simpan data ke database termasuk nama file
        $simpan = mysqli_query($koneksi, "INSERT INTO dosen (nip, nama_dosen, prodi_id, foto) VALUES ('$nip', '$nama', '$prodi_id', '$fileName')");
    } else {
        // Tangani jika file tidak diunggah dengan benar
        echo "<script>alert('Foto tidak diunggah!'); window.location='index.php?page=dosen'</script>";
    }

    if ($simpan) {
        echo "<script>alert('Simpan Data Berhasil!'); window.location='index.php?page=dosen'</script>";
    } else {
        echo "<script>alert('Data Gagal di Simpan'); window.location='index.php?page=dosen'</script>";
    }
}


//Tombol Ubah
if (isset($_POST['bubah'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $prodi_id = $_POST['prodi'];

    // Cek apakah file diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto'];
        $fileName = $foto['name'];
        $fileTemp = $foto['tmp_name'];
        $upload_dir = "upload/";

        // Pindahkan file ke direktori tujuan
        move_uploaded_file($fileTemp, $upload_dir . $fileName);

        // Simpan data ke database termasuk nama file
        $simpan = mysqli_query($koneksi, "UPDATE dosen SET nama_dosen='$nama', prodi_id='$prodi_id', foto='$fileName'where nip='$nip'");
    } else {
        // Tangani jika file tidak diunggah dengan benar
        echo "<script>alert('Foto tidak diunggah!'); window.location='index.php?page=dosen'</script>";
    }

    if ($simpan) {
        echo "<script>alert('Simpan Data Berhasil!'); window.location='index.php?page=dosen'</script>";
    } else {
        echo "<script>alert('Data Gagal di Simpan'); window.location='index.php?page=dosen'</script>";
    }
}


//Tombol Hapus

if (isset($_POST['bhapus'])) {
    $nip = $_POST['nip'];

    $hapus = mysqli_query($koneksi, "DELETE FROM dosen WHERE nip='$nip'");

    if ($hapus) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='index.php?page=dosen'</script>";
    } else {
        echo "<script>alert('Data gagal dihapus.'); window.location='index.php?page=dosen'</script>";
    }
}

