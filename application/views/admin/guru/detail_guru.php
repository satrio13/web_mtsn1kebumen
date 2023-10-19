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
            <li class="breadcrumb-item active">Guru</li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row mt-2">
                            <div class="col-md-12 text-bold text-white bg-info p-1">DETAIL GURU</div>
                        </div>
                    </div>
                    <div class="col-md-12 border border-secondary">
                        <div class="row mt-4">
                            <div class="col-md-12 text-center">
                                <?php 
                                if(!empty($data->gambar) AND file_exists("assets/img/guru/$data->gambar"))
                                {
                                    echo'<img src="'.base_url("assets/img/guru/$data->gambar").'" class="img img-fluid" width="120px">';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">NAMA LENGKAP</div>
                            <div class="col-md-10">: <?= $data->nama; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">NIP BARU</div>
                            <div class="col-md-10">: <?= $data->nip; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">DUK</div>
                            <div class="col-md-10">: <?= $data->duk; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">NIP LAMA</div>
                            <div class="col-md-10">: <?= $data->niplama; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">NUPTK</div>
                            <div class="col-md-10">: <?= $data->nuptk; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">NO KARPEG</div>
                            <div class="col-md-10">: <?= $data->nokarpeg; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">TEMPAT LAHIR</div>
                            <div class="col-md-10">: <?= $data->tmp_lahir; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">TGL LAHIR</div>
                            <div class="col-md-10">: <?php if($data->tgl_lahir != '0000-00-00'){ echo tgl_indo($data->tgl_lahir); } ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">STATUS PEGAWAI</div>
                            <div class="col-md-10">: <?= $data->statuspeg; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">GOLONGAN RUANG</div>
                            <div class="col-md-10">: <?= $data->golruang; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">TANGGAL TMT CPNS</div>
                            <div class="col-md-10">: <?php if($data->tmt_cpns != '0000-00-00'){ echo tgl_indo($data->tmt_cpns); } ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">TANGGAL TMT PNS</div>
                            <div class="col-md-10">: <?php if($data->tmt_pns != '0000-00-00'){ echo tgl_indo($data->tmt_pns); } ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">JENIS KELAMIN</div>
                            <div class="col-md-10">:  <?php if($data->jk == 1){ echo'Laki-Laki'; }elseif($data->jk == 2){ echo'Perempuan'; } ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">AGAMA</div>
                            <div class="col-md-10">:    <?php 
                                                        if($data->agama == '1')
                                                        { 
                                                            echo'Islam'; 
                                                        }elseif($data->agama == '2')
                                                        { 
                                                            echo'Kristen Katolik'; 
                                                        }elseif($data->agama == '3')
                                                        { 
                                                            echo'Kristen Protestan'; 
                                                        }elseif($data->agama == '4')
                                                        { 
                                                            echo'Hindu'; 
                                                        }elseif($data->agama == '5')
                                                        { 
                                                            echo'Budha'; 
                                                        }elseif($data->agama == '6')
                                                        { 
                                                            echo'Konghuchu'; 
                                                        }
                                                        ?>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">ALAMAT</div>
                            <div class="col-md-10">:  <?= $data->alamat; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">TINGKAT PENDIDIKAN TERAKHIR</div>
                            <div class="col-md-10">:  <?= $data->tingkat_pt; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">PRODI</div>
                            <div class="col-md-10">:  <?= $data->prodi; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">TAHUN LULUS</div>
                            <div class="col-md-10">:  <?= $data->th_lulus; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">STATUS AKTIF</div>
                            <div class="col-md-10">:  <?= $data->status; ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 text-bold">STATUS GURU</div>
                            <div class="col-md-10">:  <?= $data->statusguru; ?></div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col-md-2 text-bold">EMAIL</div>
                            <div class="col-md-10">:  <?= $data->email; ?></div>
                        </div>           
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
</div>