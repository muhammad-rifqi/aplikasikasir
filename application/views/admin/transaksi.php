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
                            <h4>Data Transaksi</h4>
                            
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
                                        <th class="align-middle" width="9%">#</th>
                                        <th class="align-middle" width="20%">Keterangan</th>
                                        <th class="align-middle" width="20%">Foto</th>
                                        <th class="align-middle" width="10%">Tanggal Keluar</th>
                                    </tr>
                                    <?php if(count($transaksi)>0) : ?>
                                    <tbody >
                                        <?php
                            $total=0;
                            $jumlah = count($transaksi);
				            for($a=0;$a<$jumlah;$a++){
                                $total +=($transaksi[$a]['harga'] * $transaksi[$a]['jumlah']);
		                ?>
                                        <tr >
                                            <td><?=++$page?></td>
                                            <td><?= $transaksi[$a]['nama_produk'] ?></td>
                                            <td align="center">Rp.&nbsp;<?=number_format($transaksi[$a]['harga'],0,"",".")?></td>
                                            <td align="center"><?= $transaksi[$a]['jumlah']?></td>
                                            <td align="center">Rp.<?= number_format(($transaksi[$a]['harga'] * $transaksi[$a]['jumlah']),0,"",".")?></td>
                                            <td><?=$transaksi[$a]['keterangan']?></td>
                                            <td><img src="<?= $transaksi[$a]['foto']?>" class="img-fluid"
                                                    width="100%"></td>
                                            <td align="center"><?= $this->libs->ymdhis2dMonthy($transaksi[$a]['tanggal_update'])?></td>
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
                                <p align="right"><b> Total Harga Semua Barang : <?= empty($total) ? "0" : 'Rp. '.number_format($total,0,"","."); ?></b></p>
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