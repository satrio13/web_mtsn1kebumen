<section id="isi" class="pt-3 pb-5">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('pengumuman'); ?>">Pengumuman</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-9 text-break">
                <h3><b><?= $title; ?></b></h3>
                <label class="badge badge-primary"><i class="fa fa-clock-o"></i> <?= $data->hari.', '.tgl_indo($data->tgl).', '.date('H:i', strtotime($data->tgl)).' WIB'; ?></label>
                <label class="badge badge-info"><i class="fa fa-user"></i> <?= nama_user($data->id_user); ?></label>
                <label class="badge badge-danger"><i class="fa fa-eye"></i> <?= $data->dibaca; ?>x dibaca</label>
            </div>
        <div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9 text-break">
                <div class="row">
                    <?php if($data->gambar != '' AND file_exists("assets/img/pengumuman/$data->gambar")){ ?>
                        <div class="col-md-12">
                            <a href="<?= base_url("assets/img/pengumuman/$data->gambar"); ?>" class="image-link">
                                <img src="<?= base_url("assets/img/pengumuman/$data->gambar"); ?>" class="img img-fluid">
                            </a>
                        </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <br><?= htmlspecialchars_decode($data->isi); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-none d-sm-none d-md-block">
                <ol class="breadcrumb-homepage breadcrumb bg-theme" style="margin-bottom: 5px">
                    <li class="text-white"><i class="fa fa-newspaper-o"></i> <b>BERITA POPULER</b></li>
                </ol>
                <ul class="list-group">
                    <?php
                    if($berita_terpopuler->num_rows() > 0)
                    {
                        foreach($berita_terpopuler->result() as $r):
                            if($r->gambar != '' AND file_exists("assets/img/berita/$r->gambar"))
                            {
                                $img = $r->gambar;
                            }else
                            {
                                $img = 'no-image.png';
                            }
                            echo'<li class="list-group-item d-flex justify-content-start align-items-start text-break">
                                    <a href="'.base_url("berita/detail/$r->slug").'">
                                        <img src="'.base_url("assets/img/berita/$img").'" class="img img-fluid mr-2" style="max-width: 80px">
                                    </a>
                                    <small>
                                        <a href="'.base_url("berita/detail/$r->slug").'" class="text-dark">'.$r->nama.'</a>
                                        <br><i class="fa fa-calendar"></i> <b>'.date('d M Y', strtotime($r->tgl)).'</b>
                                    </small>
                                </li>';
                        endforeach;
                    }else
                    {
                        echo'<li class="list-group-item d-flex justify-content-center text-danger text-break">
                                <b>BELUM ADA BERITA</b>
                            </li>';
                    }
                    ?>
                </ul>
                <br>
                <ol class="breadcrumb-homepage breadcrumb bg-theme" style="margin-bottom: 5px">
                    <li class="text-white"><i class="fa fa-link"></i> <b>LINK TERKAIT</b></li>
                </ol>
                <ul class="list-group">
                <?php
                    if($link_terkait->num_rows() > 0)
                    {
                        foreach($link_terkait->result() as $r):
                            if(is_url($r->link))
                            {
                                echo'<li class="list-group-item d-flex justify-content-start text-break">
                                        <i class="fa fa-check-circle mr-2 mt-2"></i>      
                                        <a href="'.$r->link.'" class="text-dark">'.$r->nama.'</a>
                                    </li>';           
                            }
                            else
                            {
                                echo'<li class="list-group-item d-flex justify-content-start text-break">
                                        <i class="fa fa-check-circle  mr-2 mt-2"></i>
                                        <a href="javascript:void(0)" class="text-dark" onclick="return alert("LINK OFF")">'.$r->nama.'</a>
                                    </a>';
                            }
                        endforeach;
                    }else
                    {
                        echo'<li class="list-group-item d-flex justify-content-center text-danger text-break">
                                <b>BELUM ADA LINK</b>
                            </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>