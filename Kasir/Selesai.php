<html>
    <head>
        <title>Kasir=>Berhasil</title>
        <!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </head>
    <Body>
    <div class="mt-4 text-center">
        <h2>Berhasil</h2>
</div>
        <br>
        <?php
          $server="localhost";
          $username="root";//THE DEFAULT USERNAME OF THE DATABASE
          $password="";
          $dbname="daftar_barang";
          $con=mysqli_connect($server,$username,$password,$dbname) or die("unable to connect");
          $tabel=$_GET['keranjang'];
          $total=$_GET['total'];
          date_default_timezone_set('Asia/Jakarta');
          $tanggal=date("Y-m-d H:i:s");
          $ambil="INSERT INTO totalbelanja values('$tanggal', '$total')";
          mysqli_query($con,$ambil);
          mysqli_query($con,"delete from $tabel");
          if($tabel=="keranjang_1"){
            mysqli_query($con,"update statuskeranjang set status='0' where keranjang = '1'");
          }else{
            mysqli_query($con,"update statuskeranjang set status='0' where keranjang = '2'");
          }
          

        ?>
      <div class="mt-4 text-center">
        <h3>Total Belanjaan : Rp <?=$total?></h3>
        <br>
        <a href="kasir.php"><button type="Submit">Kembali</button></a>
      </div>
    </Body>
</html>