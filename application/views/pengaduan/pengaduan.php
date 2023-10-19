<section id="isi" class="pt-3 pb-3 text-dark">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12"><h3><b>LAYANAN PENGADUAN</b></h3><hr></div>
        <div>
    </div>
    <div class="container">
         <div class="row">
            <div class="col-md-12 bg-light">
                <div class="alert alert-danger mt-2"><b>Identitas Pengadu Dirahasiakan</b></div>
                    <?php 
                    if($this->session->flashdata('msg-pengaduan'))
                    { 
                        echo"<script type='text/javascript'>
                                setTimeout(function () { 
                                    swal({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: ' ".$this->session->flashdata('msg-pengaduan')." ',
                                        timer: 5000
                                    });
                                },3000); 
                            </script>"; 
                    }elseif($this->session->flashdata('msg-gagal-pengaduan'))
                    { 
                        echo "<script type='text/javascript'>
                                setTimeout(function () { 
                                    swal({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: ' ".$this->session->flashdata('msg-gagal-pengaduan')." ',
                                        timer: 5000
                                    });
                                },3000); 
                            </script>"; 
                    } ?>
                <?php echo form_open_multipart('pengaduan','id="form"'); ?>
                <div class="row p-2">
                    <div class="col-md-3"><label for="nama">NAMA</label> <span class="text-danger">*</span></div>
                    <div class="col-md-5">
                        <input type="text" name="nama" id="nama" maxlength="50" value="<?= set_value('nama'); ?>" placeholder="Masukan Nama" class="form-control required">
                        <?= form_error('nama'); ?>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-3"><label for="status">STATUS</label> <span class="text-danger">*</span></div>
                    <div class="col-md-5">
                        <select name="status" id="status" class="form-control required digits">
                            <option value="1" <?= set_select('status', 1); ?> >Peserta Didik</option>
                            <option value="2" <?= set_select('status', 2); ?> >Wali Murid</option>
                            <option value="3" <?= set_select('status', 3); ?> >Masyarakat</option>
                        </select>
                        <?= form_error('status'); ?>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-3"><label for="isi">URAIAN PENGADUAN</label> <span class="text-danger">*</span></div>
                    <div class="col-md-5">
                        <textarea class="form-control required" name="isi" id="isi"><?= set_value('isi'); ?></textarea>
                        <?= form_error('isi'); ?>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-5"><?php echo $img; ?></div>
                </div>
                <div class="row p-2">
                    <div class="col-md-3"><label for="secutity_code">CAPTCHA</label> <span class="text-danger">*</span></div>
                    <div class="col-md-5">
                        <input type="text" name="secutity_code" id="secutity_code" value="<?= set_value('secutity_code'); ?>" placeholder="Masukan Captcha" class="form-control required">
                        <?= form_error('secutity_code'); ?>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <button type="submit" name="submit" value="SubmitPengaduan" class="btn bg-theme text-white"><i class="fa fa-send"></i> KIRIM</button>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-12"><?php echo form_close(); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>