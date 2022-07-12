<?php
$server="localhost";
$username="root";//THE DEFAULT USERNAME OF THE DATABASE
$password="";
$dbname="daftar_barang";
$con=mysqli_connect($server,$username,$password,$dbname) or die("unable to connect");
$keranjang=$_GET['keranjang'];
$sql="SELECT * FROM statuskeranjang WHERE keranjang = '$keranjang'";
$result=mysqli_query($con,$sql);
while($d = mysqli_fetch_array($result)){
  $statuss=$d['status'];
}
if($statuss=='0'){
  $sql="update statuskeranjang set status='1' where keranjang = $keranjang";
  $result=mysqli_query($con,$sql);
  echo "-1,Terima,Kasih!";
}else{
  echo "0,Pesanan,Belum Dibayar";
}
?>