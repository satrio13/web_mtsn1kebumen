<?php
if(isset($_POST['submit']))
{
  $nama = $this->input->post('nama', TRUE);
  $link = $this->input->post('link', TRUE);
  $is_active = $this->input->post('is_active', TRUE);
}else
{
  $nama = $data->nama;
  $link = $data->link;
  $is_active = $data->is_active;
}
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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/link-terkait'); ?>">Link Terkait</a></li>
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
              if($this->session->flashdata('msg-link'))
              {
                echo pesan_sukses($this->session->flashdata('msg-link'));
              }elseif($this->session->flashdata('msg-gagal-link'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-link'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open('backend/edit-link/'.$this->uri->segment('3'), 'id="form"'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA HALAMAN <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="nama" maxlength="100" value="<?= $nama; ?>" class="form-control required" placeholder="NAMA HALAMAN">
                            <?php echo form_error('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">LINK URL <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="url" name="link" value="<?= $link; ?>" class="form-control required" placeholder="LINK URL">
                            <?php echo form_error('link'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">STATUS AKTIF <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="is_active" value="1" id="radioPrimary1" <?php if($is_active == 1){ echo'checked'; } ?> > 
                                <label for="radioPrimary1">Aktif</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="is_active" value="0" id="radioPrimary2" <?php if($is_active == 0){ echo'checked'; } ?> > 
                                <label for="radioPrimary2">Non Aktif</label>
                            </div>
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
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> SIMPAN</button>
                    <a href="<?= base_url('backend/link-terkait'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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