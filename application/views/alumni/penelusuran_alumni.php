<section id="agenda" class="pt-3 pb-5">
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
            <div class="col-md-12"><h3><b>PENELUSURAN ALUMNI<hr></b></h3></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            if($data->num_rows () > 0)
            {
                foreach($data->result() as $r):
                    if($r->gambar != '' AND file_exists("assets/img/alumni/$r->gambar"))
                    {
                        $img = $r->gambar;
                    }else
                    {
                        $img = 'no-image.png';
                    }

                    echo'<div class="col-md-3 mb-4">
                            <div class="card-content">
                                <div class="card-img">
                                    <a href="'.base_url("alumni/detail/$r->id").'">
                                        <img src="'.base_url("assets/img/alumni/$img").'" class="img img-fluid" style="object-fit: contain;">
                                    </a>
                                </div>
                                <div class="card-desc">
                                    <hr>
                                    <b>'.$r->nama.'</b>
                                </div>
                            </div>
                        </div>';
                endforeach;
            }else
            {
                echo'<div class="col-md-12 text-center text-danger">
                        <b>BELUM ADA ALUMNI MENGISI</b>
                    </div>
                    <br><br><br><br><br>';
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $pagination; ?>
            </div>
        </div>
    </div>
</section>