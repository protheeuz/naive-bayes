<?php if(!defined('myweb')){ exit(); }?>
<?php  
$q = $con->query("SELECT * FROM user WHERE id_user='".escape($_SESSION['LOGIN_ID'])."'");
$h = $q->fetch_assoc();
$nama = $h['nama'];


?>
<div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>
<nav class="navbar navbar-expand-lg navbar-light header-navbar navbar-fixed">
	<div class="container-fluid navbar-wrapper">
		<div class="navbar-header Xd-flex">
		<div class="navbar-toggle menu-toggle d-xl-none d-block float-left align-items-center justify-content-center" data-toggle="collapse"><i class="ft-menu font-medium-5"></i></div>
		<!-- <ul class="navbar-nav">
		<li class="nav-item mr-2 d-none d-lg-block"><a class="nav-link apptogglefullscreen" id="navbar-fullscreen" href="javascript:;"><i class="ft-maximize font-medium-3"></i></a></li>
		<li class="nav-item nav-search"><a class="nav-link nav-link-search" href="javascript:"><i class="ft-search font-medium-3"></i></a>
		<div class="search-input">
		<div class="search-input-icon"><i class="ft-search font-medium-3"></i></div>
		<input class="input" type="text" placeholder="Pencarian..." tabindex="0" data-search="template-search">
		<div class="search-input-close"><i class="ft-x font-medium-3"></i></div>
		<ul class="search-list"></ul>
		</div>
		</li>
		</ul> -->
		</div>
		<div class="navbar-container">
			<div class="collapse navbar-collapse d-block" id="navbarSupportedContent">
				<ul class="navbar-nav">
					<li class="dropdown nav-item mr-1">
						<a class="nav-link dropdown-toggle user-dropdown d-flex align-items-end" id="dropdownBasic2" href="javascript:;" data-toggle="dropdown">
							<div class="user d-md-flex d-none mr-2">
								<span class="text-right"><?php echo htmlspecialchars($nama); ?></span>
								<span class="text-right text-muted font-small-3">Admin</span>
							</div>
							<img class="avatar" src="<?php echo $www; ?>assets/img/blank.png" alt="avatar" height="35" width="35">
						</a>
						<div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0" aria-labelledby="dropdownBasic2">
							<a class="dropdown-item" href="<?php echo $www; ?>password_update">
								<div class="d-flex align-items-center"><i class="ft-edit mr-2"></i><span>Ubah Password</span></div>
							</a>

							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?php echo $www; ?>logout.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    						<div class="d-flex align-items-center"><i class="ft-power mr-2"></i><span>Logout</span></div>
							</a>
							<form id="logout-form" action="<?php echo $www; ?>logout.php" method="POST" style="display: none;">
    <!-- Form ini akan di-submit secara otomatis saat tautan Logout di-klik -->
							</form>
							</a>
						</div>
					</li>
					<!-- <li class="nav-item d-none d-lg-block mr-2 mt-1"><a class="nav-link notification-sidebar-toggle" href="javascript:;"><i class="ft-align-right font-medium-3"></i></a></li> -->
				</ul>
			</div>
		</div>
	</div>
</nav>