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
            if($this->session->flashdata('msg-pengaduan'))
            {
                echo pesan_sukses($this->session->flashdata('msg-pengaduan'));
            }elseif($this->session->flashdata('msg-gagal-pengaduan'))
            {
                echo pesan_gagal($this->session->flashdata('msg-gagal-pengaduan'));
            }
            ?>
            <div class="card">
                <div class="card-header">
                    <a href="" target="_self" class="btn bg-maroon btn-sm"><i class="fas fa-sync-alt"></i> Refresh</a>
                    <br><br>
                    <h3 class="text-center"><?= strtoupper($title); ?></h3>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="table-pengaduan">
                            <thead class="bg-secondary text-center">
                                <tr>
                                    <th width="5%">NO</th>
                                    <th>NAMA</th>
                                    <th>STATUS</th>
                                    <th>URAIAN PENGADUAN</th>
                                    <th width="15%">AKSI</th>
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

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Detail Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="load" class="text-center"></div>
                <div class="row">
                    <div class="col-md-2 text-bold">Nama</div>
                    <div class="col-md-10" id="nama"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">Status</div>
                    <div class="col-md-10" id="status"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">Uraian Pengaduan</div>
                    <div class="col-md-10" id="pengaduan"></div>
                </div>
            </div>
        </div>
    </div>
</div>