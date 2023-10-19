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
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><?= strtoupper($title); ?></h3>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead class="bg-secondary text-center">
                            <tr>
                                <th width="5%">NO</th>
                                <th>NAMA PROGRAM</th>
                                <th>KETERANGAN</th>
                                <th>GAMBAR</th>
                                <th>AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; foreach($data->result() as $r): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?>.</td>
                                    <td><?= $r->nama ?></td>
                                    <td><?= $r->keterangan; ?></td>
                                    <td class="text-center">
                                        <?php 
                                        if($r->gambar != '' AND file_exists("assets/img/program/$r->gambar"))
                                        {
                                            echo'<a href="'.base_url("assets/img/program/$r->gambar").'" target="_blank">
                                            <img src="'.base_url("assets/img/program/$r->gambar").'" class="img img-fluid"></a>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url("backend/edit-program/$r->id"); ?>" class="btn btn-dark btn-xs btn-flat" title="EDIT DATA">EDIT</a>
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