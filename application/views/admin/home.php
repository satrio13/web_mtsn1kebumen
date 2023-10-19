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
            if($this->session->flashdata('msg-isialumni'))
            {
                echo pesan_sukses($this->session->flashdata('msg-isialumni'));
            }elseif($this->session->flashdata('msg-gagal-isialumni'))
            {
                echo pesan_gagal($this->session->flashdata('msg-gagal-isialumni'));
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <button onclick="reload_table()" class="btn bg-maroon btn-sm"><i class="fas fa-sync-alt"></i> Refresh</button>
                    <br><br>
                    <h3 class="text-center"><?= strtoupper($title); ?></h3>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="table-isialumni">
                            <thead class="bg-secondary text-center">
                                <tr>
                                    <th width="5%">NO</th>
                                    <th>STATUS</th>
                                    <th>NAMA</th>
                                    <th>TH LULUS</th>
                                    <th>ALAMAT</th>
                                    <th>KESAN</th>
                                    <th>GAMBAR</th>
                                    <th>TGL POST</th>
                                    <th width="10%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div id="loading-animation" style="display: none;" class="text-center">
                                    <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>
</div>

<div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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


<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Detail Isi Alumni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="load" class="text-center"></div>
                <div class="row">
                    <div class="col-md-12 text-center" id="img">
                        
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">NAMA LENGKAP</div>
                    <div class="col-md-10" id="nama"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">TAHUN LULUS</div>
                    <div class="col-md-10" id="th_lulus"></div>
                </div>
                <?php 
                if(jenjang() == 1 OR jenjang() == 3)
                { 
                    echo'<div class="row mt-2">
                            <div class="col-md-2 text-bold">SMA / SMK / MA</div>
                            <div class="col-md-10" id="sma"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">PERGURUAN TINGGI</div>
                            <div class="col-md-10" id="pt"></div>
                        </div>';
                }

                if(jenjang() == 2 OR jenjang() == 4)
                {
                    echo'<div class="row mt-2">
                            <div class="col-md-2 text-bold">PERGURUAN TINGGI</div>
                            <div class="col-md-10" id="pt"></div>
                        </div>';
                } 
                ?>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">INSTANSI</div>
                    <div class="col-md-10" id="instansi"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">ALAMAT INSTANSI</div>
                    <div class="col-md-10" id="alamatins"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">HP</div>
                    <div class="col-md-10" id="hp"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">EMAIL</div>
                    <div class="col-md-10" id="email"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">ALAMAT</div>
                    <div class="col-md-10" id="alamat"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">KESAN</div>
                    <div class="col-md-10" id="kesan"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_status" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Form Edit Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="load_status" class="text-center"></div>
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" id="id"> 
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">STATUS *</label>
                        <div class="col-md-9">
                            <select name="status" class="form-control" id="status">
                                <option value="0">Menunggu</option>
                                <option value="1">Publish</option>
                                <option value="2">Tolak</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_status()" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> SIMPAN</button>
            </div>
        </div>
    </div>
</div>