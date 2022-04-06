<?php

$pg = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'.')));

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/clothmax/assets/backend/dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/summernote/summernote-bs4.min.css">
  <!-- Style -->
  <style type="text/css">
    form label.error {
      color: #d9534f;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="/clothmax/assets/backend/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->