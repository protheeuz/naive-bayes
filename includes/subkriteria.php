<?php if(!defined('myweb')){ exit(); }?>
<?php  

$link_list = $www.'subkriteria';
$link_update = $www.'subkriteria_update';

if(isset($_POST['delete']) and isset($_POST['id'])){
	$id = $_POST['id'];
	$con->query("DELETE FROM subkriteria WHERE id_subkriteria = '".escape($id)."'");
	die;
}
$daftar = '';
$q = $con->query("SELECT subkriteria.*, kriteria.nama AS kriteria FROM subkriteria INNER JOIN kriteria ON subkriteria.id_kriteria = kriteria.id_kriteria ORDER BY kriteria.nama, subkriteria.nama");
while($h = $q->fetch_assoc()){
	$id = $h['id_subkriteria'];
	
	$daftar .='
	  <tr>
		<td class="text-center"></td>
		<td class="text-nowrap">'.htmlspecialchars($h['kriteria']).'</td>
		<td class="text-nowrap">'.htmlspecialchars($h['nama']).'</td>
		<td class="text-center text-nowrap">
			<a href="'.$link_update.'/?id='.$id.'" class="btn btn-primary btn-sm"><i class="ft-edit"></i></a>
			<a href="#" class="btn btn-danger btn-sm btn_delete" data-id="'.$id.'"><i class="ft-trash-2"></i></a>
		</td>
	  </tr>
	';
}



?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-12">
			<div class="content-header">Sub Kriteria</div>
		</div>
	</div>
	<section>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
			            <a href="<?php echo $link_update; ?>" class="btn btn-success" ><i class="ft-plus"></i> Sub Kriteria Baru</a>
					</div>
					<div class="card-content">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered" id="tabel">
									<thead>
										<tr>
											<th width="40">NO</th>
											<th>KRITERIA</th>
											<th>SUB KRITERIA</th>
											<th width="70">AKSI</th>
										</tr>
									</thead>
									<tbody>
										<?php echo $daftar;?>
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


</div>
<script type="text/javascript">
$(document).ready(function () {
    var t = $('#tabel').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": [0,3]
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

	$("#tabel").on("click", ".btn_delete", function(){
		var id = $(this).data('id');
		Swal.fire({
			text: "Anda yakin akan menghapus data ini ?",
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Batal',
			customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-danger" },
		}).then((result) => {
			if (result.isConfirmed) {
				data = [];
				data.push({'name': 'id', 'value': id});
				data.push({'name': 'delete', 'value': 'true'});
				$.ajax({
					type: 'POST',
					url: '<?php echo $link_list; ?>',
					data: data,
					error: function(xhr, status, error) {
		                Swal.fire({
							text: xhr.responseText,
							icon: "error",
							buttonsStyling: !1,
							confirmButtonText: "OK",
							customClass: { confirmButton: "btn btn-primary" },
						});
					},
					success: function(data) {
						Swal.fire({
							position: 'top-center',
							icon: 'success',
							text: 'Data berhasil dihapus',
							showConfirmButton: false,
							timer: 1500
						}).then((result) => {
							location.reload();
						})
					}
				});
				/*$.post('<?php echo $link_list; ?>', data, function(result){

					Swal.fire({
						position: 'top-center',
						icon: 'success',
						text: 'Data berhasil dihapus',
						showConfirmButton: false,
						timer: 1500
					}).then((result) => {
						location.reload();
					})
					
				});*/
			}
		})		
		return false;
	});



})
</script>