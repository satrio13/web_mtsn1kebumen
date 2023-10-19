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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/banner'); ?>">Banner Web</a></li>
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
              if($this->session->flashdata('msg-banner'))
              {
                echo pesan_sukses($this->session->flashdata('msg-banner'));
              }elseif($this->session->flashdata('msg-gagal-banner'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-banner'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/tambah-banner','id="form"'); ?>
                <div class="card-body">
                    <div class="callout callout-danger">
                    <h5>REKOMENDASI UKURAN GAMBAR UNTUK BANNER ADALAH LANDSCAPE ( 1024px X 600px )</h5>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">GAMBAR <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <img class='img-responsive' id='preview_gambar' width='150px'>
                            <input type='file' name='gambar' id="file-upload" accept='image/png, image/jpeg' class='form-control' onchange='readURL(this);' required>
                            <small style="color: red"> *) format file JPG/PNG ukuran maksimal 1 MB</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JUDUL</label>
                        <div class="col-sm-8">
                            <input type="text" name="judul" maxlength="100" value="<?= set_value('judul'); ?>" class="form-control" placeholder="JUDUL">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KETERANGAN</label>
                        <div class="col-sm-8">
                            <input type="text" name="keterangan" maxlength="200" value="<?= set_value('keterangan'); ?>" class="form-control" placeholder="KETERANGAN">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">LINK</label>
                        <div class="col-sm-8">
                            <input type="text" name="link" maxlength="300" value="<?= set_value('link'); ?>" class="form-control" placeholder="LINK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TULISAN TOMBOL</label>
                        <div class="col-sm-5">
                            <input type="text" name="button" maxlength="30" value="<?= set_value('button'); ?>" class="form-control" placeholder="TULISAN TOMBOL">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">STATUS AKTIF <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="is_active" value="1" id="radioPrimary1" <?= set_radio('is_active',1); ?> required> 
                                <label for="radioPrimary1">Aktif</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="is_active" value="0" id="radioPrimary2" <?= set_radio('is_active',0); ?> required> 
                                <label for="radioPrimary2">Non Aktif</label>
                            </div>
                            <br><label for="is_active" class="error"></label>
                            <?php echo form_error('is_active'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <span class="text-danger"><b>*</b></span>) Field Wajib Diisi                     
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm" onclick="return VerifyUploadSizeIsOK()"><i class="fa fa-check"></i> SIMPAN</button>
                  <a href="<?= base_url('backend/banner'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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