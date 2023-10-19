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
            <li class="breadcrumb-item"><a href="<?= base_url('backend/penelusuran-alumni'); ?>">Penelusuran Alumni</a></li>
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
            if($this->session->flashdata('msg-isialumni'))
            {
                echo pesan_sukses($this->session->flashdata('msg-isialumni'));
            }elseif($this->session->flashdata('msg-gagal-isialumni'))
            {
                echo pesan_gagal($this->session->flashdata('msg-gagal-isialumni'));
            }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open('backend/edit-status/'.$this->uri->segment('3')); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">STATUS *</label>
                        <div class="col-sm-4">
                            <select name="status" class="form-control">
                                <option value="0" <?php if($data->status == 0){ echo'selected'; } ?> >Menunggu</option>
                                <option value="1" <?php if($data->status == 1){ echo'selected'; } ?> >Publish</option>
                                <option value="2" <?php if($data->status == 2){ echo'selected'; } ?> >Tolak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> SIMPAN</button>
                  <a href="<?= base_url('backend/penelusuran-alumni'); ?>" class="btn btn-danger btn-sm float-right"><i class="fa fa-arrow-left"></i> BATAL</a>
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