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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/karyawan'); ?>">Karyawan</a></li>
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
              if($this->session->flashdata('msg-karyawan'))
              {
                echo pesan_sukses($this->session->flashdata('msg-karyawan'));
              }elseif($this->session->flashdata('msg-gagal-karyawan'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-karyawan'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/tambah-karyawan','id="form"'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA LENGKAP <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="nama" maxlength="100" value="<?= set_value('nama'); ?>" class="form-control required" placeholder="NAMA LENGKAP">
                            <?php echo form_error('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIP BARU</label>
                        <div class="col-sm-5">
                            <input type="text" name="nip" maxlength="25" value="<?= set_value('nip'); ?>" class="form-control" placeholder="NIP">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">DUK</label>
                        <div class="col-sm-5">
                            <input type="text" name="duk" maxlength="20" value="<?= set_value('duk'); ?>" class="form-control" placeholder="DUK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIP LAMA</label>
                        <div class="col-sm-5">
                            <input type="text" name="niplama" maxlength="25" value="<?= set_value('niplama'); ?>" class="form-control" placeholder="NIP LAMA">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NUPTK</label>
                        <div class="col-sm-5">
                            <input type="text" name="nuptk" maxlength="25" value="<?= set_value('nuptk'); ?>" class="form-control" placeholder="NUPTK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NO KARPEG</label>
                        <div class="col-sm-5">
                            <input type="text" name="nokarpeg" maxlength="12" value="<?= set_value('nokarpeg'); ?>" class="form-control" placeholder="NO KARPEG">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TEMPAT LAHIR <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="tmp_lahir" maxlength="50" value="<?= set_value('tmp_lahir'); ?>" class="form-control required" placeholder="TEMPAT LAHIR">
                            <?php echo form_error('tmp_lahir'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TANGGAL LAHIR <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="date" name="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>" class="form-control required" placeholder="dd/mm/yyyy">
                            <?php echo form_error('tgl_lahir'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">STATUS PEGAWAI <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="statuspeg" value="PNS" id="radioPrimary1" <?= set_radio('statuspeg','PNS'); ?> required> 
                                <label for="radioPrimary1">PNS</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="statuspeg" value="CPNS" id="radioPrimary2" <?= set_radio('statuspeg','CPNS'); ?> required> 
                                <label for="radioPrimary2">CPNS</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="statuspeg" value="PTT" id="radioPrimary3" <?= set_radio('statuspeg','PTT'); ?> required> 
                                <label for="radioPrimary3">PTT</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <br><label for="statuspeg" class="error"></label>
                            <?php echo form_error('statuspeg'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TUGAS</label>
                        <div class="col-sm-5">
                            <input type="text" name="tugas" maxlength="50" value="<?= set_value('tugas'); ?>" class="form-control" placeholder="TUGAS">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">GOLONGAN RUANG</label>
                        <div class="col-sm-5">
                            <select name="golruang" class="form-control">
                                <option value="-" <?= set_select('golruang','-'); ?> >-</option>
                                <option value="I/a" <?= set_select('golruang','I/a'); ?> >I/a</option>
                                <option value="I/b" <?= set_select('golruang','I/b'); ?> >I/b</option>
                                <option value="I/c" <?= set_select('golruang','I/c'); ?> >I/c</option>
                                <option value="I/d" <?= set_select('golruang','I/d'); ?> >I/d</option>
                                <option value="II/a" <?= set_select('golruang','II/a'); ?> >II/a</option>
                                <option value="II/b" <?= set_select('golruang','II/b'); ?> >II/b</option>
                                <option value="II/c" <?= set_select('golruang','II/c'); ?> >II/c</option>
                                <option value="II/d" <?= set_select('golruang','II/d'); ?> >II/d</option>
                                <option value="III/a" <?= set_select('golruang','III/a'); ?> >III/a</option>
                                <option value="III/b" <?= set_select('golruang','III/b'); ?> >III/b</option>
                                <option value="III/c" <?= set_select('golruang','III/c'); ?> >III/c</option>
                                <option value="III/d" <?= set_select('golruang','III/d'); ?> >III/d</option>
                                <option value="IV/a" <?= set_select('golruang','IV/a'); ?> >IV/a</option>
                                <option value="IV/b" <?= set_select('golruang','IV/b'); ?> >IV/b</option>
                                <option value="IV/c" <?= set_select('golruang','IV/c'); ?> >IV/c</option>
                                <option value="IV/d" <?= set_select('golruang','IV/d'); ?> >IV/d</option>   
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TANGGAL TMT CPNS</label>
                        <div class="col-sm-5">
                            <input type="date" name="tmt_cpns" value="<?= set_value('tmt_cpns'); ?>" class="form-control" placeholder="dd/mm/yyyy">
                        </div>
                        <div class="col-sm-4">
                            <small class="text-danger">tidak perlu diisi jika status masih GTT / PTT</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TANGGAL TMT PNS</label>
                        <div class="col-sm-5">
                            <input type="date" name="tmt_pns" value="<?= set_value('tmt_pns'); ?>" class="form-control" placeholder="dd/mm/yyyy">
                        </div>
                        <div class="col-sm-4">
                            <small class="text-danger">tidak perlu diisi jika status masih GTT / PTT / CPNS</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JENIS KELAMIN <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="jk" value="1" id="radioPrimary4" <?= set_radio('jk',1); ?> required> 
                                <label for="radioPrimary4">Laki-Laki</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="jk" value="2" id="radioPrimary5" <?= set_radio('jk',2); ?> required> 
                                <label for="radioPrimary5">Perempuan</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <br><label for="jk" class="error"></label>
                            <?php echo form_error('jk'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">AGAMA</label>
                        <div class="col-sm-5">
                            <select name="agama" class="form-control">
                                <option value="1" <?= set_select('agama',1); ?> >Islam</option>
                                <option value="2" <?= set_select('agama',2); ?> >Kristen Katolik</option>
                                <option value="3" <?= set_select('agama',3); ?> >Kristen Protestan</option>
                                <option value="4" <?= set_select('agama',4); ?> >Hindu</option>
                                <option value="5" <?= set_select('agama',5); ?> >Budha</option>
                                <option value="6" <?= set_select('agama',6); ?> >Konghuchu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ALAMAT</label>
                        <div class="col-sm-5">
                            <input type="text" name="alamat" maxlength="100" value="<?= set_value('alamat'); ?>" class="form-control" placeholder="ALAMAT">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TINGKAT PENDIDIKAN TERAKHIR</label>
                        <div class="col-sm-5">
                            <input type="text" name="tingkat_pt" maxlength="20" value="<?= set_value('tingkat_pt'); ?>" class="form-control" placeholder="PENDIDIKAN TERAKHIR">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">PRODI</label>
                        <div class="col-sm-5">
                            <input type="text" name="prodi" maxlength="50" value="<?= set_value('prodi'); ?>" class="form-control" placeholder="PRODI">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TAHUN LULUS</label>
                        <div class="col-sm-5">
                            <input type="text" name="th_lulus" minlength="4" maxlength="4" value="<?= set_value('th_lulus'); ?>" onkeypress="return hanyaAngka(event)" class="form-control" placeholder="TAHUN LULUS">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">STATUS <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="status" value="Aktif" id="radioPrimary6" <?= set_radio('status','Aktif'); ?> required> 
                                <label for="radioPrimary6">Aktif</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="status" value="Mutasi" id="radioPrimary7" <?= set_radio('status','Mutasi'); ?> required> 
                                <label for="radioPrimary7">Mutasi</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="status" value="Pensiun" id="radioPrimary8" <?= set_radio('status','Pensiun'); ?> required> 
                                <label for="radioPrimary8">Pensiun</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <br><label for="status" class="error"></label>
                            <?php echo form_error('status'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">EMAIL</label>
                        <div class="col-sm-5">
                            <input type="email" name="email" maxlength="100" value="<?= set_value('email'); ?>" class="form-control" placeholder="EMAIL">
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
                  <a href="<?= base_url('backend/karyawan'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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