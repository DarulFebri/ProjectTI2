<?php

require "koneksi.php";

?>

<div class="card">
    <div class="card-header bg-success text-light">
        Data Mahasiswa
    </div>
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
            Tambah Data Mahasiswa
        </button>
        <table class="table table-bordered table-striped table-hover">
            <thead class="text-center">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Hobi</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <?php
            //persiapan menampilkan data
            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT mahasiswa.*,prodi.nama_prodi FROM mahasiswa LEFT JOIN prodi ON mahasiswa.prodi_id=prodi.id_prodi ORDER BY id_mhs ASC");
            while ($data = mysqli_fetch_array($tampil)) :
            ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama_mhs'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['nim'] ?></td>
                    <td><?php echo $data['gender'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                    <td><?= $data['hobi'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['nama_prodi'] ?></td>

                    <td>
                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no ?>">Ubah</a>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
                    </td>
                </tr>

                <!-- Modal Ubah -->
                <div class="modal fade modal-lg" id="modalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Mahasiswa</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="proses-mahasiswa.php">
                                <input type="hidden" name="id_mhs" value="<?= $data['id_mhs'] ?>">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama" value="<?= $data['nama_mhs'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">NIM</label>
                                        <input type="number" class="form-control" name="nim" value="<?= $data['nim'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="gender">
                                            <option value=""><?= $data['gender'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Hobi</label>
                                        <input type="text" class="form-control" name="hobi" value="<?= $data['hobi'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" rows="3" name="alamat" value=""><?= $data['alamat'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Prodi</label>
                                        <select class="form-select" name="prodi">
                                            <option value=""><?= $data['nama_prodi'] ?></option>
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM prodi");
                                            while ($dataUbah = mysqli_fetch_array($query)) { ?>
                                                <option value="<?= $dataUbah['id_prodi'] ?>"><?= $dataUbah['nama_prodi'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="bubah">Simpan</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal -->

                <!-- Modal Hapus -->
                <div class="modal fade modal-lg" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data Prodi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="proses-mahasiswa.php">
                                <input type="hidden" name="id_mhs" value="<?= $data['id_mhs'] ?>" >
                                <div class="modal-body text-center">
                                    <h5>Apakah anda yakin menghapus data ini?</h5>
                                    <h5><span class="text-danger"><b><?= $data['nama_mhs'] ?></b></span></h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="bhapus">Hapus</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal -->

            <?php endwhile; ?>
        </table>

        <!-- Modal Tambah -->
        <div class="modal fade modal-lg" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Mahasiswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="proses-mahasiswa.php">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Anda" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukan Email Anda" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="number" class="form-control" name="nim" placeholder="Masukan NIM Anda" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="gender">
                                    <option value="">-Pilih Jenis Kelamin-</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hobi</label>
                                <input type="text" class="form-control" name="hobi" placeholder="Masukan Hobi Anda" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" rows="3" name="alamat" placeholder="Masukan Alamat Anda"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Prodi</label>
                                <select class="form-select" name="prodi">
                                    <option value="">-Pilih Prodi-</option>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM prodi");
                                    while ($data = mysqli_fetch_array($query)) { ?>
                                        <option value="<?= $data['id_prodi'] ?>"><?= $data['nama_prodi'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal -->
    </div>
</div>