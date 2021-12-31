<link rel="stylesheet" type="text/css" href="<?= base_url('assets/dist/Chart.min.css');?>">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript" src="<?= base_url('assets/dist/Chart.min.js');?>"> </script>

<script>
 $.getJSON("<?= base_url();?>/api-warung", function( data ) {
   
    var labels =[];
    var data_pajak =[];

    $(data).each(function(i){         
        labels.push(data[i].nama_warung); 
        data_pajak.push(data[i].pajak_hari_ini);
    });  

   
    var ctx = document.getElementById('pajakChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
                labels: labels,
                datasets: [{
                    label: "Data Pajak Per/Hari",
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                data: data_pajak
              },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });  
});
</script>


<div class="main-content">
    <section class="section">
        <div class="section-header d-flex">
            <h1><?= $title; ?></h1>
            <div class="ml-auto ">
                <form method="post" action="<?= base_url('auth/pajak')?>">
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
                            <h4>List Grafik Pajak</h4>
                        </div>
                        <div class="card-body">
                        <canvas id="pajakChart"></canvas>
                        </div>
                        <div class="card-footer text-right">
                           Data Pajak Per/Hari
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex">
                            <h4>List Table Pajak</h4>
                        </div>
                        <div class="card-body">

                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Warung</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Total Barang</th>
                                <th scope="col">Pajak Hari Ini</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jumlah = count($pajak);
                                $no=1;
                                for($i=0;$i<$jumlah;$i++){
                                $hasil = (10/100) * $pajak[$i]['total_harga']; 
                                ?>
                                <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $pajak[$i]['nama_warung']?></td>
                                <td><?= $pajak[$i]['total_harga']?></td>
                                <td><?= $pajak[$i]['jumlah_barang']?></td>
                                <td><?= $hasil; ?></td>
                                </tr>
                                <?php 
                                $no++;
                                }
                                ?>
                            </tbody>
                            </table>
                        </div>


                        </div>
                        <div class="card-footer text-right">
                           Data Pajak Per/Warung
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </section>
</div>