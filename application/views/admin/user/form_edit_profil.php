<?php
if(isset($_POST['submit']))
{
  $nama = $this->input->post('nama', TRUE);
  $username = $this->input->post('username', TRUE);
  $email = $this->input->post('email', TRUE);
}else
{
  $nama = $data->nama;
  $username = $data->username;
  $email = $data->email;
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= strtoupper($title); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('backend'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
  <div class="row">
    <div class="col-md-12">
            <?php 
              if($this->session->flashdata('msg-user'))
              {
                echo pesan_sukses($this->session->flashdata('msg-user'));
              }elseif($this->session->flashdata('msg-gagal-user'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-user'));
              }
            ?>
                 <!-- Horizontal Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <?php echo form_open('backend/edit-profil','id="form"'); ?>
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NAMA <span class="text-danger">*</span></label>
                    <div class="col-sm-5">
                      <input type='text' name='nama' maxlength="100" class='form-control required' placeholder='Nama' value="<?= $nama; ?>">
                      <?php echo form_error('nama'); ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">USERNAME <span class="text-danger">*</span></label>
                    <div class="col-sm-5">
                    <input type='text' name='username' class='form-control sepasi required' minlength="5" maxlength="30" placeholder='Username' value="<?= $username; ?>" autocomplete="off"><?php echo form_error('username'); ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">EMAIL <span class="text-danger">*</span></label>
                    <div class="col-sm-5">
                    <input type='email' name='email' class='form-control sepasi required' placeholder='Email' value="<?= $email; ?>"><?php echo form_error('email'); ?>
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
                <button type="button" class='btn btn-danger btn-sm float-right' onclick='self.history.back()'><i class="fa fa-arrow-left"></i> BATAL</button>
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