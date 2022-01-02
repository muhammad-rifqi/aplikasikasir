<div class="main-content">
    <section class="section">
        <div class="section-header d-flex">
            <h1><?= $title; ?></h1>
            <div class="ml-auto ">
                <form method="post" action="<?= base_url('auth/barang_keluar')?>">
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
                            <h4>List Barang Keluar</h4>
                            
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message');?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr class="bg-primary text-white text-center ">
                                        <th class="align-middle" width="2%">No</th>
                                        <th class="align-middle" width="16%">Nama Produk</th>
                                        <th class="align-middle" width="9%">Harga</th>
                                        <th class="align-middle" width="9%">Item</th>
                                        <th class="align-middle" width="20%">Keterangan</th>
                                        <th class="align-middle" width="20%">Foto</th>
                                        <th class="align-middle" width="10%">Tanggal Keluar</th>
                                        <th class="align-middle" width="7%">Aksi</th>
                                    </tr>
                                    <?php if(count($barang_keluar)>0) : ?>
                                    <tbody >
                                        <?php
                         
                            $jumlah = count($barang_keluar);
				            for($a=0;$a<$jumlah;$a++){
		                ?>

                                        <tr >
                                            <td><?=++$page?></td>
                                            <td><?= $barang_keluar[$a]['nama_produk'] ?></td>
                                            <td align="center">Rp.&nbsp;<?=number_format($barang_keluar[$a]['harga'],0,"",".")?></td>
                                            <td align="center"><?= $barang_keluar[$a]['jumlah']?></td>
                                            <td><?=$barang_keluar[$a]['keterangan']?></td>
                                            <td><img src="<?= $barang_keluar[$a]['foto']?>" class="img-fluid"
                                                    width="100%"></td>
                                            <td align="center"><?= $this->libs->ymdhis2dMonthy($barang_keluar[$a]['tanggal_update'])?></td>
                                            <td>
                                                <a href="<?= base_url('auth/hapus_barang_keluar/'.$barang_keluar[$a]['id_barang_keluar']); ?>"
                                                    onclick="return confirm('Yakin Mau Hapus data ini ??')"
                                                    class="hapus btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
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