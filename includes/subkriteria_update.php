<?php if(!defined('myweb')){ exit(); }?>
<?php  

$link_list = $www.'subkriteria';
$link_update = $www.'subkriteria_update';

$error = '';
$success = '';
$id = '';
$action = 'add';
$id_kriteria = '';
$nama = '';

if(isset($_POST['save'])){
	$id = $_POST['id'];
	if($id != ''){
		$action = 'edit';
	}
	$id_kriteria = $_POST['kriteria'];
	$nama = $_POST['nama'];
	
	if(empty($id_kriteria) or empty($nama)){
		$error = 'Lengkapi kode dan nama terlebih dahulu';
	}else{
		if($action == 'add'){
			$con->query("INSERT INTO subkriteria(id_kriteria, nama) VALUES('".escape($id_kriteria)."', '".escape($nama)."')");
			$success = 'Data sub kriteria berhasil disimpan';

		}elseif($action == 'edit'){
			$con->query("UPDATE subkriteria SET id_kriteria='".escape($id_kriteria)."', nama='".escape($nama)."' WHERE id_subkriteria='".escape($id)."'");
			$success = 'Data sub kriteria berhasil diperbarui';
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
		$q = $con->query("SELECT * FROM subkriteria WHERE id_subkriteria='".escape($id)."'");
		if($q->num_rows == 0){
			exit("<script>location.href='".$link_list."';</script>");
		}
		$h = $q->fetch_assoc();
		$id_kriteria = $h['id_kriteria'];
		$nama = $h['nama'];
	}
}
if($action=='add'){$header='Input Data Sub Kriteria';}else{$header='Ubah Data Sub Kriteria';}
$list_kriteria = '<option value=""></option>';
$q = $con->query("SELECT * FROM kriteria ORDER BY nama");
while($h = $q->fetch_assoc()){
	if($id_kriteria == $h['id_kriteria']){$selected = 'selected';}else{$selected = '';}
	$list_kriteria .= '<option value="'.$h['id_kriteria'].'" '.$selected.'>'.htmlspecialchars($h['nama']).'</option>';
}
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
										<label for="kriteria" class="col-form-label">Kriteria <span class="text-danger">*</span></label>
										<select class="form-control" name="kriteria" id="kriteria" autofocus required><?php echo $list_kriteria; ?></select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nama" class="col-form-label">Nama Sub Kriteria <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="nama" id="nama" value="<?php echo htmlspecialchars($nama);?>" required>
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