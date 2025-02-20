<?php

require "koneksi.php";

?>

<div class="card">
  <div class="card-header bg-success text-light">
    Data Mata Kuliah
  </div>
  <div class="card-body">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
      Tambah Data Mata Kuliah
    </button>
    <table class="table table-bordered table-striped table-hover">
      <thead class="text-center">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kode Mata Kuliah</th>
          <th scope="col">Nama Mata Kuliah</th>
          <th scope="col">SKS</th>
          <th scope="col">Prodi</th>
          <th scope="col">Semester</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>

      <?php
      //persiapan menampilkan data
      $no = 1;
      $tampil = mysqli_query($koneksi, "SELECT matkul.*,prodi.nama_prodi FROM matkul LEFT JOIN prodi ON matkul.prodi_id=prodi.id_prodi ORDER BY kode_mk ASC");
      while ($data = mysqli_fetch_array($tampil)) :
      ?>
        <tr class="text-center">
          <td><?= $no++ ?></td>
          <td><?= $data['kode_mk'] ?></td>
          <td><?= $data['nama_mk'] ?></td>
          <td><?= $data['sks'] ?></td>
          <td><?= $data['nama_prodi'] ?></td>
          <td><?= $data['semester'] ?></td>

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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Mata Kuliah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" action="proses-matkul.php">
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label">Kode Mata Kuliah</label>
                    <input type="text" class="form-control" name="kode" value="<?= $data['kode_mk'] ?>" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Mata Kuliah</label>
                    <input type="text" class="form-control" name="nama" value="<?= $data['nama_mk'] ?>" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">SKS</label>
                    <input type="number" class="form-control" name="sks" value="<?= $data['sks'] ?>" required>
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
                  <div class="mb-3">
                    <label class="form-label">Semester</label>
                    <input type="number" class="form-control" name="smt" value="<?= $data['semester'] ?>" required>
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
              <form method="POST" action="proses-matkul.php">
                <input type="hidden" name="kode" value="<?= $data['kode_mk'] ?>">
                <div class="modal-body text-center">
                  <h5>Apakah anda yakin menghapus data ini?</h5>
                  <h5><span class="text-danger"><b><?= $data['nama_mk'] ?></b></span></h5>
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
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Mata Kuliah</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="proses-matkul.php">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Kode Mata Kuliah</label>
                <input type="text" class="form-control" name="kode" placeholder="Masukan Kode Mata Kuliah" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Mata Kuliah" required>
              </div>
              <div class="mb-3">
                <label class="form-label">SKS</label>
                <input type="number" class="form-control" name="sks" placeholder="Masukan SKS" required>
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
              <div class="mb-3">
                <label class="form-label">Semester</label>
                <input type="number" class="form-control" name="smt" placeholder="Masukan Semester" required>
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