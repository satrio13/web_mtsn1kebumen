<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $title; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('backend'); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('backend/profil-web'); ?>">Profil Web</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="row">
        <div class="col-12">
            <?php 
              if($this->session->flashdata('msg-gagal-favicon'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-favicon'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/favicon'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">FAVICON WEBSITE *</label>
                        <div class="col-sm-5">
                        <?php if(empty($data->favicon)){ ?>
                            <img class='img-responsive' id='preview_gambar' width='50px'>
                        <?php }else{ ?>
                            Favicon Sekarang: <img class='img-responsive mb-2' id='preview_gambar' width='50px' src="<?= base_url(); ?>assets/img/logo/<?= $data->favicon; ?>">
                        <?php } ?>
                        <input type='file' name='favicon' accept='.ico' class='form-control' onchange='readURL(this);' required>
                        <p style="color: red"> *) format file .ico ukuran maksimal 100 Kb</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> SIMPAN</button>
                  <a href="<?= base_url('backend/profil-web'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
                </div>
              <?php echo form_close() ?>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>