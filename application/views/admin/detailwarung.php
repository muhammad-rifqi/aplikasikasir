<style>
.account-settings .user-profile {
    margin: 0 0 1rem 0;
    padding-bottom: 1rem;
    text-align: center;
}

.account-settings .user-profile .user-avatar {
    margin: 0 0 1rem 0;
}

.account-settings .user-profile .user-avatar img {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}

.account-settings .user-profile h5.user-name {
    margin: 0 0 0.5rem 0;
}

.account-settings .user-profile h6.user-email {
    margin: 0;
    font-size: 0.8rem;
    font-weight: 400;
    color: #9fa8b9;
}

.account-settings .about {
    margin: 2rem 0 0 0;
    text-align: center;
}

.account-settings .about h5 {
    margin: 0 0 15px 0;
    color: #007ae1;
}

.account-settings .about p {
    font-size: 0.825rem;
}

.form-control {
    border: 1px solid #cfd1d8;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: .825rem;
    background: #ffffff;
    color: #2e323c;
}

.card {
    background: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 0;
    margin-bottom: 1rem;
}
</style>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Warung</h4>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">

                                        <div class="container">
                                            <div class="row gutters">
                                                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                                    <div class="card h-100">
                                                        <div class="card-body">
                                                            <div class="account-settings">
                                                                <div class="user-profile">
                                                                    <div class="user-avatar">
                                                                        <img src="<?= $warung[0]['foto'] ?>"
                                                                            alt="Maxwell Admin" width="100%">
                                                                    </div>
                                                                    <br>
                                                                    <h5 class="user-name"><?= $warung[0]['nama_warung'] ?></h5>
                                                                    <h6 class="user-email">admin@localhost.com</h6>
                                                                </div>
                                                                <div class="about">
                                                                    <h5>About</h5>
                                                                    <p><?= $warung[0]['keterangan'] ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                                    <div class="card h-100">
                                                        <div class="card-body">
                                                            <div class="row gutters">
                                                                <div
                                                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                    <h6 class="mb-2 text-primary">Detail Warung</h6>
                                                                </div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="fullName">Nama Warung</label>
                                                                        <input type="text" class="form-control"
                                                                            id="fullName" name="name"
                                                                            value="<?= $warung[0]['nama_warung'] ?>"
                                                                            style="border:none; border-bottom:1px solid #000;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="eMail">Email</label>
                                                                        <input type="email" class="form-control"
                                                                            id="eMail" name="email"
                                                                            value="admin@localhost.com"
                                                                             style="border:none;border-bottom:1px solid #000;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="phone">Phone</label>
                                                                        <input type="text" class="form-control"
                                                                            id="phone" placeholder="Enter phone number" value="0987654321" style="border:none;border-bottom:1px solid #000;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="website">Website URL</label>
                                                                        <input type="url" class="form-control"
                                                                            id="website" value="http://smarttakalar.com" style="border:none;border-bottom:1px solid #000;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row gutters">
                                                                <div
                                                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                    <h6 class="mt-3 mb-2 text-primary">Alamat</h6>
                                                                </div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="Street">Jalan</label>
                                                                        <input type="text" class="form-control"
                                                                            id="alamat" value="<?= $warung[0]['alamat'] ?>" style="border:none;border-bottom:1px solid #000;">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="ciTy">Keterangan</label>
                                                                        <input type="text" class="form-control"
                                                                            id="keterangan" value="<?= $warung[0]['keterangan'] ?>" style="border:none;border-bottom:1px solid #000;">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="zIp">Kontak</label>
                                                                        <input type="text" class="form-control"
                                                                            id="kontak" value="<?= $warung[0]['kontak'] ?>" style="border:none;border-bottom:1px solid #000;">
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row gutters">
                                                                <div
                                                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                    <div class="text-right">
                                                                        <button type="button" id="button" 
                                                                            class="btn btn-warning" onclick="window.history.back()">Kembali</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>