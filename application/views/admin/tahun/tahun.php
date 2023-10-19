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
              if($this->session->flashdata('msg-tahun'))
              {
                echo pesan_sukses($this->session->flashdata('msg-tahun'));
              }elseif($this->session->flashdata('msg-gagal-tahun'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-tahun'));
              }
            ?>
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url('backend/tambah-tahun-pelajaran'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Tahun Pelajaran</a>
                    <a href="" target="_self" class="btn bg-maroon btn-sm"><i class="fas fa-sync-alt"></i> Refresh</a>
                    <br><br>
                    <h3 class="text-center"><?= strtoupper($title); ?></h3>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="datatable">
                            <thead class="bg-secondary text-center">
                              <tr>
                                  <th width="5%">NO</th>
                                  <th>TAHUN PELAJARAN</th>
                                  <th width="15%">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach($data->result() as $r): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $r->tahun; ?></td>
                                    <td class="text-center" nowrap>
                                        <a href="<?= base_url(); ?>backend/edit-tahun-pelajaran/<?= $r->id_tahun; ?>" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
                                        data-href="<?= base_url(); ?>backend/hapus-tahun-pelajaran/<?= $r->id_tahun; ?>" title="HAPUS DATA">HAPUS</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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