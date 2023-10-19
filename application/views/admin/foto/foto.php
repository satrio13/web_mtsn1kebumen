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
              if($this->session->flashdata('msg-foto'))
              {
                echo pesan_sukses($this->session->flashdata('msg-foto'));
              }elseif($this->session->flashdata('msg-gagal-foto'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-foto'));
              }
            ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">FORM <?= strtoupper($title); ?></h3>
                </div>
                <?php echo form_open_multipart('backend/foto'); ?>     
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ALBUM <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <select name="id_album" class="form-control">
                            <?php foreach($album->result() as $r): ?>
                                <option value="<?= $r->id_album; ?>"><?= $r->album; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">FOTO <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <input type="file" name="files[]" id="file-upload" accept='image/png, image/jpeg' class='form-control' required multiple/>
                            <small style="color: red"> *) format file JPG/PNG ukuran maksimal semua file 7 MB</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <span class="text-danger"><b>*</b></span>) Field Wajib Diisi
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm" onclick="return VerifyUploadSizeIsOK()"><i class="fa fa-check"></i> UPLOAD</button>
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

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="table-foto">
                            <thead class="bg-secondary text-center">
                              <tr>
                                  <th width="5%" nowrap>NO</th>
                                  <th width="20%" nowrap>FOTO</th>
                                  <th nowrap>ALBUM</th>
                                  <th nowrap>WAKTU UPLOAD</th>
                                  <th nowrap>AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                      
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>
</div>

<div class="modal fade mt-5" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
               <b>Anda yakin ingin menghapus data ini ?</b><br><br>
               <a class="btn btn-danger btn-ok"> Hapus</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            </div>
        </div>
    </div>
</div>