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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/prestasi-siswa'); ?>">Prestasi Siswa</a></li>
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
            if($this->session->flashdata('msg-prestasi'))
            {
                echo pesan_sukses($this->session->flashdata('msg-prestasi'));
            }elseif($this->session->flashdata('msg-gagal-prestasi'))
            {
                echo pesan_gagal($this->session->flashdata('msg-gagal-prestasi'));
            }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/tambah-prestasi-siswa','id="form"'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TAHUN PELAJARAN <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="id_tahun" class="form-control required">
                                <?php foreach($tahun->result() as $r): ?>    
                                    <option value="<?= $r->id_tahun; ?>" <?= set_select('id_tahun',$r->id_tahun); ?> ><?= $r->tahun; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JENIS <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="jenis" class="form-control required">
                                <option value="1" <?= set_select('jenis',1); ?> >Akademik</option>
                                <option value="2" <?= set_select('jenis',2); ?> >Non Akademik</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA LOMBA <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="nama" maxlength="100" value="<?= set_value('nama'); ?>" class="form-control required" placeholder="NAMA LOMBA">
                            <?php echo form_error('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">PRESTASI <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="prestasi" class="form-control required">
                                <option value="1" <?= set_select('prestasi',1); ?> >Juara 1</option>
                                <option value="2" <?= set_select('prestasi',2); ?> >Juara 2</option>
                                <option value="3" <?= set_select('prestasi',3); ?> >Juara 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA SISWA <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_siswa" maxlength="100" value="<?= set_value('nama_siswa'); ?>" class="form-control required" placeholder="NAMA SISWA">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KELAS</label>
                        <div class="col-sm-3">
                            <input type="text" name="kelas" maxlength="6" value="<?= set_value('kelas'); ?>" class="form-control" placeholder="KELAS">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TINGKAT <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="tingkat" class="form-control required">
                                <option value="1" <?= set_select('tingkat',1); ?> >Kabupaten</option>
                                <option value="2" <?= set_select('tingkat',2); ?> >Karesidenan</option>
                                <option value="3" <?= set_select('tingkat',3); ?> >Provinsi</option>
                                <option value="4" <?= set_select('tingkat',4); ?> >Nasional</option>
                                <option value="5" <?= set_select('tingkat',5); ?> >Internasional</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">KETERANGAN</label>
                        <div class="col-sm-8">
                            <input type="text" name="keterangan" maxlength="100" value="<?= set_value('keterangan'); ?>" class="form-control" placeholder="KETERANGAN">
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
                  <a href="<?= base_url('backend/prestasi-siswa'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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