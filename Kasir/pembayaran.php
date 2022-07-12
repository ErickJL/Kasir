<!DOCTYPE html>
<html>
<head>
	<title>Kasir</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	</head>
<body>
	<div class="mt-4 text-center">
		<h2>Pembayaran</h2>
		<br/>
		<h3>Daftar Belanjaan</h3>
	
    <?php
        $tabel = $_GET['keranjang']; 
        $judul = $_GET['atas'];
        $total=0;
    ?>

    	<h3><?php echo $judul?></h3>
	</div>
		<div class="mt-3 justify-content-center">
		<table class="table table-stripped" border='3'>
			<tr>
				<th>NO</th>
				<th>Item</th>
				<th>Harga</th>
			</tr>
			<?php 
			$koneksi = mysqli_connect("localhost","root","", "daftar_barang");
			
			// Check connection
			if (mysqli_connect_errno()){
				echo "Koneksi database gagal : " . mysqli_connect_error();
			}
			$no = 1;
			$data = mysqli_query($koneksi,"select * from $tabel");
			while($d = mysqli_fetch_array($data)){
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['item']; ?></td>
					<td>Rp <?php echo $d['harga']; ?></td>
				</tr>
				<?php
				$total=$total+$d['harga']; 
			}
			?>
		</table>
		</div>

			<div class="mt-4 text-center">
		<p>TOTAL : Rp <?= $total?></p>
		<a href="Selesai.php?keranjang=<?=$tabel?>&total=<?=$total?>"><button class="btn btn-primary" type="Submit">Bayar</button></a>
			</div>
</body>
</html>