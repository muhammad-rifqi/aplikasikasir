<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?= date('Y')?> <div class="bullet"></div> Aplikasi Kasir
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>
<!-- Bootstrap core JavaScript-->

 <script src="<?= base_url('assets/'); ?>js/jquery-3.3.1.min.js"></script>
 <script src="<?= base_url('assets/'); ?>js/popper.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>

 
 <script src="<?= base_url('assets/'); ?>js/jquery.nicescroll.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url('assets/'); ?>js/moment.min.js"></script>
 <script src="<?= base_url('assets/'); ?>js/stisla.js"></script>
 
 


 <script src="<?= base_url('assets/'); ?>js/scripts.js"></script>
 <script src="<?= base_url('assets/'); ?>js/custom.js"></script>


 <script>
    $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>
 </body>

 </html>