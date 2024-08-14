<?php if(!defined('myweb')){ exit(); }
$allowedPages = array('hasil', 'home');
if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == 'user') {
    // Hanya menampilkan sidebar untuk peran 'user'
    $allowedPages = array('hasil');
}
foreach ($allowedPages as $page) {
    $isActive = ($current_page == $page) ? 'active' : '';
    $pageURL = $www . $page;

    echo '<li class="' . $isActive . ' nav-item"><a href="' . $pageURL . '"><i class="ft-layers"></i><span class="menu-title">Hasil Analisa</span></a></li>';
}
?>


<div class="app-sidebar menu-fixed" data-background-color="danger" data-image="<?php echo $www;?>assets/img/sidebar-bg/01.jpg" data-scroll-to-active="true">
	<div class="sidebar-header">
		<div class="logo clearfix">
			<a class="logo-text float-left" href="<?php echo $www;?>">
				<!-- <div class="logo-img"><img src="<?php echo $www; ?>assets/img/logo.png" alt="Logo"/></div> -->
				<span class="text">NAIVE BAYES</span>
			</a>
			<!-- <a class="nav-toggle d-none d-lg-none d-xl-block" id="sidebarToggle" href="javascript:;"><i class="toggle-icon ft-toggle-right" data-toggle="expanded"></i></a> -->
			<a class="nav-close d-block d-lg-block d-xl-none" id="sidebarClose" href="javascript:;"><i class="ft-x"></i></a>
		</div>
	</div>
	<div class="sidebar-content main-menu-content">
		<div class="nav-container">
			<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
				<li class="<?php if($current_page==''){echo 'active';}?> nav-item"><a href="<?php echo $www;?>"><i class="ft-home"></i><span class="menu-title">Dashboard</span></a></li>
				<li class="<?php if($current_page=='kriteria' or $current_page=='kriteria_update'){echo 'active';}?> nav-item"><a href="<?php echo $www;?>kriteria"><i class="ft-box"></i><span class="menu-title">Kriteria</span></a></li>
				<li class="<?php if($current_page=='subkriteria' or $current_page=='subkriteria_update'){echo 'active';}?> nav-item"><a href="<?php echo $www;?>subkriteria"><i class="ft-grid"></i><span class="menu-title">Sub Kriteria</span></a></li>
				<li class="<?php if($current_page=='dataset' or $current_page=='dataset_update'){echo 'active';}?> nav-item"><a href="<?php echo $www;?>dataset"><i class="ft-database"></i><span class="menu-title">Dataset</span></a></li>
				<li class="<?php if($current_page=='hasil'){echo 'active';}?> nav-item"><a href="<?php echo $www;?>hasil"><i class="ft-layers"></i><span class="menu-title">Hasil Analisa</span></a></li>
			</ul>
		</div>
	</div>
	<div class="sidebar-background"></div>
</div>
