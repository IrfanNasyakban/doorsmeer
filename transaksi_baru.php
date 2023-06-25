<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./index.php');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$no_nota = $_REQUEST['no_nota'];
		$jenis = $_REQUEST['jenis'];
		$nama = $_REQUEST['nama'];
		$bayar = $_REQUEST['bayar'];
		$kembali = $_REQUEST['kembali'];
		$total = $_REQUEST['total'];
		$id_user = $_SESSION['id_user'];

		// Menyimpan data ke database
		$sql = mysqli_query($koneksi, "INSERT INTO transaksi(no_nota, jenis, nama, bayar, kembali, total, tanggal, id_user) VALUES('$no_nota', '$jenis', '$nama', '$bayar', '$kembali', '$total', NOW(), '$id_user')");

		if($sql == true){
			header('Location: ./admin.php?hlm=transaksi');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2 style="color: #ffffff;">Tambah Transaksi Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form" style="color: #ffffff;">
	<div class="form-group">
		<label for="no_nota" class="col-sm-2 control-label">No. Nota</label>
		<div class="col-sm-3">

		<?php
			// Mengecek no-nota
			$sql = mysqli_query($koneksi, "SELECT no_nota FROM transaksi");
				echo '<input type="text" class="form-control" id="no_nota" value="';

			$no_nota = "C001";
			if(mysqli_num_rows($sql) == 0){
				echo $no_nota;
			}

			$result = mysqli_num_rows($sql);
			$counter = 0;
			while(list($no_nota) = mysqli_fetch_array($sql)){
				if (++$counter == $result) {
					$no_nota++;
					echo $no_nota;
				}
			}
				echo '"name="no_nota" placeholder="No. Nota" readonly>';

		?>

		</div>
	</div>
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Jenis Kendaraan</label>
		<div class="col-sm-3">
			<select name="jenis" class="form-control" id="jenis" required onchange="updateBiaya()">
			<option value="<?php echo $row['jenis']; ?>">--- Jenis Kendaraan ---</option>
			<?php

				$q = mysqli_query($koneksi, "SELECT jenis FROM biaya");
				while(list($jenis) = mysqli_fetch_array($q)){
					echo '<option value="'.$jenis.'">'.$jenis.'</option>';
				}

			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Biaya</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="biaya" name="biaya" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="bayar" class="col-sm-2 control-label">Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="bayar" name="bayar" placeholder="Isi dengan angka" required>
		</div>
	</div>
	<div class="form-group">
		<label for="kembali" class="col-sm-2 control-label">Kembalian</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="kembali" name="kembali" placeholder="Kembalian" required readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="total" class="col-sm-2 control-label">Total Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="total" name="total" placeholder="Total Bayar" required readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Pelanggan</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pelanggan" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=transaksi" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>
<script>

	function updateBiaya() {
        var jenisKendaraan = document.getElementById("jenis").value;
        var biayaInput = document.getElementById("biaya");

        if (jenisKendaraan === "Sepeda Motor") {
            biayaInput.value = 10000;
        } else if (jenisKendaraan === "Mobil") {
            biayaInput.value = 25000;
        } else {
            biayaInput.value = "";
        }
    }

  $(document).ready(function(){

    $("#bayar").keyup(function(){
        var biaya = $("#biaya").val();
        var bayar = $("#bayar").val();
        $("#kembali").val(bayar - biaya);
        $("#total").val(biaya);
    });

  });
</script>
