<?php if(!defined('myweb')){ exit(); }?>
<?php  

$link_list = $www.'kriteria';
$link_update = $www.'kriteria_update';

$error = '';
$success = '';
$id = '';
$action = 'add';
$kode = '';
$nama = '';
$tipe = '';

if(isset($_POST['save'])){
	$id = $_POST['id'];
	if($id != ''){
		$action = 'edit';
	}
	$kode = $_POST['kode'];
	$nama = $_POST['nama'];
	$tipe = $_POST['tipe'];
	
	if(empty($kode) or empty($nama) or empty($tipe)){
		$error = 'Lengkapi kode dan nama terlebih dahulu';
	}else{
		if($action == 'add'){
			$q = $con->query("SELECT * FROM kriteria WHERE kode='".escape($kode)."'");
			if ($q->num_rows > 0) {
				$error = 'Kode sudah terdaftar';
			}else{
				$con->query("INSERT INTO kriteria(kode, nama, tipe) VALUES('".escape($kode)."', '".escape($nama)."', '".escape($tipe)."')");
				$id_kriteria = $con->insert_id;
				if($tipe == 2){
					$con->query("UPDATE kriteria SET tipe = 1 WHERE id_kriteria <> '".escape($id_kriteria)."'");
				}
				$success = 'Data kriteria berhasil disimpan';
			}

		}elseif($action == 'edit'){
			$q = $con->query("SELECT * FROM kriteria WHERE kode='".escape($kode)."' and id_kriteria <> '".escape($id)."'");
			if ($q->num_rows > 0) {
				$error = 'Kode sudah terdaftar';
			}else{
				$con->query("UPDATE kriteria SET kode='".escape($kode)."', nama='".escape($nama)."', tipe='".escape($tipe)."' WHERE id_kriteria='".escape($id)."'");
				if($tipe == 2){
					$con->query("UPDATE kriteria SET tipe = 1 WHERE id_kriteria <> '".escape($id)."'");
				}
				$success = 'Data kriteria berhasil diperbarui';
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


}else{
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$action = 'edit';
		$q = $con->query("SELECT * FROM kriteria WHERE id_kriteria='".escape($id)."'");
		if($q->num_rows == 0){
			exit("<script>location.href='".$link_list."';</script>");
		}
		$h = $q->fetch_assoc();
		$kode = $h['kode'];
		$nama = $h['nama'];
		$tipe = $h['tipe'];
	}
}
if($action=='add'){$header='Input Data Kriteria';}else{$header='Ubah Data Kriteria';}

?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-12">
			<div class="content-header"><?php echo $header;?></div>
		</div>
	</div>
	<section>
		<div class="row">
			<div class="col-12">
				<form action="<?php echo $link_update;?>" method="post" id="form_edit">
				<div class="card">
					<div class="card-content">
						<div class="card-body">
							
							<input name="id" type="hidden" value="<?php echo $id;?>">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="kode" class="col-form-label">Kode <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="kode" id="kode" value="<?php echo htmlspecialchars($kode);?>" autofocus required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nama" class="col-form-label">Nama Kriteria <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="nama" id="nama" value="<?php echo htmlspecialchars($nama);?>" required>
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="" class="col-form-label">Tipe <span class="text-danger">*</span></label>

										<div class="input-group">
											<div class="radio d-inline-block mr-2 mt-1">
												<input type="radio" id="tipe1" name="tipe" value="1" <?php if($tipe == 1){echo 'checked';} ?> required>
												<label for="tipe1">Kondisi</label>
											</div>
											<div class="radio d-inline-block mt-1">
												<input type="radio" id="tipe2" name="tipe" value="2" <?php if($tipe == 2){echo 'checked';} ?> required>
												<label for="tipe2">Target</label>
											</div>
										</div>

									</div>
								</div>

							</div>
							

						</div>
						<div class="card-footer Xborder border-top">
							<a href="<?php echo $link_list;?>" class="btn btn-primary"><i class="ft-x"></i> Batal</a>
							<button type="submit" name="save" id="btn_save" class="btn btn-success"><i class="ft-check"></i> Simpan </button>
						</div>
					</div>
				</div>
				</form>
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
					window.location.href = '<?php echo $link_list;?>';
				});
			}
		});
		e.preventDefault();
	});



})
</script>