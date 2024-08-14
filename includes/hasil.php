<?php if(!defined('myweb')){ exit(); }?>
<?php  

$kriteria = array();
$q = $con->query("SELECT * FROM kriteria ORDER BY kode");
while($h = $q->fetch_assoc()){
	$kriteria[] = array('id'=>$h['id_kriteria'], 'kode'=>htmlspecialchars($h['kode']), 'nama'=>htmlspecialchars($h['nama']), 'tipe'=>$h['tipe']);
}

?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-12">
			<div class="content-header">Hasil Analisa</div>
		</div>
	</div>
	<section>
		<div class="row">
			<div class="col-12">
				<form action="<?php echo $www; ?>analisa" method="post" id="form_analisa">
				<div class="card">
					<div class="card-content">
						<div class="card-body">
							
							<?php  
							foreach ($kriteria as $key => $value) {
								if($value['tipe'] == 1){
									$id_kriteria = $value['id'];
									echo '
									<div class="form-group">
										<label for="kriteria_'.$id_kriteria.'" class="col-form-label">'.$value['nama'].'</label>
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
							}

							?>
							

						</div>
						<div class="card-footer Xborder border-top text-center">
							<button type="submit" name="save" id="btn_hitung" class="btn btn-success"><i class="ft-check"></i> Hitung </button>
						</div>
					</div>
				</div>
				</form>

				<div id="hasil"></div>

			</div>
		</div>
	</section>


</div>

<script type="text/javascript">
$(document).ready(function () {
	$('#form_analisa').submit(function (e) {
		data = $(this).serializeArray();
		data.push({'name': 'hitung', 'value': 'true'});
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			beforeSend: function(data) {
		        $('#btn_hitung').prop('disabled', true);
			},
			error: function(xhr, status, error) {
		        $('#btn_hitung').prop('disabled', false);
                Swal.fire({
					text: xhr.responseText,
					icon: "error",
					buttonsStyling: !1,
					confirmButtonText: "OK",
					customClass: { confirmButton: "btn btn-primary" },
				});
			},
			success: function(data) {
		        $('#btn_hitung').prop('disabled', false);
		        $('#hasil').html(data);

			}
		});
		e.preventDefault();
	});



})
</script>
