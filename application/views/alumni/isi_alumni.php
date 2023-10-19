<section id="isi" class="pt-3 pb-3 text-dark">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Alumni</li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12"><h3><b>ISI DATA ALUMNI</b></h3><hr></div>
        <div>
    </div>
    <div class="container">
         <div class="row">
            <div class="col-md-6">
                <?php 
                if($this->session->flashdata('msg-alumni'))
                { 
                    echo"<script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: ' ".$this->session->flashdata('msg-alumni')." ',
                                    timer: 5000
                                });
                            },3000); 
                        </script>"; 
                }elseif($this->session->flashdata('msg-gagal-alumni'))
                { 
                    echo "<script type='text/javascript'>
                            setTimeout(function () { 
                                swal({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: ' ".$this->session->flashdata('msg-gagal-alumni')." ',
                                    timer: 5000
                                });
                            },3000); 
                        </script>"; 
                } ?>
                Silahkan mengisi data alumni, dengan adanya penelusuran alumni ini para alumni bisa mencari teman-teman sekolah dulu. Jika anda sudah mengisi data sebagai alumni <?= strtoupper(title()); ?>, maka data anda akan kami simpan di database kami, bagian publishing website akan mempublish data anda.
            </div>
            <div class="col-md-6 bg-light p-3">
                <?php echo form_open_multipart('alumni/penelusuran-alumni','id="form"'); ?>
                <div class="row p-2">
                    <div class="col-md-4"><label for="nama">NAMA <span class="text-danger">*</span></label></div>
                    <div class="col-md-8">
                        <input type="text" name="nama" id="nama" maxlength="100" value="<?= set_value('nama'); ?>" placeholder="Nama" class="form-control required">
                        <?= form_error('nama'); ?>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4"><label for="tahun">TAHUN LULUS <span class="text-danger">*</span></label></div>
                    <div class="col-md-8">
                        <input type="text" name="th_lulus" id="tahun" minlength="4" maxlength="4" value="<?= set_value('th_lulus'); ?>" placeholder="Tahun Lulus" class="form-control required" onkeypress="return hanyaAngka(event)">
                        <?= form_error('th_lulus'); ?>
                    </div>
                </div>
                <?php if(jenjang() == 1 OR jenjang() == 3){ ?>
                    <div class="row p-2">
                        <div class="col-md-4"><label for="jenjang">SMA / SMK / MA</label></div>
                        <div class="col-md-8">
                            <input type="text" name="sma" id="jenjang" maxlength="100" value="<?= set_value('sma'); ?>" placeholder="Nama SMA / SMK / MA / Sederajat" class="form-control">
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-md-4"><label for="pt">PERGURUAN TINGGI</label></div>
                        <div class="col-md-8">
                            <input type="text" name="pt" id="pt" maxlength="100" value="<?= set_value('pt'); ?>" placeholder="Nama Perguruan Tinggi" class="form-control">
                        </div>
                    </div>
                <?php } ?>
                <?php if(jenjang() == 2 OR jenjang() == 4){ ?>
                    <div class="row p-2">
                        <div class="col-md-4"><label for="pt">PERGURUAN TINGGI</label></div>
                        <div class="col-md-8">
                            <input type="text" name="pt" id="pt" maxlength="100" value="<?= set_value('pt'); ?>" placeholder="Nama Perguruan Tinggi" class="form-control">
                        </div>
                    </div>
                <?php } ?>
                <div class="row p-2">
                    <div class="col-md-4"><label for="instansi">INSTANSI</label></div>
                    <div class="col-md-8">
                        <input type="text" name="instansi" id="instansi" maxlength="100" value="<?= set_value('instansi'); ?>" placeholder="Nama Instansi" class="form-control">
                    </div>
                </div>
                
                <div class="row p-2">
                    <div class="col-md-4"><label for="alamatins">ALAMAT INSTANSI</label></div>
                    <div class="col-md-8">
                        <input type="text" name="alamatins" id="alamatins" maxlength="100" value="<?= set_value('alamatins'); ?>" placeholder="Alamat Instansi" class="form-control">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4"><label for="hp">NO HP</label></div>
                    <div class="col-md-8">
                        <input type="text" name="hp" id="hp" maxlength="20" value="<?= set_value('hp'); ?>" placeholder="No HP" class="form-control">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4"><label for="email">EMAIL</label></div>
                    <div class="col-md-8">
                        <input type="email" name="email" id="email" maxlength="100" value="<?= set_value('email'); ?>" placeholder="Email" class="form-control">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4"><label for="alamat">ALAMAT</label></div>
                    <div class="col-md-8">
                        <input type="text" name="alamat" id="alamat" maxlength="100" value="<?= set_value('alamat'); ?>" placeholder="Alamat Sekarang" class="form-control">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4"><label for="kesan">KESAN</label></div>
                    <div class="col-md-8">
                        <textarea name="kesan" id="kesan" class="form-control"><?= set_value('kesan'); ?></textarea>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4">GAMBAR</div>
                    <div class="col-md-8">
                        <img class='img-responsive' id='preview_gambar' width='100px'>
                        <input type="file" name="gambar" id="file-upload" accept="image/png, image/jpeg" class="form-control" onchange="readURL(this);"><small class="text-danger"> *) format file JPG/PNG ukuran maksimal 1 MB</small>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4"></div>
                    <div class="col-md-8"><?php echo $img; ?></div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4"><label for="secutity_code">CAPTCHA <span class="text-danger">*</span></label></div>
                    <div class="col-md-8">
                        <input type="text" name="secutity_code" id="secutity_code" value="<?= set_value('secutity_code'); ?>" placeholder="MASUKAN CAPTCHA" class="form-control required">
                        <?= form_error('secutity_code'); ?>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <button type="submit" name="submit" value="Submit" class="btn bg-theme text-white" onclick="return VerifyUploadSizeIsOK()"><i class="fa fa-send"></i> KIRIM</button>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-12"><?php echo form_close(); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="alumni" class="bg-theme p-2">
    <div class="container">
        <h3 class="text-center text-white">data isi alumni</h3>
    </div>
</section>
<section class="bg-white pt-3 pb-5">
    <div class="container">
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-sm" id="table-isialumni">
                <thead class="bg-theme text-white text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Tahun Lulus</th>
                    <?php 
                    if(jenjang() == 1 OR jenjang() == 3)
                    { 
                        echo'<th>SMA / SMK / MA</th>';
                        echo'<th>Perguruan Tinggi</th>';
                    }elseif(jenjang() == 2 OR jenjang() == 4)
                    { 
                        echo'<th>Perguruan Tinggi</th>';
                    }
                    ?>
                    <th>Instansi</th>
                    <th>Alamat Instansi</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Kesan</th>
                    <th>Gambar</th>
                </tr>
                </thead>
                </tbody>
                
                </tbody>
            </table>
        </div>
    </div>
</section>