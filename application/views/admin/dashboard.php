  <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-header">
         <h1><?= $title; ?></h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="fas fa-store"></i></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Warung</h4>
                  </div>
                  <div class="card-body">
                    <?= $warung;?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-download"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Barang Masuk</h4>
                  </div>
                  <div class="card-body">
                  <?= $bm;?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-upload"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Barang Keluar</h4>
                  </div>
                  <div class="card-body">
                  <?= $bk;?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pajak Warung</h4>
                  </div>
                  <div class="card-body">
                    <?= count($pajak); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="section-body">
        </div>
    </section>
</div>