<?php
$nama_ekstrakurikuler = isset($_POST['submit']) ? $this->input->post('nama_ekstrakurikuler', TRUE) : $data->nama_ekstrakurikuler;
$keterangan = isset($_POST['submit']) ? $this->input->post('keterangan', TRUE) : $data->keterangan;
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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/ekstrakurikuler'); ?>">Ekstrakurikuler</a></li>
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
            if($this->session->flashdata('msg-ekstrakurikuler'))
            {
                echo pesan_sukses($this->session->flashdata('msg-ekstrakurikuler'));
            }elseif($this->session->flashdata('msg-gagal-ekstrakurikuler'))
            {
                echo pesan_gagal($this->session->flashdata('msg-gagal-ekstrakurikuler'));
            }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/edit-ekstrakurikuler/'.$this->uri->segment('3'), 'id="form"'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA EKSTRAKURIKULER <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_ekstrakurikuler" maxlength="100" value="<?= $nama_ekstrakurikuler; ?>" class="form-control required" placeholder="NAMA EKSTRAKURIKULER">
                            <?php echo form_error('nama_ekstrakurikuler'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KETERANGAN</label>
                        <div class="col-sm-8">
                            <textarea class="textarea" name="keterangan"><?= $keterangan; ?></textarea>
                            <?php echo form_error('keterangan'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">GAMBAR</label>
                        <div class="col-sm-5">
                            <?php if(empty($data->gambar)){ ?>
                                <img class='img-responsive' id='preview_gambar' width='150px'>
                            <?php }else{ ?>
                                <img class='img-responsive' id='preview_gambar' width='150px' src="<?= base_url(); ?>assets/img/ekstrakurikuler/<?= $data->gambar; ?>">
                            <?php } ?>
                            <input type='file' name='gambar' id="file-upload" accept='image/png, image/jpeg' class='form-control' onchange='readURL(this);'>
                            <small style="color: red"> *) format file JPG/PNG ukuran maksimal 1 MB</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <label class="form-check-label" for="exampleCheck2">*) Field Wajib Diisi</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm" onclick="return VerifyUploadSizeIsOK()"><i class="fa fa-check"></i> SIMPAN</button>
                  <a href="<?= base_url('backend/ekstrakurikuler'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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
