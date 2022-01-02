
<!-- <script src="<?= base_url('assets/'); ?>js/jquery.maskMoney.min.js" type="text/javascript"></script>
<script>
 $(document).ready(function() {
    $(".money").maskMoney({ thousands:'.', decimal:',', affixesStay: false, precision: 0});
 }); -->
<!-- </script> -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-md-6 col-sm-12 col-lg-6 offset-lg-3">
                <div class="card">
                  <?=form_open_multipart('auth/proses_ubah_warung', 'class="needs-validation" novalidate=""') ?>
                  <input type="hidden" name="id" value="<?= $warung[0]['id'] ?>">
                    <div class="card-header">
                      <h4>Form Warung</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nama_warung">Nama Warung</label>
                        <input id="nama_warung" name="nama_warung" type="text" class="form-control" value="<?= $warung[0]['nama_warung'] ?>" placeholder="Masukan nama warung" required="">
                        <div class="invalid-feedback">
                          Nama Warung harus di isi
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label for="pajak_perhari">Pajak Perhari</label>
                        <input id="pajak_perhari" name="pajak_perhari" class="form-control money" value="<?= $warung[0]['pajak_perhari'] ?>" type="number" required="">
                        <div class="invalid-feedback">
                            Pajak Perhari harus di isi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="total_terjual">Total Terjual</label>
                        <input id="total_terjual" name="total_terjual" class="form-control money" type="number" value="<?= $warung[0]['total_terjual'] ?>" required="">
                        <div class="invalid-feedback">
                            Total Terjual harus di isi
                        </div>
                      </div> -->
                      <div class="form-group">
                        <label for="tanggal">Tanggal Daftar</label>
                        <input id="tanggal" name="tanggal" type="date" class="form-control" value="<?= $warung[0]['tanggal'] ?>" required="">
                        <div class="invalid-feedback">
                          Tanggal harus di isi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukan keterangan" required=""><?= $warung[0]['keterangan'] ?></textarea>
                        <div class="invalid-feedback">
                          Keterangan harus diisi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto</label> <br>
                        <img src="<?= $warung[0]['foto']?>" class="img-fluid img-thumbnai pb-3" width="50%" >
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto">
                            <label for="foto" class="custom-file-label">Masukan foto</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Masukan alamat" required=""><?= $warung[0]['alamat'] ?></textarea>
                        <div class="invalid-feedback">
                          Alamat harus diisi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <textarea id="kontak" name="kontak" class="form-control" placeholder="Masukan kontak" required=""><?= $warung[0]['kontak'] ?></textarea>
                        <div class="invalid-feedback">
                          Kontak harus diisi
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <a href="<?= base_url('auth/warung'); ?>" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                      <button class="btn btn-primary">Ubah <i class="fa fa-upload" aria-hidden="true"></i></button>
                    </div>
                  </form>
                </div>
              </div>
              
            </div>
          </div>
    </section>
</div>



