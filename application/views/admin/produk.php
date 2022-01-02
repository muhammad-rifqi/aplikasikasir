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
                                        <th class="align-middle" width="2%">No</th>
                                        <th class="align-middle" width="20%">Nama Produk</th>
                                        <th class="align-middle" width="9%">Harga</th>
                                        <th class="align-middle" width="9%">Stok</th>
                                        <th class="align-middle" width="10%">Kode Produk</th>
                                        <th class="align-middle" width="20%">Foto</th>
                                        <th class="align-middle" width="10%">Tanggal Produk</th>
                                        <th class="align-middle" width="8%">Jumlah</th>
                                        <th class="align-middle" width="10%">Aksi</th>
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
                                            <td align="center">Rp.&nbsp;<?=number_format($produk[$a]['harga'],0,"",".")?></td>
                                            <td align="center"><?=$produk[$a]['stok']?></td>
                                            <td align="center">#p<?=$produk[$a]['kode_produk']?></td>
                                            <td><img src="<?= $produk[$a]['foto']?>" class="img-fluid" width="100%"></td>
                                            <td align="center"><?= $this->libs->ymdhis2dMonthy($produk[$a]['tanggal_update'])?></td>
                                            <td align="center"><input type="text" id="jml<?=$a?>" value="" size="2" required></td>
                                            <td align="center">
                                            <?php 
                                            if($produk[$a]['stok'] > 0){
                                            ?>
                                                <a href="#" onclick="update_harga(<?= $produk[$a]['id_produk'] ?>,<?=$a?>)"
                                                    class="btn btn-success btn-sm">
                                                    <i class="far fa-times-circle"></i> Exit Item
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?= base_url('auth/hapus_produk/'.$produk[$a]['id_produk']); ?>"
                                                    onclick="return confirm('Yakin Mau Hapus data ini ??')"
                                                    class="hapus btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a> 
                                                <a href="#"
                                                    class="btn btn-secondary mt-2 btn-sm">
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
                    title: "Sukses",
                    text: "Anda berhasil exit item produk !",
                    icon: "success",
                }).then(function() {
                    window.location="<?= base_url('auth/produk')?>";
                });
            }else{
                swal({
                    title: "Peringatan",
                    text: "Jumlah diisi dengan angka!",
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