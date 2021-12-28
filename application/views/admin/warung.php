<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title; ?></h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header d-flex">
                    <h4>List Warung</h4>
                    <div class="ml-auto pr-2">
                        <a href=" <?php echo base_url('auth/tambah_warung'); ?>" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                  </div>
                  <div class="card-body">
                  <?= $this->session->flashdata('message');?>
                    <div class="table-responsive">
                      <table class="table table-bordered table-md">
                        <tr class="bg-primary text-white text-center ">
                          <th class="align-middle">No</th>
                          <th class="align-middle"  width="10%">Nama Warung</th>
                          <th class="align-middle">Pajak Perhari</th>
                          <th class="align-middle">Total Terjual</th>
                          <th class="align-middle">Tanggal</th>
                          <th class="align-middle">Keterangan</th>
                          <th width="20%">Foto</th>
                          <th class="align-middle">Alamat</th>
                          <th class="align-middle" width="7%">Kontak</th>
                          <th class="align-middle" width="7%">Aksi</th>
                        </tr>
                        <?php if(count($warung)>0) : ?>	
                        <tbody>
                        <?php
                            $no=1;
                            $jumlah = count($warung);
				            for($a=0;$a<$jumlah;$a++){

		                ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?= $warung[$a]['nama_warung'] ?></td>
                                <td>Rp.&nbsp;<?=number_format($warung[$a]['pajak_perhari'],0,"",",")?></td>
                                <td>Rp.&nbsp;<?=number_format($warung[$a]['total_terjual'],0,"",",")?></td>
                                <td><?= $this->libs->ymdhis2dMonthy($warung[$a]['tanggal'])?></td>
                                <td><?=$warung[$a]['keterangan']?></td>
                                <td><img src="<?= $warung[$a]['foto']?>" class="img-fluid img-thumbnai" width="100%" ></td>
                                <td><?=$warung[$a]['alamat']?></td>
                                <td><?=$warung[$a]['kontak']?></td>
                                <td>
                                <a href="<?= base_url('auth/hapus_warung/'.$warung[$a]['id']); ?>"  onclick="return confirm('Yakin Mau Hapus data ini ??')" class="hapus btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </a> 
                                <a  href="<?= base_url('auth/edit_warung/'.$warung[$a]['id']); ?>"class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a> 
                                </td>
                            </tr>
                            <?php
					            $no++;
				                    }
		                    ?>
                        </tbody>
                        <?php else:?>
                    <tfoot>
                    <tr>
                        <th colspan="10">
                            <div class="alert alert-danger text-center m-1 p-2" role="alert">- Data tidak ditemukan -</div>
                        </th>
                    </tr>
                    </tfoot>
                    <?php endif;?>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <?php echo $this->pagination->create_links(); ?>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </section>
      </div>
     
  