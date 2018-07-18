<?php
//KONEKSI ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$koneksi = mysql_connect($xhostname, $xusername, $xpassword) or die(mysql_error());
mysql_select_db($xdatabase);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//random iklan
$qyok = mysql_query("SELECT * FROM member_iklan ".
						"WHERE aktif = 'true' ".
						"ORDER BY RAND()");
$ryok = mysql_fetch_assoc($qyok);
$iklankd = nosql($ryok['kd']);
$memberkd = nosql($ryok['kd_member']);
$randomiklan = balikin($ryok['isi']);
$filexiklan = balikin($ryok['filex_foto']);




//dapatkan ip 
function getrealip()
{
 if (isset($_SERVER)){
if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
if(strpos($ip,",")){
$exp_ip = explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(isset($_SERVER["HTTP_CLIENT_IP"])){
$ip = $_SERVER["HTTP_CLIENT_IP"];
}else{
$ip = $_SERVER["REMOTE_ADDR"];
}
}else{
if(getenv('HTTP_X_FORWARDED_FOR')){
$ip = getenv('HTTP_X_FORWARDED_FOR');
if(strpos($ip,",")){
$exp_ip=explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(getenv('HTTP_CLIENT_IP')){
$ip = getenv('HTTP_CLIENT_IP');
}else {
$ip = getenv('REMOTE_ADDR');
}
}
return $ip; 
}


$MyipAddress = getrealip();


$ipku = $_SESSION['ipnya'];
$iklannya = $_SESSION['iklannya'];

//jika beda
if ($iklannya != $iklankd)
	{
	$_SESSION['ipnya'] = $MyipAddress;
	$_SESSION['iklannya'] = $iklankd; 

	//simpan 
	mysql_query("INSERT INTO member_iklan_ip(kd_member, kd_iklan, ipnya, postdate) VALUES ".
					"('$memberkd', '$iklankd', '$MyipAddress', '$today')");
	}
?>