<?php
$server="localhost";
$username="root";//THE DEFAULT USERNAME OF THE DATABASE
$password="";
$dbname="daftar_barang";
$con=mysqli_connect($server,$username,$password,$dbname) or die("unable to connect");
$id=$_GET['id'];
$keranjang=$_GET['keranjang'];
$sql="SELECT * FROM barang WHERE id = '$id'";
$result=mysqli_query($con,$sql);
while($d = mysqli_fetch_array($result)){
    $nama=$d['nama'];
    $harga=$d['harga'];
    $kirim="{$harga}".",".$nama.","."{$harga}";
    if($keranjang=="1"){
        $ambil="INSERT INTO keranjang_1 values('$nama', '$harga')";
    }else{
        $ambil="INSERT INTO keranjang_2 values('$nama', '$harga')"; 
    }
    mysqli_query($con,$ambil);
    $stok=$d['Stok'];
    $stok=$stok-1;
    mysqli_query($con,"update barang set stok=$stok where id = $id");
}
echo $kirim;
//echo $keranjang;
?>