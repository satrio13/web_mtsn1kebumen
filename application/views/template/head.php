<!DOCTYPE html>
<html lang="id-ID">
  <head>
    <meta charset="utf-8">
    <title><?= $titleweb; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?= meta_description(); ?>">
    <meta name="keywords" content="<?= meta_keyword(); ?>">
    <meta name="author" content="<?= title(); ?>">
    <meta name="language" content="Indonesia">
    <link rel="icon" href="<?= base_url(); ?>assets/img/logo/<?= favicon(); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap-4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/font-awesome-4.3.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito&display=swap">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/owl-carousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/select2/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/AdminLTE-3.0.2/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/magnific-popup.css">
    <style>
      .wafixed{
        position: fixed;
        margin-right: 30px;
        right: 30px;
        bottom: 30px;
        z-index: 999;
      }
      a.wafixed{
        text-decoration: none;
      }
    </style>
  </head>
  <?php $this->home_model->kunjungan(); ?>