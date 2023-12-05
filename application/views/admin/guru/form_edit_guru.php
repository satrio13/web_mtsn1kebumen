<?php
$nama = isset($_POST['submit']) ? $this->input->post('nama', TRUE) : $data->nama;
$nip = isset($_POST['submit']) ? $this->input->post('nip', TRUE) : $data->nip;
$duk = isset($_POST['submit']) ? $this->input->post('duk', TRUE) : $data->duk;
$niplama = isset($_POST['submit']) ? $this->input->post('niplama', TRUE) : $data->niplama;
$nuptk = isset($_POST['submit']) ? $this->input->post('nuptk', TRUE) : $data->nuptk;
$nokarpeg = isset($_POST['submit']) ? $this->input->post('nokarpeg', TRUE) : $data->nokarpeg;
$tmp_lahir = isset($_POST['submit']) ? $this->input->post('tmp_lahir', TRUE) : $data->tmp_lahir;
$tgl_lahir = isset($_POST['submit']) ? $this->input->post('tgl_lahir', TRUE) : $data->tgl_lahir;
$statuspeg = isset($_POST['submit']) ? $this->input->post('statuspeg', TRUE) : $data->statuspeg;
$golruang = isset($_POST['submit']) ? $this->input->post('golruang', TRUE) : $data->golruang;
$tmt_cpns = isset($_POST['submit']) ? $this->input->post('tmt_cpns', TRUE) : $data->tmt_cpns;
$tmt_pns = isset($_POST['submit']) ? $this->input->post('tmt_pns', TRUE) : $data->tmt_pns;
$jk = isset($_POST['submit']) ? $this->input->post('jk', TRUE) : $data->jk;
$agama = isset($_POST['submit']) ? $this->input->post('agama', TRUE) : $data->agama;
$alamat = isset($_POST['submit']) ? $this->input->post('alamat', TRUE) : $data->alamat;
$tingkat_pt = isset($_POST['submit']) ? $this->input->post('tingkat_pt', TRUE) : $data->tingkat_pt;
$prodi = isset($_POST['submit']) ? $this->input->post('prodi', TRUE) : $data->prodi;
$th_lulus = isset($_POST['submit']) ? $this->input->post('th_lulus', TRUE) : $data->th_lulus;
$status = isset($_POST['submit']) ? $this->input->post('status', TRUE) : $data->status;
$statusguru = isset($_POST['submit']) ? $this->input->post('statusguru', TRUE) : $data->statusguru;
$email = isset($_POST['submit']) ? $this->input->post('email', TRUE) : $data->email;
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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/guru'); ?>">Guru</a></li>
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
              if($this->session->flashdata('msg-guru'))
              {
                echo pesan_sukses($this->session->flashdata('msg-guru'));
              }elseif($this->session->flashdata('msg-gagal-guru'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-guru'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/edit-guru/'.$this->uri->segment('3'), 'id="form"'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NAMA LENGKAP <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="nama" maxlength="100" value="<?= $nama; ?>" class="form-control required" placeholder="NAMA LENGKAP">
                            <?php echo form_error('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIP BARU</label>
                        <div class="col-sm-5">
                            <input type="text" name="nip" maxlength="25" value="<?= $nip; ?>" class="form-control" placeholder="NIP">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">DUK</label>
                        <div class="col-sm-5">
                            <input type="text" name="duk" maxlength="20" value="<?= $duk; ?>" class="form-control" placeholder="DUK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NIP LAMA</label>
                        <div class="col-sm-5">
                            <input type="text" name="niplama" maxlength="25" value="<?= $niplama; ?>" class="form-control" placeholder="NIP LAMA">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NUPTK</label>
                        <div class="col-sm-5">
                            <input type="text" name="nuptk" maxlength="25" value="<?= $nuptk; ?>" class="form-control" placeholder="NUPTK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">NO KARPEG</label>
                        <div class="col-sm-5">
                            <input type="text" name="nokarpeg" maxlength="12" value="<?= $nokarpeg; ?>" class="form-control" placeholder="NO KARPEG">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TEMPAT LAHIR <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="tmp_lahir" maxlength="50" value="<?= $tmp_lahir; ?>" class="form-control required" placeholder="TEMPAT LAHIR">
                            <?php echo form_error('tmp_lahir'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TANGGAL LAHIR <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="date" name="tgl_lahir" value="<?= $tgl_lahir; ?>" class="form-control required" placeholder="dd/mm/yyyy">
                            <?php echo form_error('tgl_lahir'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">STATUS PEGAWAI <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="statuspeg" value="PNS" id="radioPrimary1" <?php if($statuspeg == 'PNS'){ echo'checked'; } ?> > 
                                <label for="radioPrimary1">PNS</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="statuspeg" value="CPNS" id="radioPrimary2" <?php if($statuspeg == 'CPNS'){ echo'checked'; } ?> > 
                                <label for="radioPrimary2">CPNS</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="statuspeg" value="GTT" id="radioPrimary3" <?php if($statuspeg == 'GTT'){ echo'checked'; } ?> > 
                                <label for="radioPrimary3">GTT</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <?php echo form_error('statuspeg'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">GOLONGAN RUANG</label>
                        <div class="col-sm-5">
                            <select name="golruang" class="form-control">
                                <option value="-" <?php if($golruang == '-'){ echo'selected'; } ?> >-</option>
                                <option value="I/a" <?php if($golruang == 'I/a'){ echo'selected'; } ?> >I/a</option>
                                <option value="I/b" <?php if($golruang == 'I/b'){ echo'selected'; } ?> >I/b</option>
                                <option value="I/c" <?php if($golruang == 'I/c'){ echo'selected'; } ?> >I/c</option>
                                <option value="I/d" <?php if($golruang == 'I/d'){ echo'selected'; } ?> >I/d</option>
                                <option value="II/a" <?php if($golruang == 'II/a'){ echo'selected'; } ?> >II/a</option>
                                <option value="II/b" <?php if($golruang == 'II/b'){ echo'selected'; } ?> >II/b</option>
                                <option value="II/c" <?php if($golruang == 'II/c'){ echo'selected'; } ?> >II/c</option>
                                <option value="II/d" <?php if($golruang == 'II/d'){ echo'selected'; } ?> >II/d</option>
                                <option value="III/a" <?php if($golruang == 'III/a'){ echo'selected'; } ?> >III/a</option>
                                <option value="III/b" <?php if($golruang == 'III/b'){ echo'selected'; } ?> >III/b</option>
                                <option value="III/c" <?php if($golruang == 'III/c'){ echo'selected'; } ?> >III/c</option>
                                <option value="III/d" <?php if($golruang == 'III/d'){ echo'selected'; } ?> >III/d</option>
                                <option value="IV/a" <?php if($golruang == 'IV/a'){ echo'selected'; } ?> >IV/a</option>
                                <option value="IV/b" <?php if($golruang == 'IV/b'){ echo'selected'; } ?> >IV/b</option>
                                <option value="IV/c" <?php if($golruang == 'IV/c'){ echo'selected'; } ?> >IV/c</option>
                                <option value="IV/d" <?php if($golruang == 'IV/d'){ echo'selected'; } ?> >IV/d</option>   
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TANGGAL TMT CPNS</label>
                        <div class="col-sm-5">
                            <input type="date" name="tmt_cpns" value="<?= $tmt_cpns; ?>" class="form-control" placeholder="dd/mm/yyyy">
                        </div>
                        <div class="col-sm-5">
                            <small class="text-danger">tidak perlu diisi jika status masih GTT</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TANGGAL TMT PNS</label>
                        <div class="col-sm-5">
                            <input type="date" name="tmt_pns" value="<?= $tmt_pns; ?>" class="form-control" placeholder="dd/mm/yyyy">
                        </div>
                        <div class="col-sm-5">
                            <small class="text-danger">tidak perlu diisi jika status masih GTT atau CPNS</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">JENIS KELAMIN <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="jk" value="1" id="radioPrimary4" <?php if($jk == 1){ echo'checked'; } ?> > 
                                <label for="radioPrimary4">Laki-Laki</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="jk" value="2" id="radioPrimary5" <?php if($jk == 2){ echo'checked'; } ?> > 
                                <label for="radioPrimary5">Perempuan</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <?php echo form_error('jk'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">AGAMA</label>
                        <div class="col-sm-5">
                            <select name="agama" class="form-control">
                                <option value="1" <?php if($agama == 1){ echo'selected'; } ?> >Islam</option>
                                <option value="2" <?php if($agama == 2){ echo'selected'; } ?> >Kristen Katolik</option>
                                <option value="3" <?php if($agama == 3){ echo'selected'; } ?> >Kristen Protestan</option>
                                <option value="4" <?php if($agama == 4){ echo'selected'; } ?> >Hindu</option>
                                <option value="5" <?php if($agama == 5){ echo'selected'; } ?> >Budha</option>
                                <option value="6" <?php if($agama == 6){ echo'selected'; } ?> >Konghuchu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ALAMAT</label>
                        <div class="col-sm-5">
                            <input type="text" name="alamat" maxlength="100" value="<?= $alamat; ?>" class="form-control" placeholder="ALAMAT">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TINGKAT PENDIDIKAN TERAKHIR</label>
                        <div class="col-sm-5">
                            <input type="text" name="tingkat_pt" maxlength="20" value="<?= $tingkat_pt; ?>" class="form-control" placeholder="PENDIDIKAN TERAKHIR">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">PRODI</label>
                        <div class="col-sm-5">
                            <input type="text" name="prodi" maxlength="50" value="<?= $prodi; ?>" class="form-control" placeholder="PRODI">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">TAHUN LULUS</label>
                        <div class="col-sm-5">
                            <input type="text" name="th_lulus" minlength="4" maxlength="4" value="<?= $th_lulus; ?>" onkeypress="return hanyaAngka(event)" class="form-control" placeholder="TAHUN LULUS">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">STATUS AKTIF <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="status" value="Aktif" id="radioPrimary6" <?php if($status == 'Aktif'){ echo'checked'; } ?> > 
                                <label for="radioPrimary6">Aktif</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="status" value="Mutasi" id="radioPrimary7" <?php if($status == 'Mutasi'){ echo'checked'; } ?> > 
                                <label for="radioPrimary7">Mutasi</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="status" value="Pensiun" id="radioPrimary8" <?php if($status == 'Pensiun'){ echo'checked'; } ?> > 
                                <label for="radioPrimary8">Pensiun</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <?php echo form_error('status'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">STATUS GURU <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="statusguru" value="Mapel" id="radioPrimary9" <?php if($statusguru == 'Mapel'){ echo'checked'; } ?> > 
                                <label for="radioPrimary9">Mapel</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="statusguru" value="BP/BK" id="radioPrimary10" <?php if($statusguru == 'BP/BK'){ echo'checked'; } ?> > 
                                <label for="radioPrimary10">BP/BK</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" name="statusguru" value="Kurikulum" id="radioPrimary11" <?php if($statusguru == 'Kurikulum'){ echo'checked'; } ?> > 
                                <label for="radioPrimary11">Kurikulum</label> 
                                &nbsp;&nbsp;&nbsp; 
                            </div>
                            <?php echo form_error('statusguru'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">EMAIL</label>
                        <div class="col-sm-5">
                            <input type="email" name="email" maxlength="100" value="<?= $email; ?>" class="form-control" placeholder="EMAIL">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">FOTO</label>
                        <div class="col-sm-5">
                            <?php if(empty($data->gambar)){ ?>
                                <img class='img-responsive' id='preview_gambar' width='150px'>
                            <?php }else{ ?>
                                <img class='img-responsive' id='preview_gambar' width='150px' src="<?= base_url(); ?>assets/img/guru/<?= $data->gambar; ?>">
                            <?php } ?>
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
                  <a href="<?= base_url('backend/guru'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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
