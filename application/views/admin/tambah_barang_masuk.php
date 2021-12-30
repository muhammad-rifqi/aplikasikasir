

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="section-body">
            <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-6 offset-lg-3">
                <div class="card">
                  <?=form_open_multipart('auth/proses_tambah_barang_masuk', 'class="needs-validation" novalidate=""') ?>
                    <div class="card-header">
                      <h4>Form Barang Masuk</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nama_warung">Nama Warung</label>
                        <select name="nama_warung" class="form-control" required="">
                          <option value="--">Pilih Nama Warung</option>
                          <?php
                            $j = count($warung);
                            for($i=0;$i<$j;$i++){
                                echo"<option value=".$warung[$i]['id'].">".$warung[$i]['nama_warung']."</option>";
                            }
                          ?>

                        </select>
                        <div class="invalid-feedback">
                          warung harus diisi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input id="nama_produk" name="nama_produk" placeholder="Masukan Nama Produk" class="form-control" type="text" required="">
                        <div class="invalid-feedback">
                          Nama Produk harus diisi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="harga">Harga</label>
                        <input id="harga" name="harga" class="form-control" type="text" placeholder="Masukan Harga" required="">
                        <div class="invalid-feedback">
                          Harga harus diisi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="stok">Stok</label>
                        <input id="stok" name="stok" type="number" class="form-control" placeholder="Masukan Stok" required="">
                        <div class="invalid-feedback">
                          Stok harus diisi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukan keterangan" required=""></textarea>
                        <div class="invalid-feedback">
                          Keterangan harus diisi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto" required="">
                            <label for="foto" class="custom-file-label">Masukan foto</label>
                            <br>
                            <div class="invalid-feedback">
                              foto harus diisi
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <a href="<?= base_url('auth/barang_masuk'); ?>" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                      <button class="btn btn-primary" type="submit">Tambah <i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                  </form>
                </div>
              </div>
              
            </div>
          </div>
    </section>
</div>



