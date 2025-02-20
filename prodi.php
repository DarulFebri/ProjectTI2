<?php

require "koneksi.php";

?>

<div class="card">
  <div class="card-header bg-success text-light">
    Data Prodi
  </div>
  <div class="card-body">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
      Tambah Data Prodi
    </button>
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr class="text-center">
          <th scope="col">No</th>
          <th scope="col">Nama Prodi</th>
          <th scope="col">Jenjang</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>

      <?php
      //persiapan menampilkan data
      $no = 1;
      $tampil = mysqli_query($koneksi, "SELECT * FROM prodi ORDER BY id_prodi ASC");
      while ($data = mysqli_fetch_array($tampil)) :
      ?>
        <tr class="text-center">
          <td><?= $no++ ?></td>
          <td><?= $data['nama_prodi'] ?></td>
          <td><?= $data['jenjang'] ?></td>
          <td><?= $data['keterangan'] ?></td>

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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Prodi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" action="proses-prodi.php">
                <input type="hidden" name="id_prodi" value="<?= $data['id_prodi'] ?>">
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label">Nama Prodi</label>
                    <input type="text" class="form-control" name="tnama" value="<?= $data['nama_prodi'] ?>">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Jenjang</label>
                    <select class="form-select" name="tjenjang">
                      <option value="<?= $data['jenjang'] ?>"><?= $data['jenjang'] ?></option>
                      <option value="D2">D2</option>
                      <option value="D3">D3</option>
                      <option value="D4">D4</option>
                      <option value="S1">S1</option>
                      <option value="S2">S2</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea class="form-control" rows="3" name="tketerangan"><?= $data['keterangan'] ?></textarea>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success" name="bubah">Ubah</button>
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
              <form method="POST" action="proses-prodi.php">
                <input type="hidden" name="id_prodi" value="<?= $data['id_prodi'] ?>">
                <div class="modal-body text-center">
                  <h5>Apakah anda yakin menghapus data ini?</h5>
                  <h5><span class="text-danger"><b><?= $data['nama_prodi'] ?></b></span></h5>
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
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Prodi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="proses-prodi.php">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama Prodi</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Prodi" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Jenjang</label>
                <select class="form-select" name="jenjang" required>
                  <option value="">-Pilih Jenjang-</option>
                  <option value="D2">D2</option>
                  <option value="D3">D3</option>
                  <option value="D4">D4</option>
                  <option value="S1">S1</option>
                  <option value="S2">S2</option>

                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" rows="3" name="keterangan" placeholder="Masukan Keterangan" required></textarea>
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