<section>
  <div class="bg-theme p-1"></div>
  <footer class="pt-3 footer mt-auto py-3" id="contact">
    <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6 mb-3"> 
            <img src="<?= base_url(); ?>assets/img/logo/<?= logo_web(); ?>" class="img img-fluid" style="object-fit:contain; max-height:70px;"><hr>
            <h5><b>SOSIAL MEDIA KAMI</b></h5>
            <?php 
            if(is_url(facebook()))
            {
              echo'<a href="'.facebook().'" title="facebook" class="btn bg-primary text-white btn-radius mr-2" target="_blank"><i class="fa fa-facebook-square"></i></a>';
            }else
            {
              echo'<a href="javascript:void(0)" title="facebook" class="btn bg-primary text-white btn-radius mr-2"><i class="fa fa-facebook-square"></i></a>';
            } 

            if(is_url(twitter()))
            { 
              echo'<a href="'.twitter().'" title="twitter" class="btn bg-info text-white btn-radius mr-2" target="_blank"><i class="fa fa-twitter"></i></a>';
            }else
            {
              echo'<a href="javascript:void(0)" title="twitter" class="btn bg-info text-white btn-radius mr-2"><i class="fa fa-twitter"></i></a>';
            }

            if(is_url(instagram()))
            {
              echo'<a href="'.instagram().'" title="instagram" class="btn bg-secondary text-white btn-radius mr-2" target="_blank"><i class="fa fa-instagram"></i></a>';
            }else
            { 
              echo'<a href="javascript:void(0)" title="instagram" class="btn bg-secondary text-white btn-radius mr-2"><i class="fa fa-instagram"></i></a>';
            }

            if(is_url(youtube()))
            {
              echo'<a href="'.youtube().'" title="youtube" class="btn bg-danger text-white btn-radius mr-2" target="_blank"><i class="fa fa-youtube"></i></a>';
            }else
            {
              echo'<a href="javascript:void(0)" title="youtube" class="btn bg-danger text-white btn-radius mr-2"><i class="fa fa-youtube"></i></a>';
            }
            ?>
          </div>
            
            <div class="col-lg-5 col-md-6 col-sm-6 mb-3">
              <h5 class="footer-title p-1"><b>HUBUNGI KAMI</b></h5>
                <div>
                  <?= alamat(); ?>
                </div>
                <div class="mt-2">
                  <i class="fa fa-envelope"></i> <?php 
                                                  if(is_email(email()))
                                                  {
                                                    echo'<a href="mailto:'.email().'" class="text-dark">'.email().'</a>';
                                                  }else
                                                  {
                                                    echo'<a href="javascript:void(0)" class="text-dark">'.email().'</a>';
                                                  }
                                                  ?>
                </div>
                <div class="mt-2">
                  <i class="fa fa-phone"></i> <?= telp(); ?>
                </div>
                <div class="mt-2">
                  <i class="fa fa-whatsapp"></i> <?= whatsapp(); ?>
                </div>
            </div>
          
            <div class="col-lg-3 col-md-6 col-sm-6 text-dark mb-3">
            <ul class="list-group border">
            <?php 
              $pengunjung       = $this->home_model->pengunjung()->num_rows();
              $totalpengunjung  = $this->home_model->totalpengunjung()->row_array();
              $hits             = $this->home_model->hits()->row_array();
              $pengunjungonline = $this->home_model->pengunjungonline()->num_rows(); 
            ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Pengunjung Online
                <span class="badge badge-primary badge-pill"><?= $pengunjungonline; ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Pengunjung Hari Ini
                <span class="badge badge-primary badge-pill"><?= $pengunjung; ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Hits Hari Ini
                <span class="badge badge-primary badge-pill"><?= $hits['total']; ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
              <i class="fa fa-users"></i> Total Pengunjung
                <span class="badge badge-primary badge-pill"><?= $totalpengunjung['total']; ?></span>
              </li>
            </ul>
            </div>
          </div>      
        </div>
  </footer>
  <div class="bg-theme" style="margin-top:-20px">
    <div class="container pt-2 pb-2">
      <div class="col-md-12 text-white text-center">
        <b><?php 
          $tahun = '2019';
          $tahun_sekarang = date('Y');
          if($tahun_sekarang > $tahun){ ?>
            Copyright &copy; <?= $tahun; ?> - <?= $tahun_sekarang; ?> <a href="javascript:void(0)" class="text-decoration-none text-white"><?= title(); ?></a>
          <?php }else{ ?>
            Copyright &copy; <?= $tahun_sekarang; ?> <a href="javascript:void(0)" class="text-decoration-none text-white"><?= title(); ?></a>
          <?php } ?>
        </b>
      </div>
    </div>
  </div>
</section>
<script src="<?= base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
<script src="<?= base_url(); ?>assets/bootstrap-4.4.1/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/select2/select2.min.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.0.2/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>assets/AdminLTE-3.0.2/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url(); ?>assets/owl-carousel/js/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.magnific-popup.js"></script>
<script>var base_url = '<?= base_url() ?>';</script>
<script src="<?= base_url(); ?>assets/js/jquery.validate.js"></script>
<script src="<?= base_url(); ?>assets/js/preloader.js"></script>
<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5df617ef992cd008"></script>