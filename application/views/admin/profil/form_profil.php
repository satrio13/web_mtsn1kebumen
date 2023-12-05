<?php
$nama_web = isset($_POST['submit']) ? $this->input->post('nama_web', TRUE) : $data->nama_web;
$jenjang = isset($_POST['submit']) ? $this->input->post('jenjang', TRUE) : $data->jenjang;
$meta_description = isset($_POST['submit']) ? $this->input->post('meta_description', TRUE) : $data->meta_description;
$meta_keyword = isset($_POST['submit']) ? $this->input->post('meta_keyword', TRUE) : $data->meta_keyword;
$profil = isset($_POST['submit']) ? $this->input->post('profil', TRUE) : $data->profil;
$alamat = isset($_POST['submit']) ? $this->input->post('alamat', TRUE) : $data->alamat;
$email = isset($_POST['submit']) ? $this->input->post('email', TRUE) : $data->email;
$telp = isset($_POST['submit']) ? $this->input->post('telp', TRUE) : $data->telp;
$fax = isset($_POST['submit']) ? $this->input->post('fax', TRUE) : $data->fax;
$whatsapp = isset($_POST['submit']) ? $this->input->post('whatsapp', TRUE) : $data->whatsapp;
$akreditasi = isset($_POST['submit']) ? $this->input->post('akreditasi', TRUE) : $data->akreditasi;
$kurikulum = isset($_POST['submit']) ? $this->input->post('kurikulum', TRUE) : $data->kurikulum;
$nama_kepsek = isset($_POST['submit']) ? $this->input->post('nama_kepsek', TRUE) : $data->nama_kepsek;
$nama_operator = isset($_POST['submit']) ? $this->input->post('nama_operator', TRUE) : $data->nama_operator;
$instagram = isset($_POST['submit']) ? $this->input->post('instagram', TRUE) : $data->instagram;
$facebook = isset($_POST['submit']) ? $this->input->post('facebook', TRUE) : $data->facebook;
$twitter = isset($_POST['submit']) ? $this->input->post('twitter', TRUE) : $data->twitter;
$youtube = isset($_POST['submit']) ? $this->input->post('youtube', TRUE) : $data->youtube;
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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/profil-web'); ?>">Profil Website</a></li>
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
              if($this->session->flashdata('msg-profil'))
              {
                echo pesan_sukses($this->session->flashdata('msg-profil'));
              }elseif($this->session->flashdata('msg-gagal-profil'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-profil'));
              }
            ?> 
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open('backend/edit-profil-web','id="form"'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA SEKOLAH / MADRASAH <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_web" maxlength="100" value="<?= $nama_web; ?>" class="form-control required" placeholder="NAMA WEBSITE">
                            <?php echo form_error('nama_web'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JENJANG <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="jenjang" class="form-control required">
                                <option value="1" <?php if($jenjang == 1){ echo'selected'; } ?> >SMP</option>
                                <option value="2" <?php if($jenjang == 2){ echo'selected'; } ?> >SMA</option>
                                <option value="3" <?php if($jenjang == 3){ echo'selected'; } ?> >MTs</option>
                                <option value="4" <?php if($jenjang == 4){ echo'selected'; } ?> >MAN</option>
                            </select>
                            <?php echo form_error('jenjang'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">META DESCRIPTION <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <textarea name="meta_description" maxlength="300" class="form-control required"><?= $meta_description; ?></textarea>
                            <?php echo form_error('meta_description'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">META KEYWORD <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="meta_keyword" maxlength="200" value="<?= $meta_keyword; ?>" class="form-control required" placeholder="META KEYWORD">
                            <?php echo form_error('meta_keyword'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">PROFIL</label>
                        <div class="col-sm-8">
                            <textarea name="profil" class="textarea"><?= $profil; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ALAMAT <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <textarea name="alamat" maxlength="300" class="form-control required"><?= $alamat; ?></textarea>
                            <?php echo form_error('alamat'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">EMAIL <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="email" name="email" maxlength="100" value="<?= $email; ?>" class="form-control required" placeholder="EMAIL">
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TELP <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="telp" maxlength="20" value="<?= $telp; ?>" class="form-control required" placeholder="TELP">
                            <?php echo form_error('telp'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">FAX <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="fax" maxlength="20" value="<?= $fax; ?>" class="form-control required" placeholder="FAX">
                            <?php echo form_error('fax'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">WHATSAPP</label>
                        <div class="col-sm-8">
                            <input type="text" name="whatsapp" maxlength="20" value="<?= $whatsapp; ?>" class="form-control" placeholder="WHATSAPP">
                            <?php echo form_error('whatsapp'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">AKREDITASI</label>
                        <div class="col-sm-5">
                            <input type="text" name="akreditasi" maxlength="2" value="<?= $akreditasi; ?>" class="form-control" placeholder="AKREDITASI">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KURIKULUM <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="kurikulum" maxlength="30" value="<?= $kurikulum; ?>" class="form-control required" placeholder="KURIKULUM">
                            <?php echo form_error('kurikulum'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA KEPSEK / KAMAD <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="nama_kepsek" maxlength="100" value="<?= $nama_kepsek; ?>" class="form-control required" placeholder="NAMA KEPSEK">
                            <?php echo form_error('nama_kepsek'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA OPERATOR <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="nama_operator" maxlength="100" value="<?= $nama_operator; ?>" class="form-control required" placeholder="NAMA OPERATOR">
                            <?php echo form_error('nama_operator'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">INSTAGRAM</label>
                        <div class="col-sm-8">
                            <input type="url" name="instagram" maxlength="200" value="<?= $instagram; ?>" class="form-control" placeholder="INSTAGRAM">
                            <?php echo form_error('instagram'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">FACEBOOK</label>
                        <div class="col-sm-8">
                            <input type="url" name="facebook" maxlength="200" value="<?= $facebook; ?>" class="form-control" placeholder="FACEBOOK">
                            <?php echo form_error('facebook'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TWITTER</label>
                        <div class="col-sm-8">
                            <input type="url" name="twitter" maxlength="150" value="<?= $twitter; ?>" class="form-control" placeholder="TWITTER">
                            <?php echo form_error('twitter'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">YOUTUBE</label>
                        <div class="col-sm-8">
                            <input type="url" name="youtube" maxlength="150" value="<?= $youtube; ?>" class="form-control" placeholder="YOUTUBE">
                            <?php echo form_error('youtube'); ?>
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
