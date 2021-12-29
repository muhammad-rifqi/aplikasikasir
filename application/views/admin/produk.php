<div class="main-content">
    <section class="section">
        <div class="section-header d-flex">
            <h1><?= $title; ?></h1>
            <div class="ml-auto ">
                <form method="post" action="<?= base_url('auth/produk')?>">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Search" autocomplete="off" autofocus>
                        <div class="input-group-append">
                             <input class="btn btn-primary" type="submit" name="submit" value="cari">
                             <!-- <i class="fas fa-search"></i> -->
                        </div>
                     </div>
                </form>
           </div>
        </div>   
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4>List Warung</h4>
                            <div class="ml-auto pr-2">
                                <a href=" <?php echo base_url('auth/tambah_produk'); ?>" class="btn btn-primary">
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
                                        <th class="align-middle">Nama Produk</th>
                                        <th class="align-middle">Harga</th>
                                        <th class="align-middle">Stok</th>
                                        <th class="align-middle">Keterangan</th>
                                        <th class="align-middle">Foto</th>
                                        <th class="align-middle">Tanggal Masuk</th>
                                        <th class="align-middle">Aksi</th>
                                    </tr>
                                    <?php if(count($produk)>0) : ?>
                                    <tbody >
                                        <?php
                         
                            $jumlah = count($produk);
				            for($a=0;$a<$jumlah;$a++){
		                ?>

                                        <tr >
                                            <td><?=++$page?></td>
                                            <td><?= $produk[$a]['nama_produk'] ?></td>
                                            <td>Rp.&nbsp;<?=number_format($produk[$a]['harga'],0,"",".")?></td>
                                            <td>Rp.&nbsp;<?=number_format($produk[$a]['stok'],0,"",".")?></td>
                                            <td><?=$produk[$a]['keterangan']?></td>
                                            <td><img src="<?= $produk[$a]['foto']?>" class="img-fluid"
                                                    width="30%"></td>
                                            <td><?= $this->libs->ymdhis2dMonthy($produk[$a]['tanggal_update'])?></td>
                                            <td>
                                                <a href="<?= base_url('auth/hapus_produk/'.$produk[$a]['id_produk']); ?>"
                                                    onclick="return confirm('Yakin Mau Hapus data ini ??')"
                                                    class="hapus btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                                <a href="<?= base_url('auth/edit_produk/'.$produk[$a]['id_produk']); ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="<?= base_url('auth/detail_produk/'.$produk[$a]['id_produk']); ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
				                    }
		                    ?>
                                    </tbody>
                                    <?php else:?>
                                    <tfoot>
                                        <tr>
                                            <th colspan="10">
                                                <div class="alert alert-danger text-center m-1 p-2" role="alert">- Data
                                                    tidak ditemukan -</div>
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