<?php
if(isset($_POST['submit']))
{
  $id_tahun = $this->input->post('id_tahun', TRUE);
  $jml1pa = $this->input->post('jml1pa', TRUE);
  $jml1pi = $this->input->post('jml1pi', TRUE);
  $jml2pa = $this->input->post('jml2pa', TRUE);
  $jml2pi = $this->input->post('jml2pi', TRUE);
  $jml3pa = $this->input->post('jml3pa', TRUE);
  $jml3pi = $this->input->post('jml3pi', TRUE);
}else
{
  $id_tahun = $data->id_tahun;
  $jml1pa = $data->jml1pa;
  $jml1pi = $data->jml1pi;
  $jml2pa = $data->jml2pa;
  $jml2pi = $data->jml2pi;
  $jml3pa = $data->jml3pa;
  $jml3pi = $data->jml3pi;
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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/siswa'); ?>">Peserta Didik</a></li>
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
              if($this->session->flashdata('msg-siswa'))
              {
                echo pesan_sukses($this->session->flashdata('msg-siswa'));
              }elseif($this->session->flashdata('msg-gagal-siswa'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-siswa'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open('backend/edit-siswa/'.$this->uri->segment('3'), 'id="form"'); ?>
                <div class="card-body">
                <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">TAHUN PELAJARAN <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <select name="id_tahun" class="form-control required">
                                <?php foreach($tahun->result() as $r): ?>    
                                    <option value="<?= $r->id_tahun; ?>" <?php if($id_tahun == $r->id_tahun){ echo'selected'; } ?> ><?= $r->tahun; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('id_tahun'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><?php if($profil->jenjang == 1 OR $profil->jenjang == 3){ echo'KELAS VII'; }else{ echo'KELAS X'; } ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="number" name="jml1pa" value="<?= $jml1pa; ?>" class="form-control required" placeholder="JUMLAH SISWA PUTRA" onkeypress="return hanyaAngka(event)">
                            <?php echo form_error('jml1pa'); ?>
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="jml1pi" value="<?= $jml1pi; ?>" class="form-control required" placeholder="JUMLAH SISWA PUTRI" onkeypress="return hanyaAngka(event)">
                            <?php echo form_error('jml1pi'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><?php if($profil->jenjang == 1 OR $profil->jenjang == 3){ echo'KELAS VIII'; }else{ echo'KELAS XI'; } ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="number" name="jml2pa" value="<?= $jml2pa; ?>" class="form-control required" placeholder="JUMLAH SISWA PUTRA" onkeypress="return hanyaAngka(event)">
                            <?php echo form_error('jml2pa'); ?>
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="jml2pi" value="<?= $jml2pi; ?>" class="form-control required" placeholder="JUMLAH SISWA PUTRI" onkeypress="return hanyaAngka(event)">
                            <?php echo form_error('jml2pi'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><?php if($profil->jenjang == 1 OR $profil->jenjang == 3){ echo'KELAS IX'; }else{ echo'KELAS XII'; } ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            <input type="number" name="jml3pa" value="<?= $jml3pa; ?>" class="form-control required" placeholder="JUMLAH SISWA PUTRA" onkeypress="return hanyaAngka(event)">
                            <?php echo form_error('jml3pa'); ?>
                        </div>
                        <div class="col-sm-3">
                            <input type="number" name="jml3pi" value="<?= $jml3pi; ?>" class="form-control required" placeholder="JUMLAH SISWA PUTRI" onkeypress="return hanyaAngka(event)">
                            <?php echo form_error('jml3pi'); ?>
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
                  <a href="<?= base_url('backend/siswa'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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