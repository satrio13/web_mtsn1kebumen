<div class="container">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                <li class="breadcrumb-item active" aria-current="page">Album</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12"><h3><b><?= $title; ?></b></h3><hr></div>
    </div>
    <div class="row">
        <?php 
        if($galeri->num_rows() > 0)
        {   
            foreach($galeri->result() as $r):
                echo'<div class="col-md-3 mb-3 text-break">
                        <div class="card">';
                            if($r->foto !='' AND file_exists("assets/img/foto/$r->foto"))
                            {
                                echo'<a href="'.base_url("assets/img/foto/$r->foto").'" class="image-link">
                                        <img src="'.base_url("assets/img/foto/$r->foto").'" class="img img-fluid" style="object-fit:contain; width:100%; max-height:150px;">
                                    </a>';
                            }
                        echo'</div>
                    </div>';
            endforeach;
        }else
        {
            echo'<div class="col-md-12 text-center text-danger">
                    <b>BELUM ADA FOTO DI DALAM ALBUM INI</b>
                </div>';
        }
        ?>
    </div>
</div>
<br><br>