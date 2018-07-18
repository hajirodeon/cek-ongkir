<?php
session_start();


ini_set('max_execution_time', 0);



//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/cp_depan.html");

	


nocache;

//nilai
$filenya = "ongkir.php";
$judul = "Cek Ongkir";
$judulku = $judul;
$s = nosql($_REQUEST['s']);








//isi *START
ob_start();


?>



<!-- Bootstrap core JavaScript -->
<script src="template/vendor/jquery/jquery.min.js"></script>
<script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



<!-- Bootstrap core CSS -->
<link href="template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

 

<script type="text/javascript">
$(document).ready(function() {

$('#loading').ajaxStart(function(){
		$(this).show();
	}).ajaxStop(function(){
		$(this).hide();
	});



$("#fform").load("i_ongkir.php?aksi=daftar");



});
</script>










<div id="fform">
<img src="img/progress-bar.gif" width="100" height="16">

</div>



<div id="loading" style="display:none">
<img src="img/progress-bar.gif" width="100" height="16">
</div>


<div id="fhasil">
</div>




<?php
//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");


exit();
?>