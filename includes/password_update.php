<?php if(!defined('myweb')){ exit(); }?>
<?php  

$link_update = $www.'password_update';

$error = '';
$success = '';
$password = '';
$new_password = '';
$repassword = '';

if(isset($_POST['save'])){
	$password = $_POST['password'];
	$new_password = $_POST['new_password'];
	$repassword = $_POST['repassword'];

	if(empty($password) or empty($new_password) or empty($repassword)){
		$error = 'Lengkapi semua form terlebih dahulu';
	}else{
		if($new_password != $repassword){
			$error = 'Password baru tidak sama';
		}else{
			$q = $con->query("SELECT * FROM user WHERE id_user='".$_SESSION['LOGIN_ID']."' and password='".md5($password)."'");
			if ($q->num_rows > 0) {
				$password = md5($new_password);
				$con->query("UPDATE user SET password='".escape($password)."' WHERE id_user='".escape($_SESSION['LOGIN_ID'])."'");
			
				$success = 'Password baru berhasil disimpan';
			}else{
				$error = 'Password saat ini salah';
			}

		}
	}
	if(!empty($error)){
		header('HTTP/1.1 500 Internal Server Error');
		echo $error;
	}elseif(!empty($success)){
		echo $success;
	}
	die;
}

?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-12">
			<div class="content-header">Ubah Password</div>
		</div>
	</div>
	<section>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<!-- <div class="card-header">
			          <h4 class="card-title">Horizontal Form</h4>
			        </div> -->
					<div class="card-content">
						<div class="card-body">
							<form action="<?php echo $link_update;?>" method="post" id="form_edit">
								<div class="form-group">
									<label for="password" class="col-form-label">Password Saat Ini <span class="text-danger">*</span></label>
									<input type="password" class="form-control" name="password" id="password" value="" autofocus required>
								</div>
								<div class="form-group">
									<label for="new_password" class="col-form-label">Password Baru <span class="text-danger">*</span></label>
									<input type="password" class="form-control" name="new_password" id="new_password" value="" required>
								</div>
								<div class="form-group">
									<label for="repassword" class="col-form-label">Ulangi Password Baru <span class="text-danger">*</span></label>
									<input type="password" class="form-control" name="repassword" id="repassword" value="" required>
								</div>
								<div class="form-group">
									<a href="<?php echo $www;?>" class="btn btn-primary"><i class="ft-x"></i> Batal</a>
									<button type="submit" name="save" id="btn_save" class="btn btn-success"><i class="ft-check"></i> Simpan </button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


</div>
<script type="text/javascript">
$(document).ready(function () {
	$('#form_edit').submit(function (e) {
		data = $(this).serializeArray();
		data.push({'name': 'save', 'value': 'true'});
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			beforeSend: function(data) {
		        $('#btn_save').prop('disabled', true);
				$('#alert_error').hide();
			},
			error: function(xhr, status, error) {
		        $('#btn_save').prop('disabled', false);
                Swal.fire({
					text: xhr.responseText,
					icon: "error",
					buttonsStyling: !1,
					confirmButtonText: "OK",
					customClass: { confirmButton: "btn btn-primary" },
				});
			},
			success: function(data) {
		        $('#btn_save').prop('disabled', false);
                Swal.fire({
					text: data,
					icon: "success",
					buttonsStyling: !1,
					confirmButtonText: "OK",
					customClass: { confirmButton: "btn btn-primary" },
				}).then(function () {
					window.location.href = '<?php echo $www;?>';
				});
			}
		});
		e.preventDefault();
	});



})
</script>