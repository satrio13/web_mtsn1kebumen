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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/agenda'); ?>">Agenda</a></li>
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
              if($this->session->flashdata('msg-agenda'))
              {
                echo pesan_sukses($this->session->flashdata('msg-agenda'));
              }elseif($this->session->flashdata('msg-gagal-agenda'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-agenda'));
              }
            ?> 
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/tambah-agenda','id="form"'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA AGENDA <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_agenda" maxlength="100" value="<?= set_value('nama_agenda'); ?>" class="form-control required" placeholder="NAMA AGENDA">
                            <?php echo form_error('nama_agenda'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">BERAPA HARI <span class="text-danger">*</span></label>
                        <div class="col-sm-2">
                            <select name="berapa_hari" class="form-control required" id="berapa_hari">
                                <option value="1" <?= set_select('berapa_hari',1); ?> >1 Hari</option>
                                <option value="2" <?= set_select('berapa_hari',2); ?> >Lebih dari 1 hari</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="tgl1" <?php if($berapa_hari == 2){ ?> style="display:none" <?php }else{ } ?> >
                        <label class="col-sm-2 col-form-label">TANGGAL <span class="text-danger">*</span></label>
                        <div class="col-sm-2">
                            <input type='date' name='tgl' class='form-control required' value="<?= set_value('tgl'); ?>">
                        </div>
                    </div>
                    <div class="form-group row" id="tgl_mulai" <?php if($berapa_hari == 2){ }else{ ?> style="display:none" <?php } ?> >
                        <label class="col-sm-2 col-form-label">TANGGAL MULAI <span class="text-danger">*</span></label>
                        <div class="col-sm-2">
                            <input type='date' name='tgl_mulai' class='form-control required' value="<?= set_value('tgl_mulai'); ?>">
                        </div>
                    </div>
                    <div class="form-group row" id="tgl_selesai" <?php if($berapa_hari == 2){ }else{ ?> style="display:none" <?php } ?> >
                        <label class="col-sm-2 col-form-label">TANGGAL SELESAI <span class="text-danger">*</span></label>
                        <div class="col-sm-2">
                            <input type='date' name='tgl_selesai' class='form-control required' value="<?= set_value('tgl_selesai'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JAM <span class="text-danger">*</span></label>
                        <div class="col-sm-2">
                            <input type='time' name='jam_mulai' class='form-control required' value="<?= set_value('jam_mulai'); ?>">
                            <?php echo form_error('jam_mulai'); ?>
                        </div>s.d.
                        <div class="col-sm-2">
                            <input type='time' name='jam_selesai' class='form-control required' value="<?= set_value('jam_selesai'); ?>">
                            <?php echo form_error('jam_selesai'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TEMPAT <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="tempat" maxlength="100" value="<?= set_value('tempat'); ?>" class="form-control required" placeholder="NAMA TEMPAT">
                            <?php echo form_error('tempat'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KETERANGAN</label>
                        <div class="col-sm-8">
                            <textarea class="textarea" name="keterangan"><?= set_value('keterangan'); ?></textarea>
                            <?php echo form_error('keterangan'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">GAMBAR</label>
                        <div class="col-sm-5">
                            <img class='img-responsive' id='preview_gambar' width='150px'>
                            <input type='file' name='gambar' id="file-upload" accept='image/png, image/jpeg' class='form-control' onchange='readURL(this);'>
                            <small style="color: red"> *) format file JPG/PNG ukuran maksimal 1 MB</small>
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
                  <a href="<?= base_url('backend/agenda'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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