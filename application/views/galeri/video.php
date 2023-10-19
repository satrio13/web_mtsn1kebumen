<div class="container">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12"><h3><b>GALERI VIDEO</b></h3><hr></div>
    </div>
    <div class="row">
        <?php 
        if($data->num_rows() > 0)
        {
            foreach($data->result() as $r): 
                echo'<div class="col-md-4 mb-3 text-break">
                        <div class="card h-100">
                            <iframe src="https://www.youtube.com/embed/'.$r->link.'"></iframe>
                            <div class="card-body">
                                <p class="card-text"><b>'.$r->judul.'</b></p>
                                <small>'.$r->keterangan.'</small>
                            </div>
                            <div class="card-footer">
                                <small>Waktu Upload: <i class="fa fa-calendar"></i> '.tgl_indo($r->uploaded_on).' <i class="fa fa-clock-o"></i> '.date('H:i', strtotime($r->uploaded_on)).' WIB</small>
                            </div>
                        </div>
                    </div>';
            endforeach; 
        }else
        {
            echo'<div class="col-md-12 text-break text-center text-danger">
                    <b>GALERI VIDEO MASIH KOSONG</b>
                </div>';
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $pagination; ?>
        </div>
    </div>
</div>
<br>