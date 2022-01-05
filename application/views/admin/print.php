
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Print Transaksi</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: letter }</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="letter">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
                            <table width="100%" border=1 cellpadding=4 cellspacing=0>
                                    <tr bgcolor="silver">
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Item</th>
                                        <th>#</th>
                                        <th>Keterangan</th>
                                        <th>Foto</th>
                                        <th>Tanggal Transaksi</th>
                                    </tr>
                                   
                                        <?php
                                        $no=1;
                                            $total=0;
                                            $jumlah = count($transaksi);
                                            for($a=0;$a<$jumlah;$a++){
                                                $total +=($transaksi[$a]['harga'] * $transaksi[$a]['jumlah']);
                                        ?>
                                        <tr >
                                            <td><?=$no?></td>
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
                                        $no++;
				                            }
		                                ?>
                                </table>
                                <p align="right"> <b><?= $total; ?></b> </p>
  </section>

</body>

</html>
