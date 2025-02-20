<?php

require "koneksi.php";

?>

<div class="card">
  <div class="card-header bg-success text-light">
    Data Dosen
  </div>
  <div class="card-body">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
      Tambah Data Dosen
    </button>
    <table class="table table-bordered table-striped table-hover">
      <thead class="text-center">
        <tr>
          <th scope="col">No</th>
          <th scope="col">NIP</th>
          <th scope="col">Nama</th>
          <th scope="col">Prodi yang Diajar</th>
          <th scope="col">Foto</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>

      <?php
      //persiapan menampilkan data
      $no = 1;
      $tampil = mysqli_query($koneksi, "SELECT dosen.*,prodi.nama_prodi FROM dosen LEFT JOIN prodi ON dosen.prodi_id=prodi.id_prodi ORDER BY nip ASC");
      while ($data = mysqli_fetch_array($tampil)) :
      ?>
        <tr class="text-center">
          <td><?= $no++ ?></td>
          <td><?= $data['nip'] ?></td>
          <td><?= $data['nama_dosen'] ?></td>
          <td><?= $data['nama_prodi'] ?></td>
          <td><img src="upload/<?= htmlspecialchars($data['foto']) ?>" alt="Foto" class="img-fluid rounded" style="width: 250px; height: auto;"></td>
          <td>
            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no ?>">Ubah</a>
            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no?>">Hapus</a>
          </td>
        </tr>

        <!-- Modal Ubah -->
        <div class="modal fade modal-lg" id="modalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Dosen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" action="proses-dosen.php" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label">NIP Dosen</label>
                    <input type="number" class="form-control" name="nip" value="<?= $data['nip'] ?>" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Dosen</label>
                    <input type="text" class="form-control" name="nama" value="<?= $data['nama_dosen'] ?>" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Prodi Yang Diajar</label>
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
                    <label class="form-label">Foto Dosen</label>
                    <input type="file" class="form-control" name="foto" accept="image/*" value="<?= $data['foto'] ?>" required>
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
              <form method="POST" action="proses-dosen.php">
                <input type="hidden" name="nip" value="<?= $data['nip'] ?>">
                <div class="modal-body text-center">
                  <h5>Apakah anda yakin menghapus data ini?</h5>
                  <h5><span class="text-danger"><b><?= $data['nama_dosen'] ?></b></span></h5>
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
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Dosen</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="proses-dosen.php" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">NIP Dosen</label>
                <input type="number" class="form-control" name="nip" placeholder="Masukan NIP Anda" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Nama Dosen</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Anda" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Prodi Yang Diajar</label>
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
                <label for="foto" class="form-label">Foto Dosen</label>
                <input type="file" class="form-control" name="foto" accept="image/*" required>
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