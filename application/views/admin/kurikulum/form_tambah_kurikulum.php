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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/kurikulum'); ?>">Kurikulum</a></li>
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
              if($this->session->flashdata('msg-kurikulum'))
              {
                echo pesan_sukses($this->session->flashdata('msg-kurikulum'));
              }elseif($this->session->flashdata('msg-gagal-kurikulum'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-kurikulum'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open('backend/tambah-kurikulum','id="form"'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">MATA PELAJARAN <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="mapel" maxlength="50" value="<?= set_value('mapel'); ?>" class="form-control required" placeholder="NAMA MATA PELAJARAN">
                            <?php echo form_error('mapel'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KELOMPOK <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <select name="kelompok" class="form-control required">
                                <option value="A" <?= set_select('kelompok','A'); ?> >A</option>
                                <option value="B" <?= set_select('kelompok','B'); ?> >B</option>
                                <option value="C" <?= set_select('kelompok','C'); ?> >C</option>
                            </select>
                            <?php echo form_error('kelompok'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NO URUT <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="number" name="no_urut" value="<?= set_value('no_urut'); ?>" min="0" onkeypress="return hanyaAngka(event)" class="form-control required" placeholder="NO URUT">
                            <?php echo form_error('no_urut'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ALOKASI WAKTU <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="number" name="alokasi" value="<?= set_value('alokasi'); ?>" min="0" onkeypress="return hanyaAngka(event)" class="form-control required" placeholder="ALOKASI WAKTU">
                            <?php echo form_error('alokasi'); ?>
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
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> SIMPAN</button>
                  <a href="<?= base_url('backend/kurikulum'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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