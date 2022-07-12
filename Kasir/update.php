<?php
$server="localhost";
$username="root";//THE DEFAULT USERNAME OF THE DATABASE
$password="";
$dbname="daftar_barang";
$con=mysqli_connect($server,$username,$password,$dbname) or die("unable to connect");
$keranjang=$_GET['keranjang'];
$sql="update statuskeranjang set status='1' where keranjang = $keranjang";
$result=mysqli_query($con,$sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {    
    echo  $row["harga"];
  }
}
?>