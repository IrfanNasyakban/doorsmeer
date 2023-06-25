<?php

if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['aksi'] )){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'baru':
				include 'biaya_baru.php';
				break;
			case 'edit':
				include 'biaya_edit.php';
				break;
			case 'hapus':
				include 'biaya_hapus.php';
				break;
		}
	} else {

		echo '

			<div class="container">
			<div class="col-md-8">
				<h3 style="margin-bottom: -20px; color: #ffffff;">Data Master Biaya Jasa</h3>
				<br/><hr/>

				<table class="table table-bordered">
				 <thead>
				   <tr class="info">
					 <th width="10%">No</th>
					 <th width="35%">Jenis Kendaraan</th>
					 <th width="35%">Biaya</th>
				   </tr>
				 </thead>
				 <tbody>';

			//skrip untuk menampilkan data dari database
		 	$sql = mysqli_query($koneksi, "SELECT * FROM biaya");
		 	if(mysqli_num_rows($sql) > 0){
		 		$no = 0;

				 while($row = mysqli_fetch_array($sql)){
	 				$no++;
	 			echo '

				   <tr style="color: #ffffff;">
					 <td>'.$no.'</td>
					 <td>'.$row['jenis'].'</td>
					 <td>'.$row['biaya'].'</td>';
				}
			}
			echo '
			 	</tbody>
			</table>
			</div>
		</div>';
	}
}
?>
