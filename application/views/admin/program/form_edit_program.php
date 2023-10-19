<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= $title; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('backend'); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('backend/program'); ?>">Program</a></li>
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
              if($this->session->flashdata('msg-program'))
              {
                echo pesan_sukses($this->session->flashdata('msg-program'));
              }elseif($this->session->flashdata('msg-gagal-program'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-program'));
              }
            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/edit-program/'.$this->uri->segment('3')); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NAMA PROGRAM *</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama" maxlength="30" value="<?= $data->nama; ?>" class="form-control" id="inputEmail3" placeholder="NAMA PROGRAM" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">KETERANGAN *</label>
                        <div class="col-sm-8">
                            <textarea class="textarea" name="keterangan"><?= $data->keterangan; ?></textarea>
                            <?= form_error('keterangan'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">GAMBAR</label>
                        <div class="col-sm-5">
                            <?php if(empty($data->gambar)){ ?>
                                <img class='img-responsive' id='preview_gambar' width='150px'>
                            <?php }else{ ?>
                                <img class='img-responsive' id='preview_gambar' width='150px' src="<?= base_url(); ?>assets/img/program/<?= $data->gambar; ?>">
                            <?php } ?>
                            <input type='file' class='form-control' name='gambar' onchange='readURL(this);'>
                            <small style="color: red"> *) format file JPG/PNG ukuran maksimal 1 MB</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <div class="form-check">
                                <label class="form-check-label" for="exampleCheck2">*) Field Wajib Diisi</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" value="Submit" class="btn bg-olive btn-flat"><i class="fa fa-check"></i> SIMPAN</button>
                  <a href="<?= base_url('backend/program'); ?>" class="btn btn-danger btn-flat float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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