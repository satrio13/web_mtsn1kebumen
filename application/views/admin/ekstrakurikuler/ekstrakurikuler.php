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
              if($this->session->flashdata('msg-ekstrakurikuler'))
              {
                echo pesan_sukses($this->session->flashdata('msg-ekstrakurikuler'));
              }elseif($this->session->flashdata('msg-gagal-ekstrakurikuler'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-ekstrakurikuler'));
              }
            ?>            
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url('backend/tambah-ekstrakurikuler'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Ekstrakurikuler</a>
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
                                  <th>NAMA EKSTRAKURIKULER</th>
                                  <th>GAMBAR</th>
                                  <th>KETERANGAN</th>
                                  <th width="10%">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $no = 1;
                            foreach($data->result() as $r):
                                if($r->gambar != '' AND file_exists("assets/img/ekstrakurikuler/$r->gambar"))
                                {
                                    $img = '<a href="'.base_url("assets/img/ekstrakurikuler/$r->gambar").'" target="_blank">
                                              <img src="'.base_url("assets/img/ekstrakurikuler/$r->gambar").'" class="img img-fluid" width="200px">
                                            </a>';
                                }else
                                {
                                    $img = '';
                                }

                                if(strlen($r->keterangan) > 200)
                                {
                                    $isi = substr($r->keterangan,0,200); 
                                    $keterangan = substr($r->keterangan,0,strrpos($isi," ")). '... <a href="'.base_url("ekstrakurikuler/detail/$r->slug").'" target="_blank"> lihat detail</a>';
                                }else
                                {
                                    $keterangan = $r->keterangan;
                                }
                                echo'<tr>
                                        <td class="text-center">'.$no++.'</td>
                                        <td>'.$r->nama_ekstrakurikuler.'</td>
                                        <td class="text-center">'.$img.'</td>
                                        <td>'.$keterangan.'</td>
                                        <td class="text-center">
                                            <a href="'.base_url("backend/edit-ekstrakurikuler/$r->id").'" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
                                            data-href="'.base_url("backend/hapus-ekstrakurikuler/$r->id").'" title="HAPUS DATA">HAPUS</a>
                                            </td>
                                    </tr>';
                            endforeach;
                            ?>
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