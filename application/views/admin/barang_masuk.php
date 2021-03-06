<div class="main-content">
    <section class="section">
        <div class="section-header d-flex">
            <h1><?= $title; ?></h1>
            <div class="ml-auto ">
                <form method="post" action="<?= base_url('auth/barang_masuk')?>">
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
                            <h4>List Barang Masuk</h4>
                            <div class="ml-auto pr-2">
                                <a href=" <?php echo base_url('auth/tambah_barang_masuk'); ?>" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message');?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr class="bg-primary text-white text-center ">
                                        <th class="align-middle" width="2%">No</th>
                                        <th class="align-middle" width="10%">Nama Produk</th>
                                        <th class="align-middle" width="9%">Harga</th>
                                        <th class="align-middle" width="7%">Stok</th>
                                        <th class="align-middle" width="12%">Keterangan</th>
                                        <th class="align-middle" width="15%">Foto</th>
                                        <th class="align-middle" width="8%">Tanggal Masuk</th>
                                        <th class="align-middle" width="15%">Aksi</th>
                                    </tr>
                                    <?php if(count($barang_masuk)>0) : ?>
                                    <tbody >
                                        <?php
                         
                            $jumlah = count($barang_masuk);
				            for($a=0;$a<$jumlah;$a++){
		                ?>

                                        <tr >
                                            <td><?=++$page?></td>
                                            <td><?= $barang_masuk[$a]['nama_produk'] ?></td>
                                            <td align="center">Rp.&nbsp;<?=number_format($barang_masuk[$a]['harga'],0,"",".")?></td>
                                            <td align="center"><?= $barang_masuk[$a]['stok']?></td>
                                            <td><?=$barang_masuk[$a]['keterangan']?></td>
                                            <td><img src="<?= $barang_masuk[$a]['foto']?>" class="img-fluid" width="100%"
                                                   ></td>
                                            <td align="center"><?= $this->libs->ymdhis2dMonthy($barang_masuk[$a]['tanggal_update'])?></td>
                                            <td align="center">
                                                <a href="<?= base_url('auth/hapus_barang_masuk/'.$barang_masuk[$a]['id_barang_masuk']); ?>"
                                                    onclick="return confirm('Yakin Mau Hapus data ini ??')"
                                                    class="hapus btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                                <a href="<?= base_url('auth/edit_barang_masuk/'.$barang_masuk[$a]['id_barang_masuk']); ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button onclick="sendproduk(<?= $barang_masuk[$a]['id_barang_masuk']?>,<?= $barang_masuk[$a]['stok'] ?>)"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-paper-plane"></i> Kirim Ke Produk
                                                </button>
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

<script>
function sendproduk(e,t){
    let hr = new XMLHttpRequest();
    let url = "<?= base_url('auth/insert_to_produk')?>";
    let stok = t;
    let id_barang_masuk = e;
    let vars = "stok="+stok+"&id_barang_masuk="+id_barang_masuk;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    let return_data = hr.responseText;
            console.log(return_data);
			swal({
                title: "Send To Product Success!",
                text: return_data,
                icon: "success",
            }).then(function() {
                window.location='<?=base_url('auth/barang_masuk');?>'
            });

	    }else{
            swal({
                title: "Send To Product Failed!",
                text: 'Failed',
                icon: "error",
            }).then(function() {
                return false;
            });
        }
    }
    hr.send(vars);
   
}
</script>