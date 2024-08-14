<?php if(!defined('myweb')){ exit(); }?>
<?php  

$link_list = $www.'dataset';
$link_update = $www.'dataset_update';

$error = '';
$success = '';
$id = '';
$action = 'add';
$kode = '';
$dataset = array();
$kriteria = array();
$q = $con->query("SELECT * FROM kriteria ORDER BY kode");
while($h = $q->fetch_array()){
	$kriteria[] = array('id'=>$h['id_kriteria'], 'kode'=>$h['kode'], 'nama'=>htmlspecialchars($h['nama']));
}

if(isset($_POST['save'])){
	$id = $_POST['id'];
	if($id != ''){
		$action = 'edit';
	}
	$kode = $_POST['kode'];
	if(empty($kode)){
		$error = 'Lengkapi kode terlebih dahulu';
	}else{

		if($action == 'add'){
			$q = $con->query("SELECT * FROM dataset WHERE kode='".escape($kode)."'");
			if ($q->num_rows > 0) {
				$error = 'Kode sudah terdaftar';
			}else{
				$con->query("INSERT INTO dataset(kode) VALUES('".escape($kode)."')");
				$id_dataset = $con->insert_id;
				foreach ($kriteria as $key => $value) {
					$id_kriteria = $value['id'];
					$con->query("INSERT INTO dataset_detail(id_dataset, id_subkriteria) VALUES('".escape($id_dataset)."', '".escape($_POST['kriteria_'.$id_kriteria])."')");
				}
				$success = 'Data dataset berhasil disimpan';
			}
			$success = 'Data dataset berhasil disimpan';

		}elseif($action == 'edit'){
			$q = $con->query("SELECT * FROM dataset WHERE kode='".escape($kode)."' and id_dataset <> '".escape($id)."'");
			if ($q->num_rows > 0) {
				$error = 'Kode sudah terdaftar';
			}else{
				$con->query("UPDATE dataset SET kode='".escape($kode)."' WHERE id_dataset='".escape($id)."'");
				$con->query("DELETE FROM dataset_detail WHERE id_dataset='".escape($id)."'");
				foreach ($kriteria as $key => $value) {
					$id_kriteria = $value['id'];
					$con->query("INSERT INTO dataset_detail(id_dataset, id_subkriteria) VALUES('".escape($id)."', '".escape($_POST['kriteria_'.$id_kriteria])."')");
				}
				$success = 'Data dataset berhasil diperbarui';
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
		$q = $con->query("SELECT * FROM dataset WHERE id_dataset='".escape($id)."'");
		if($q->num_rows == 0){
			exit("<script>location.href='".$link_list."';</script>");
		}
		$h = $q->fetch_assoc();
		$kode = $h['kode'];
		
		$q = $con->query("SELECT * FROM dataset_detail INNER JOIN subkriteria ON dataset_detail.id_subkriteria = subkriteria.id_subkriteria WHERE dataset_detail.id_dataset='".escape($id)."'");
		while($h = $q->fetch_array()){
			$dataset[$h['id_kriteria']] = $h['id_subkriteria'];
		}
	}
}
if($action=='add'){$header='Input Data Dataset';}else{$header='Ubah Data Dataset';}

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
							<div class="form-group">
								<label for="kode" class="col-form-label">Kode <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="kode" id="kode" value="<?php echo htmlspecialchars($kode);?>" autofocus required>
							</div>
							<?php  
							foreach ($kriteria as $key => $value) {
								$id_kriteria = $value['id'];
								echo '
								<div class="form-group">
									<label for="kriteria_'.$id_kriteria.'" class="col-form-label">'.$value['nama'].' <span class="text-danger">*</span></label>
									<select class="form-control" name="kriteria_'.$id_kriteria.'" id="kriteria_'.$id_kriteria.'" required>';
								echo '<option value=""></option>';
								$q = $con->query("SELECT * FROM subkriteria WHERE id_kriteria = '".escape($id_kriteria)."' ORDER BY id_subkriteria");
								while($h = $q->fetch_array()){
									if(isset($dataset[$id_kriteria]) and $dataset[$id_kriteria] == $h['id_subkriteria']){$selected = 'selected';}else{$selected = '';}
									echo '<option value="'.$h['id_subkriteria'].'" '.$selected.'>'.htmlspecialchars($h['nama']).'</option>';
								}
								echo '
									</select>
								</div>
								';
							}

							?>
							

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