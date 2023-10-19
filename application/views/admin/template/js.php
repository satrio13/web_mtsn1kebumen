  <footer class="main-footer">
    <strong> 
      <?php
      $tahun_dibuat = '2019';
      $tahun_sekarang = date('Y');
      if($tahun_dibuat < $tahun_sekarang)
      {
        echo'&copy '.$tahun_dibuat.' - '.$tahun_sekarang.' ';  
      }else
      {
        echo'&copy '.$tahun_sekarang.' ';
      }
      ?>
      <a href="javascript:void(0)"><?= title(); ?></a>
    </strong>
    <div class="float-right d-none d-sm-inline-block text-danger">time execution: <?= $this->benchmark->elapsed_time(); ?> | memory usage: <?= $this->benchmark->memory_usage(); ?>
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>  
<script src="<?= base_url(); ?>assets/AdminLTE-3.0.2/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.0.2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.0.2/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.0.2/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.0.2/dist/js/adminlte.js"></script>
<script src="<?= base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.0.2/plugins/summernote/summernote-bs4.min.js"></script>
<script>var base_url = '<?= base_url() ?>';</script>
<script src="<?= base_url(); ?>assets/js/jquery.validate.js"></script>