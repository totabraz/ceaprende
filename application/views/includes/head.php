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
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('dist/img/favicon.ico'); ?>">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/font-awesome/css/font-awesome.min.css'); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/Ionicons/css/ionicons.min.css'); ?>">

    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/morris.js/morris.css'); ?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/jvectormap/jquery-jvectormap.css'); ?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap-daterangepicker/daterangepicker.css'); ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/AdminLTE/plugins/iCheck/square/blue.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/AdminLTE/css/AdminLTE.min.css'); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/AdminLTE/css/skins/_all-skins.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('dist/css/style-izanderson.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/css/style-wendell.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/css/style-andressa.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/css/style.css'); ?>">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- jQuery 3 -->
    <script src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js'); ?>"></script>
</head>