<?php if(!defined('myweb')){ exit(); }?>

<!DOCTYPE html>
<html class="loading" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<title>Aplikasi Sistem Penentuan Keputusan Metode Naive Bayes - Rizky <?php echo date('Y'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $www; ?>favicon.ico">
	<link rel="shortcut icon" type="image/png" href="<?php echo $www; ?>favicon.ico">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/fonts/feather/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/fonts/simple-line-icons/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/fonts/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/vendors/css/perfect-scrollbar.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/vendors/css/prism.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/vendors/css/switchery.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/bootstrap-extended.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/colors.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/components.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/themes/layout-dark.min.css">
	<link rel="stylesheet" href="<?php echo $www; ?>assets/css/plugins/switchery.min.css">
	<link rel="stylesheet" href="<?php echo $www; ?>assets/css/pages/authentication.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/style.css">
	<script src="<?php echo $www; ?>assets/vendors/js/vendors.min.js"></script>
	<script src="<?php echo $www; ?>assets/vendors/js/switchery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/vendors/css/datatables/dataTables.bootstrap4.min.css">
	<script src="<?php echo $www; ?>assets/vendors/js/datatable/jquery.dataTables.min.js"></script>
  <script src="<?php echo $www; ?>assets/vendors/js/datatable/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo $www; ?>assets/js/sweetalert2.all.min.js"></script>
	<link href="<?php echo $www; ?>assets/css/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="vertical-layout vertical-menu 2-columns navbar-sticky" data-menu="vertical-menu" data-col="2-columns">

    <?php include 'header.php';?>

    <div class="wrapper">

      <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
      <?php include 'sidebar.php';?>
      <div class="main-panel">
        <div class="main-content">
          <div class="content-overlay"></div>
          <?php eval($CONTENT_["main"]);?>
        </div>

        <?php include 'footer.php';?>
      </div>
    </div>
  <script src="<?php echo $www; ?>assets/js/core/app-menu.min.js"></script>
  <script src="<?php echo $www; ?>assets/js/core/app.min.js"></script>
  <script src="<?php echo $www; ?>assets/js/notification-sidebar.min.js"></script>
  <script src="<?php echo $www; ?>assets/js/customizer.min.js"></script>
  <script src="<?php echo $www; ?>assets/js/scroll-top.min.js"></script>
  <!-- <script type="text/javascript">
  setTimeout(function() {
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.src = "http://localhost/k-means/assets/js/core/app-menu.min.js";
        $('body').append(s);
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.src = "http://localhost/k-means/assets/js/core/app.min.js";
        $('body').append(s);

  }, 1000);    
  </script> -->
</body>

</html>