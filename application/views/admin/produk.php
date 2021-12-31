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
                            <h4>List Produk</h4>
                            
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
                                        <th class="align-middle">Kode Produk</th>
                                        <th class="align-middle">Foto</th>
                                        <th class="align-middle">Tanggal Produk</th>
                                        <th class="align-middle">#</th>
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
                                            <td>&nbsp;<?=number_format($produk[$a]['stok'],0,"",".")?></td>
                                            <td>#p<?=$produk[$a]['kode_produk']?></td>
                                            <td><img src="<?= $produk[$a]['foto']?>" class="img-fluid" width="100"></td>
                                            <td><?= $this->libs->ymdhis2dMonthy($produk[$a]['tanggal_update'])?></td>
                                            <td><input type="text" id="jml<?=$a?>" value="" size="1" required></td>
                                            <td>
                                            <?php 
                                            if($produk[$a]['stok'] > 0){
                                            ?>
                                                <a href="#" onclick="update_harga(<?= $produk[$a]['id_produk'] ?>,<?=$a?>)"
                                                    class="btn btn-success btn-sm">
                                                    Exit Item
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?= base_url('auth/hapus_produk/'.$produk[$a]['id_produk']); ?>"
                                                    onclick="return confirm('Yakin Mau Hapus data ini ??')"
                                                    class="hapus btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a> 
                                                <a href="#"
                                                    class="btn btn-danger btn-sm">
                                                    Stok Habis
                                                </a>
                                            <?php } ?>
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
function update_harga(e,t){
    let hr = new XMLHttpRequest();
    let url = "<?= base_url('auth/update_harga')?>";
    let jml = document.getElementById("jml"+t).value;
    let id = e;
    let vars = "jumlah="+jml+"&id_produk="+id;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    let return_data = hr.responseText;
            if(return_data == "success"){
                swal({
                    title: "Alert",
                    text: return_data,
                    icon: "success",
                }).then(function() {
                    window.location="<?= base_url('auth/produk')?>";
                });
            }else{
                swal({
                    title: "Alert",
                    text: return_data,
                    icon: "error",
                }).then(function() {
                    window.location="<?= base_url('auth/produk')?>";
                });

            }

	    }else{
            swal({
                title: hr.status,
                text: 'Failed',
                icon: "error",
            }).then(function() {
                window.location="<?= base_url('auth/produk')?>";
            });
        }
    }
    hr.send(vars); 
}
</script>