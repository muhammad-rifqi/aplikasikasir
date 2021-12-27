
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
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <form class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Form Warung</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nama_warung">Nama Warung</label>
                        <input id="nama_warung" name="nama_warung" type="text" class="form-control" required="">
                        <div class="invalid-feedback">
                          Nama Warung harus di isi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="pajak_perhari">Pajak Perhari</label>
                        <input id="pajak_perhari" name="pajak_perhari" class="form-control money" type="number" value="0" required="">
                        <div class="invalid-feedback">
                            Pajak Perhari harus di isi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="total_terjual">Total Terjual</label>
                        <input id="total_terjual" name="total_terjual" class="form-control money" type="number" value="0" required="">
                        <div class="invalid-feedback">
                            Total Terjual harus di isi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input id="tanggal" name="tanggal" type="date" class="form-control" required="">
                        <div class="invalid-feedback">
                          Tanggal harus di isi
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" required=""></textarea>
                        <div class="invalid-feedback">
                          Keterangan harus diisi
                        </div>
                      </div>
                      <div class="form-group">
                      <label for="foto">Foto</label>
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto" required="">
                            <label for="foto" class="custom-file-label">Choose File</label>
                            <div class="invalid-feedback mt-2">
                                Foto harus diisi
                            </div>
                          </div>
                        
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
              
            </div>
          </div>
    </section>
</div>



