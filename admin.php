<?php
session_start();
if( empty( $_SESSION['id_user'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./index.php');
	die();
} else {
	include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Jasa Cuci</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/jquery-ui.min.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>


	<style type="text/css">
	body {
	  min-height: 200px;
	  padding-top: 70px;
	  background-image: linear-gradient(
      115deg,
      rgba(58, 58, 158, 0.8),
      rgba(136, 136, 206, 0.7)
    ),
    url(image/background.jpg);
  	background-size: cover;
	}
	.jumbotron {
		background:rgba(1,1,1,0.5);
	}
	.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    padding: 20px;
    margin-top: 20px;
    flex-basis: 30%;
    text-align: center;
	}
	</style>

  </head>

  <body>

    <?php include "menu.php"; ?>

    <div class="container">

	<?php
	if( isset($_REQUEST['hlm'] )){

		$hlm = $_REQUEST['hlm'];

		switch( $hlm ){
			case 'transaksi':
				include "transaksi.php";
				break;
			case 'laporan':
				include "laporan.php";
				break;
			case 'user':
				include "user.php";
				break;
			case 'biaya':
				include "biaya.php";
				break;
			case 'cetak':
				include "cetak_nota.php";
				break;
		}
	} else {
	?>
      <!-- Main component for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="text-center">
				<img src="image/logo.png" class="rounded" alt="logo" style="max-width: 360px;">
			</div>
			<h2>Selamat Datang di Aplikasi Kasir Jasa Cuci</h2>

        <p style="color: #bfe1e7;">Halo <strong><?php echo $_SESSION['nama']; ?></strong>, Anda login sebagai
			<strong>
			<?php
				if($_SESSION['level'] == 1){
					echo 'Admin.';
				} else {
						echo 'Petugas Kasir.';
				}
			?>
			</strong>
		</p>
      </div>
	  <div class="jumbotron" style="color: #bfe1e7;">
	  <div class="row text-center">
  		<div class="col-md-3">
		  <p>Irvan Nasyakban</p>
		  <img src="image/irvan.png" style="width: 150px;">
		</div>
  		<div class="col-md-3">
		  <p>Widia Hamsi</p>
          <img src="image/widia.png" style="width: 150px;">
		</div>
  		<div class="col-md-3">
		  <p>Muhammad Ariansyah</p>
          <img src="image/ari.png" style="width: 150px;">
		</div>
		<div class="col-md-3">
		  <p>Fannisa Nadira</p>
          <img src="image/fannisa.png" style="width: 150px;">
		</div>
	  </div>
	  </div>
	<?php
	}
	?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript, Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.min.js"></script>
	
  </body>

</html>
<?php
}
?>
