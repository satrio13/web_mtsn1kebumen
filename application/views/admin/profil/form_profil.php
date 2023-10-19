<?php
if(isset($_POST['submit']))
{
  $nama_web = $this->input->post('nama_web', TRUE);
  $jenjang = $this->input->post('jenjang', TRUE);
  $meta_description = $this->input->post('meta_description', TRUE);
  $meta_keyword = $this->input->post('meta_keyword', TRUE);
  $profil = $this->input->post('profil', TRUE);
  $alamat = $this->input->post('alamat', TRUE);
  $email = $this->input->post('email', TRUE);
  $telp = $this->input->post('telp', TRUE);
  $fax = $this->input->post('fax', TRUE);
  $whatsapp = $this->input->post('whatsapp', TRUE);
  $akreditasi = $this->input->post('akreditasi', TRUE);
  $kurikulum = $this->input->post('kurikulum', TRUE);
  $nama_kepsek = $this->input->post('nama_kepsek', TRUE);
  $nama_operator = $this->input->post('nama_operator', TRUE);
  $instagram = $this->input->post('instagram', TRUE);
  $facebook = $this->input->post('facebook', TRUE);
  $twitter = $this->input->post('twitter', TRUE);
  $youtube = $this->input->post('youtube', TRUE);
}else
{
  $nama_web = $data->nama_web;
  $jenjang = $data->jenjang;
  $meta_description = $data->meta_description;
  $meta_keyword = $data->meta_keyword;
  $profil = $data->profil;
  $alamat = $data->alamat;
  $email = $data->email;
  $telp = $data->telp;
  $fax = $data->fax;
  $whatsapp = $data->whatsapp;
  $akreditasi = $data->akreditasi;
  $kurikulum = $data->kurikulum;
  $nama_kepsek = $data->nama_kepsek;
  $nama_operator = $data->nama_operator;
  $instagram = $data->instagram;
  $facebook = $data->facebook;
  $twitter = $data->twitter;
  $youtube = $data->youtube;
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