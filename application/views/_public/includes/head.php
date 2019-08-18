<?php
if (isset($this->session->userdata)) {
    if (isset($this->session->userdata['login'])) $login = $this->session->userdata['login'];
    if (isset($this->session->userdata['email'])) $email = $this->session->userdata['email'];
    if (isset($this->session->userdata['name'])) $name = $this->session->userdata['name'];
} else {
    header("location: " . base_url() . "login");
}
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('dist/img/favicon.ico'); ?>">



    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/css/main.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/css/orangeHelvetica.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/css/orangeIcons.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/css/boosted.css') ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/AdminLTE/css/AdminLTE.min.css'); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/AdminLTE/css/skins/_all-skins.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('dist/vendors/bootstrap/dist/css/bootstrap.min.css');?>">



    <link href="<?php echo base_url('dist/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo base_url('dist/css/style-izanderson.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/css/style-wendell.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/css/style-andressa.css'); ?>">
    <link href="<?php echo base_url('dist/css/style.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('dist/vendors/jquery/js/jquery.js') ?>"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body id="page-top">

    <div class="body-page">
        <!-- STARTING PAGE -->