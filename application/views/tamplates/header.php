<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/'); ?>img/Lambang_Kabupaten_Takalar.png">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/components.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   
    
  
    
</head>
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
         
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url('assets/'); ?>img/default.png" class="rounded-circle mr-1">
            <!-- <img alt="image" src="<?=base_url('assets/img/') . $this->session->userdata('foto');?>" class="rounded-circle mr-1"> -->
            <div class="d-sm-none d-lg-inline-block"><?=$this->session->userdata('username')?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div> -->
              <a href="<?= base_url('auth/logout')?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="login-brand">
            <a href=""><img alt="image" src="<?= base_url('assets/'); ?>img/Lambang_Kabupaten_Takalar.png" width="35%"></a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="<?= isset($dashboard_active)?$dashboard_active:''; ?>"><a class="nav-link" href="<?= base_url('auth/dashboard')?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
              <li class="menu-header">Menu</li>
              <?php if($this->session->userdata('status') == 'admin'){?>
              <li class="<?= isset($warung_active)?$warung_active:''; ?>"><a class="nav-link" href="<?= base_url('auth/warung')?>"><i class="fas fa-store"></i></i> <span>Warung</span></a></li>
              <li class="<?= $this->uri->segment(2) == 'pajak' ? 'active' : '' ; ?>"><a class="nav-link" href="<?= base_url('auth/pajak')?>"><i class="fas fa-chart-bar"></i> <span>Pajak</span></a></li>
              <li class="<?= $this->uri->segment(2) == 'barang_masuk'|| $this->uri->segment(2) == 'tambah_barang_masuk' ? 'active' : '' ; ?>"><a class="nav-link" href="<?= base_url('auth/barang_masuk')?>"><i class="fas fa-download"></i></i> <span>Barang Masuk</span></a></li>
              <li class="<?= $this->uri->segment(2) == 'produk' ? 'active' : '' ; ?>"><a class="nav-link" href="<?= base_url('auth/produk')?>"><i class="fas fa-shopping-bag"></i> <span>Produk</span></a></li>
              <li class="<?= $this->uri->segment(2) == 'transaksi' ? 'active' : '' ; ?>"><a class="nav-link" href="<?= base_url('auth/transaksi')?>"><i class="fas fa-shopping-cart"></i> <span>View Transaksi</span></a></li>
              <li class="<?= $this->uri->segment(2) == 'barang_keluar' ? 'active' : '' ; ?>"><a class="nav-link" href="<?= base_url('auth/barang_keluar')?>"><i class="fas fa-upload"></i> <span>Barang Keluar</span></a></li>
              <!-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                  <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                  <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
              </li> -->
              <?php }else {?>
              <li class="<?= $this->uri->segment(2) == 'barang_masuk'|| $this->uri->segment(2) == 'tambah_barang_masuk' ? 'active' : '' ; ?>"><a class="nav-link" href="<?= base_url('auth/barang_masuk')?>"><i class="fas fa-download"></i></i> <span>Barang Masuk</span></a></li>
              <li class="<?= $this->uri->segment(2) == 'produk' ? 'active' : '' ; ?>"><a class="nav-link" href="<?= base_url('auth/produk')?>"><i class="fas fa-shopping-cart"></i> <span>Produk</span></a></li>
              <li class="<?= $this->uri->segment(2) == 'transaksi' ? 'active' : '' ; ?>"><a class="nav-link" href="<?= base_url('auth/transaksi')?>"><i class="fas fa-shopping-cart"></i> <span>View Transaksi</span></a></li>
              <li class="<?= $this->uri->segment(2) == 'barang_keluar' ? 'active' : '' ; ?>"><a class="nav-link" href="<?= base_url('auth/barang_keluar')?>"><i class="fas fa-upload"></i> <span>Barang Keluar</span></a></li>
              <?php } ?>
            </ul>

            </div>
        </aside>
      </div>