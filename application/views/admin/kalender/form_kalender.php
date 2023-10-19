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
              if($this->session->flashdata('msg-kalender'))
              {
                echo pesan_sukses($this->session->flashdata('msg-kalender'));
              }elseif($this->session->flashdata('msg-gagal-kalender'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-kalender'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/kalender'); ?>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">FILE <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                        <?php if(!empty($data->kalender)){ ?>
                          File sekarang : <a href="<?= base_url(); ?>assets/file/<?= $data->kalender; ?>" target="_blank"><?= $data->kalender; ?></a>
                        <?php } ?>
                        <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf" class="form-control" required>
                        <p style="color: red"> *) format file JPG/PNG/PDF ukuran maksimal 5 MB</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> SIMPAN</button>
                  <button type="button" class='btn btn-danger btn-sm float-right' onclick='self.history.back()'><i class="fa fa-arrow-left"></i> BATAL</button>
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