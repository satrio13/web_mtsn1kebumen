<?php
$judul = isset($_POST['submit']) ? $this->input->post('judul', TRUE) : $data->judul;
$keterangan = isset($_POST['submit']) ? $this->input->post('keterangan', TRUE) : $data->keterangan;
$link = isset($_POST['submit']) ? $this->input->post('link', TRUE) : $data->link;
?>
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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/video'); ?>">Video</a></li>
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
              if($this->session->flashdata('msg-video'))
              {
                echo pesan_sukses($this->session->flashdata('msg-video'));
              }elseif($this->session->flashdata('msg-gagal-video'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-video'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open('backend/edit-video/'.$this->uri->segment('3'), 'id="form"'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JUDUL VIDEO <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="judul" maxlength="100" value="<?= $judul; ?>" class="form-control required" placeholder="JUDUL VIDEO">
                            <?php echo form_error('judul'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KETERANGAN VIDEO</label>
                        <div class="col-sm-6">
                            <textarea name="keterangan" class="form-control" maxlength="200" placeholder="KETERANGAN VIDEO"><?= $keterangan; ?></textarea>
                            <?php echo form_error('keterangan'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KODE VIDEO DARI YOUTUBE <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="link" maxlength="100" value="<?= $link; ?>" class="form-control required" placeholder="KODE VIDEO DARI YOUTUBE">
                            <?php echo form_error('link'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">CONTOH DETAIL</label>
                        <div class="col-sm-6">
                            <img src="<?= base_url("assets/img/foto/youtube.jpg"); ?>" class="img img-fluid">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <span class="text-danger"><b>*</b></span>) Field Wajib Diisi
                        </div>
                    </div>
                </div>
                    <div class="card-footer">
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> SIMPAN</button>
                  <a href="<?= base_url('backend/video'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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
