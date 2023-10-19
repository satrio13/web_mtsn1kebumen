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
              if($this->session->flashdata('msg-guru'))
              {
                echo pesan_sukses($this->session->flashdata('msg-guru'));
              }elseif($this->session->flashdata('msg-gagal-guru'))
              {
                echo pesan_gagal($this->session->flashdata('msg-gagal-guru'));
              }
            ?>
            <div class="card">
                <div class="card-header">
                    <a href="<?=base_url();?>backend/tambah-guru" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Guru</a>
                    <a href="" target="_self" class="btn bg-maroon btn-sm"><i class="fas fa-sync-alt"></i> Refresh</a>
                    <br><br>
                    <h3 class="text-center"><?= strtoupper($title); ?></h3>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="table-guru">
                            <thead class="bg-secondary text-center">
                              <tr>
                                  <th width="5%">NO</th>
                                  <th>NAMA</th>
                                  <th>NIP</th>
                                  <th>JK</th>
                                  <th>STATUS PEGAWAI</th>
                                  <th>STATUS GURU</th>
                                  <th>STATUS AKTIF</th>
                                  <th>FOTO</th>
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
                <h5 class="modal-title">Detail Guru</h5>
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
                    <div class="col-md-2 text-bold">NIP BARU</div>
                    <div class="col-md-10" id="nip"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">DUK</div>
                    <div class="col-md-10" id="duk"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">NIP LAMA</div>
                    <div class="col-md-10" id="niplama"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">NUPTK</div>
                    <div class="col-md-10" id="nuptk"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">NO KARPEG</div>
                    <div class="col-md-10" id="nokarpeg"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">TEMPAT LAHIR</div>
                    <div class="col-md-10" id="tmp_lahir"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">TGL LAHIR</div>
                    <div class="col-md-10" id="tgl_lahir"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">STATUS PEGAWAI</div>
                    <div class="col-md-10" id="statuspeg"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">GOLONGAN RUANG</div>
                    <div class="col-md-10" id="golruang"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">TANGGAL TMT CPNS</div>
                    <div class="col-md-10" id="tmt_cpns"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">TANGGAL TMT PNS</div>
                    <div class="col-md-10" id="tmt_pns"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">JENIS KELAMIN</div>
                    <div class="col-md-10" id="jk"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">AGAMA</div>
                    <div class="col-md-10" id="agama"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">ALAMAT</div>
                    <div class="col-md-10" id="alamat"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">TINGKAT PENDIDIKAN TERAKHIR</div>
                    <div class="col-md-10" id="tingkat_pt"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">PRODI</div>
                    <div class="col-md-10" id="prodi"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">TAHUN LULUS</div>
                    <div class="col-md-10" id="th_lulus"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">STATUS AKTIF</div>
                    <div class="col-md-10" id="status"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">STATUS GURU</div>
                    <div class="col-md-10" id="statusguru"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 text-bold">EMAIL</div>
                    <div class="col-md-10" id="email"></div>
                </div>
            </div>
        </div>
    </div>
</div>