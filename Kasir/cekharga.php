<?php
$server="localhost";
$username="root";//THE DEFAULT USERNAME OF THE DATABASE
$password="";
$dbname="daftar_barang";
$con=mysqli_connect($server,$username,$password,$dbname) or die("unable to connect");
$id=$_GET['id'];
$sql="SELECT harga FROM barang WHERE id = '$id'";
$result=mysqli_query($con,$sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {    
      echo  $row["harga"];
}
}
?>