<?php if(!defined('myweb')){ exit(); }?>
<?php  

$kriteria = array();
$q = $con->query("SELECT * FROM kriteria ORDER BY kode");
while($h = $q->fetch_assoc()){
	$kriteria[] = array('id'=>$h['id_kriteria'], 'kode'=>htmlspecialchars($h['kode']), 'nama'=>htmlspecialchars($h['nama']), 'tipe'=>$h['tipe']);
}
$subkriteria = array();
$list_nama_subkriteria = array();
$q = $con->query("SELECT subkriteria.* FROM subkriteria INNER JOIN kriteria ON subkriteria.id_kriteria = kriteria.id_kriteria ORDER BY subkriteria.id_subkriteria");
while($h = $q->fetch_assoc()){
	$subkriteria[$h['id_kriteria']][] = array('id'=>$h['id_subkriteria'], 'nama'=>htmlspecialchars($h['nama']));
	$list_nama_subkriteria[$h['id_subkriteria']] = htmlspecialchars($h['nama']);
}
$subkriteria_target = array();
$q = $con->query("SELECT subkriteria.* FROM subkriteria INNER JOIN kriteria ON subkriteria.id_kriteria = kriteria.id_kriteria WHERE kriteria.tipe = 2 ORDER BY subkriteria.id_subkriteria");
while($h = $q->fetch_assoc()){
	$subkriteria_target[] = array('id'=>$h['id_subkriteria'], 'nama'=>htmlspecialchars($h['nama']));
}

$subkriteria_user = array();
foreach ($kriteria as $key => $value) {
	if($value['tipe'] == 1){
		if(isset($_POST['kriteria_'.$value['id']])){
			$subkriteria_user[$value['id']] = $_POST['kriteria_'.$value['id']];
		}
	}
}

//$nilai_dataset = array();
$daftar_dataset = '';
$q = $con->query("SELECT * FROM dataset ORDER BY kode");
while($h = $q->fetch_assoc()){
	$id = $h['id_dataset'];
	
	$daftar_dataset .='
	<tr>
	<td class="text-center"></td>
	<td class="text-nowrap">'.htmlspecialchars($h['kode']).'</td>';
	foreach ($kriteria as $key => $value) {
		$id_kriteria = $value['id'];
		$qq = $con->query("SELECT subkriteria.* FROM dataset_detail INNER JOIN subkriteria ON dataset_detail.id_subkriteria = subkriteria.id_subkriteria WHERE dataset_detail.id_dataset='".escape($id)."' AND subkriteria.id_kriteria = '".escape($id_kriteria)."'");
		if($qq->num_rows > 0){
			$hh = $qq->fetch_assoc();
			$nama_subkriteria = $hh['nama'];
		}else{
			$nama_subkriteria = '';
		}
		//$nilai_dataset[$id_alternatif][$id_kriteria] = (float)$nilai;
		$daftar_dataset .= '<td class="text-nowrap">'.htmlspecialchars($nama_subkriteria).'</td>';
	}	
	$daftar_dataset .='	
	</tr>
	';
}

$nilai_probabilitas_prior = array();
$daftar_probabilitas_prior = '';
$q = $con->query("SELECT COUNT(*) AS jml FROM dataset");
$h = $q->fetch_assoc();
$jumlah_dataset = (int)$h['jml'];
foreach ($subkriteria_target as $key => $value) {
	$id_subkriteria = $value['id'];
	$nama_subkriteria = $value['nama'];

	$qq = $con->query("SELECT COUNT(*) AS jml FROM dataset_detail WHERE id_subkriteria = '".escape($id_subkriteria)."'");
	$hh = $qq->fetch_assoc();
	$frekuensi = (int)$hh['jml'];
	$probabilitas = $frekuensi / $jumlah_dataset;
	$nilai_probabilitas_prior[$id_subkriteria] = $probabilitas;

	$daftar_probabilitas_prior .='
	<tr>
	<td class="text-nowrap">'.$nama_subkriteria.'</td>
	<td class="text-center">'.$frekuensi.'</td>
	<td class="text-center">'.round($probabilitas, 4).'</td>
	</tr>
	';
}

$nilai_probabilitas_kondisi = array();
$daftar_probabilitas_kondisi = array();
$jumlah_dataset = array();
foreach ($kriteria as $key => $value) { 
	$id_kriteria = $value['id'];
	if($value['tipe'] == 1){
		$daftar_probabilitas_kondisi[$id_kriteria] = '';

		$ada_frekuensi_nol = false;
		foreach ($subkriteria_target as $key2 => $value2) {
			$id_subkriteria = $value2['id'];
			$q = "
			SELECT * FROM subkriteria WHERE id_kriteria = '".escape($id_kriteria)."' AND id_subkriteria NOT IN (
			SELECT id_subkriteria FROM dataset_detail WHERE id_dataset IN (
				SELECT id_dataset FROM dataset_detail WHERE id_subkriteria = '".escape($id_subkriteria)."') 
			)
			";
			$q = $con->query($q);
			if ($q->num_rows > 0) {
				$ada_frekuensi_nol = true;
			}
		}
		foreach ($subkriteria_target as $key2 => $value2) {
			$id_subkriteria = $value2['id'];
			$q = $con->query("SELECT COUNT(*) AS jml FROM dataset_detail WHERE id_subkriteria = '".escape($id_subkriteria)."' AND id_dataset IN (SELECT dataset_detail.id_dataset FROM dataset_detail INNER JOIN subkriteria ON dataset_detail.id_subkriteria = subkriteria.id_subkriteria WHERE subkriteria.id_kriteria = '".escape($id_kriteria)."')");
			$h = $q->fetch_assoc();
			if($ada_frekuensi_nol){
				$jumlah_dataset[$id_subkriteria] = (int)$h['jml'] + count($subkriteria[$id_kriteria]);
			}else{
				$jumlah_dataset[$id_subkriteria] = (int)$h['jml'];
			}
		}

		foreach ($subkriteria[$id_kriteria] as $key2 => $value2) {
			$id_subkriteria = $value2['id'];
			$nama_subkriteria = $value2['nama'];

			$daftar_probabilitas_kondisi[$id_kriteria] .='
			<tr>
			<td class="text-nowrap">'.$nama_subkriteria.'</td>';
			foreach ($subkriteria_target as $key3 => $value3) {
				$id_subkriteria2 = $value3['id'];
				$q = $con->query("SELECT COUNT(*) AS jml FROM dataset_detail WHERE id_subkriteria = '".escape($id_subkriteria)."' AND id_dataset IN (SELECT id_dataset FROM dataset_detail WHERE id_subkriteria = '".escape($id_subkriteria2)."')");
				$h = $q->fetch_assoc();
				$frekuensi = (int)$h['jml'];
				if($ada_frekuensi_nol){
					$frekuensi++;
				}
				$daftar_probabilitas_kondisi[$id_kriteria] .='<td class="text-center">'.$frekuensi.'</td>';
			}
			foreach ($subkriteria_target as $key3 => $value3) {
				$id_subkriteria2 = $value3['id'];
				$q = $con->query("SELECT COUNT(*) AS jml FROM dataset_detail WHERE id_subkriteria = '".escape($id_subkriteria)."' AND id_dataset IN (SELECT id_dataset FROM dataset_detail WHERE id_subkriteria = '".escape($id_subkriteria2)."')");
				$h = $q->fetch_assoc();
				$frekuensi = (int)$h['jml'];
				if($ada_frekuensi_nol){
					$frekuensi++;
				}
				$probabilitas = $frekuensi / $jumlah_dataset[$id_subkriteria2];
				$nilai_probabilitas_kondisi[$id_kriteria][$id_subkriteria2][$id_subkriteria] = $probabilitas;

				$daftar_probabilitas_kondisi[$id_kriteria] .='<td class="text-center">'.round($probabilitas, 4).'</td>';
			}

			$daftar_probabilitas_kondisi[$id_kriteria] .='
			</tr>
			';
		}

	}
}

$daftar_klasifikasi = '';
$nilai_klasifikasi_max = 0;
$hasil_klasifikasi = '';
foreach ($subkriteria_target as $key => $value) {
	$id_subkriteria = $value['id'];
	$nama_subkriteria = $value['nama'];
	$nilai_akhir = 1;

	$daftar_klasifikasi .='
	<tr>
	<td class="text-nowrap">'.$nama_subkriteria.'</td>';
	foreach ($kriteria as $key2 => $value2) { 
		$id_kriteria = $value2['id'];
		if($value2['tipe'] == 1){
			$nilai_akhir = $nilai_akhir * $nilai_probabilitas_kondisi[$id_kriteria][$id_subkriteria][$subkriteria_user[$id_kriteria]];
			$daftar_klasifikasi .='
			<td class="text-center">'.round($nilai_probabilitas_kondisi[$id_kriteria][$id_subkriteria][$subkriteria_user[$id_kriteria]], 4).'</td>';
		}
	}
	$nilai_akhir = $nilai_akhir * $nilai_probabilitas_prior[$id_subkriteria];
	if($nilai_akhir > $nilai_klasifikasi_max){
		$nilai_klasifikasi_max = $nilai_akhir;
		$hasil_klasifikasi = $nama_subkriteria;
	}
	$daftar_klasifikasi .='
	<td class="text-center">'.round($nilai_probabilitas_prior[$id_subkriteria], 4).'</td>
	<td class="text-center">'.round($nilai_akhir, 4).'</td>
	</tr>
	';

}

?>

<div class="card">
	<div class="card-header">
        <h4 class="card-title">Dataset</h4>
	</div>
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="tabel_dataset">
					<thead>
						<tr>
							<th width="40">NO</th>
							<th>KODE</th>
							<?php  
							foreach ($kriteria as $key => $value) {
								echo '<th>'.strtoupper($value['nama']).'</th>';
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php echo $daftar_dataset;?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-header">
        <h4 class="card-title">Probabilitas Prior</h4>
	</div>
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>TARGET</th>
							<th class="text-center">FREKUENSI</th>
							<th class="text-center">PROBABILITAS</th>
						</tr>
					</thead>
					<tbody>
						<?php echo $daftar_probabilitas_prior;?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
<?php 
foreach ($kriteria as $key => $value) { 
	$id_kriteria = $value['id'];
if($value['tipe'] == 1){
?>
<div class="card">
	<div class="card-header">
        <h4 class="card-title">Probabilitas Kondisi <?php echo $value['nama']; ?></h4>
	</div>
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th rowspan="2">SUB KRITERIA</th>
							<th class="text-center" colspan="2">FREKUENSI</th>
							<th class="text-center" colspan="2">PROBABILITAS</th>
						</tr>
						<tr>
							<?php 
							foreach ($subkriteria_target as $key2 => $value2) {
								echo '<th>'.strtoupper($value2['nama']).'</th>';
							} 
							foreach ($subkriteria_target as $key2 => $value2) {
								echo '<th>'.strtoupper($value2['nama']).'</th>';
							} 
							?>
						</tr>
					</thead>
					<tbody>
						<?php echo $daftar_probabilitas_kondisi[$id_kriteria];?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
<?php }} ?>

<div class="card">
	<div class="card-header">
        <h4 class="card-title">Perhitungan Klasifikasi</h4>
	</div>
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th rowspan="3">KATEGORI</th>
							<th class="text-center" colspan="<?php echo count($kriteria) - 1; ?>">PROBABILITAS KONDISI</th>
							<th class="text-center" rowspan="3">PROBABILITAS PRIOR</th>
							<th class="text-center" rowspan="3">NILAI AKHIR</th>
						</tr>
						<tr>
							<?php 
							foreach ($kriteria as $key => $value) {
								if($value['tipe'] == 1){
									echo '<th class="text-center">'.strtoupper($value['nama']).'</th>';
								}
							}
							?>
						</tr>
						<tr>
							<?php 
							foreach ($kriteria as $key => $value) {
								if($value['tipe'] == 1){
									echo '<th class="text-center">'.strtoupper($list_nama_subkriteria[$subkriteria_user[$value['id']]]).'</th>';
								}
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php echo $daftar_klasifikasi;?>
					</tbody>
				</table>

			</div>

			<h3 class="alert alert-info text-center">
				<?php  
				if($hasil_klasifikasi == 'Kecil'){
					echo 'Teridentifikasi Tidak Kecanduan Game';
				}elseif($hasil_klasifikasi == 'Sedang'){
					echo 'Teridentifikasi Kecanduan Game';
				}elseif($hasil_klasifikasi == 'Besar'){
					echo 'Teridentifikasi Sangat Kecanduan Game';
				}
				?>
			</h3>
		</div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function () {
    var t = $('#tabel_dataset').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": [0]
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();




})
</script>