<?php
sleep(1);


require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");



$id_provinsi  = $_POST['id_provinsi'];
$id_kabupaten  = $_POST['id_kabupaten'];
$id_provinsi2  = $_POST['id_provinsi2'];
$id_kabupaten2  = $_POST['id_kabupaten2'];


if(isset($_POST["id_provinsi"]) && !empty($_POST["id_provinsi"]))
	{
	echo '<option value="" selected></option>';
	
	$qku = mysql_query("SELECT * FROM kabupaten ".
							"WHERE id_prov = '$id_provinsi' ".
  							"ORDER BY nama ASC");
	$rku = mysql_fetch_assoc($qku);

	do
		{
		$ku_idkab = nosql($rku['id_kab']);
		$ku_nama = balikin($rku['nama']);

		echo '<option value="'.$ku_idkab.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysql_fetch_assoc($qku));
	
	exit();
  	}




if(isset($_POST["id_kabupaten"]) && !empty($_POST["id_kabupaten"]))
	{
	echo '<option value="" selected></option>';
	
	$qku = mysql_query("SELECT * FROM kecamatan ".
							"WHERE id_kab = '$id_kabupaten' ".
  							"ORDER BY nama ASC");
	$rku = mysql_fetch_assoc($qku);

	do
		{
		$ku_idkec = nosql($rku['id_kec']);
		$ku_nama = balikin($rku['nama']);

		echo '<option value="'.$ku_idkec.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysql_fetch_assoc($qku));
	
	exit();
  	}









if(isset($_POST["id_provinsi2"]) && !empty($_POST["id_provinsi2"]))
	{
	echo '<option value="" selected></option>';
	
	$qku = mysql_query("SELECT * FROM kabupaten ".
							"WHERE id_prov = '$id_provinsi2' ".
  							"ORDER BY nama ASC");
	$rku = mysql_fetch_assoc($qku);

	do
		{
		$ku_idkab = nosql($rku['id_kab']);
		$ku_nama = balikin($rku['nama']);

		echo '<option value="'.$ku_idkab.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysql_fetch_assoc($qku));
  	}




if(isset($_POST["id_kabupaten2"]) && !empty($_POST["id_kabupaten2"]))
	{
	echo '<option value="" selected></option>';
	
	$qku = mysql_query("SELECT * FROM kecamatan ".
							"WHERE id_kab = '$id_kabupaten2' ".
  							"ORDER BY nama ASC");
	$rku = mysql_fetch_assoc($qku);

	do
		{
		$ku_idkec = nosql($rku['id_kec']);
		$ku_nama = balikin($rku['nama']);

		echo '<option value="'.$ku_idkec.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysql_fetch_assoc($qku));
	
	exit();
  	}



exit();
?>