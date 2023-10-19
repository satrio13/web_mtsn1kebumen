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
              if($this->session->flashdata('msg-user'))
              {
                echo pesan_sukses($this->session->flashdata('msg-user'));
              }elseif($this->session->flashdata('msg-gagal-user'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-user'));
              }
            ?>
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url('backend/tambah-user'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah User</a>
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
                                  <th>NAMA</th>
                                  <th>USERNAME</th>
                                  <th>EMAIL</th>
                                  <th>LEVEL</th>
                                  <th>STATUS</th>
                                  <th>AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; foreach($data->result() as $r): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $r->nama; ?></td>
                                <td><?= $r->username; ?></td>
                                <td><?= $r->email; ?></td>
                                <td><?= $r->level; ?></td>
                                <td class="text-center">
                                    <?php if($r->is_active == '1'){ ?>
                                        <span class="badge badge-primary">Aktif</span>
                                    <?php }else{ ?>
                                        <span class="badge badge-danger">Non Aktif</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center" nowrap>
                                    <a href="<?= base_url("backend/edit-user/$r->id_user"); ?>" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
                                    data-href="<?= base_url("backend/hapus-user/$r->id_user"); ?>" title="HAPUS DATA">HAPUS</a>
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