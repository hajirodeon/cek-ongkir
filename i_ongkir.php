<?php
sleep(1);

require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");

nocache;


$filenyax = "$sumber/i_ongkir.php";





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika daftar
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'daftar'))
	{
	sleep(1);
	
	
	?>
	
	

	 
	
	<script type="text/javascript">
	$(document).ready(function() {

			
	
	$("#btnCARI").on('click', function(){
	
		$("#fhasil").hide();
		$('#loading').show();
		
		$("#formx").submit(function(){
			$.ajax({
				url: "<?php echo $sumber;?>/i_ongkir.php?aksi=simpan",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){
					$("#fhasil").show();
					$("#fhasil").html(data);
					$('#loading').hide();
					}
				});
			return false;
		});
	
	});
	
	
	
	
	$('#provinsi').change(function() { 
	     var provinsi = $(this).val(); 
	     $.ajax({
	            type: 'POST', 
	          url: '<?php echo $sumber;?>/i_ongkir_load_data.php', 
	         data: 'id_provinsi=' + provinsi, 
	         success: function(response) { 
	              $('#kabupaten').html(response);
	            }
	       });
	    });
	 
	
	
	
	$('#kabupaten').change(function() { 
	     var kabupaten = $(this).val(); 
	     $.ajax({
	            type: 'POST', 
	          url: '<?php echo $sumber;?>/i_ongkir_load_data.php', 
	         data: 'id_kabupaten=' + kabupaten, 
	         success: function(response) { 
	              $('#kecamatan').html(response);
	            }
	       });
	    });
	
	
	
	
	
	
	
	
	
	
	$('#provinsi2').change(function() { 
	     var provinsi = $(this).val(); 
	     $.ajax({
	            type: 'POST', 
	          url: '<?php echo $sumber;?>/i_ongkir_load_data.php', 
	         data: 'id_provinsi2=' + provinsi, 
	         success: function(response) { 
	              $('#kabupaten2').html(response);
	            }
	       });
	    });
	 
	
	
	
	$('#kabupaten2').change(function() { 
	     var kabupaten = $(this).val(); 
	     $.ajax({
	            type: 'POST', 
	          url: '<?php echo $sumber;?>/i_ongkir_load_data.php', 
	         data: 'id_kabupaten2=' + kabupaten, 
	         success: function(response) { 
	              $('#kecamatan2').html(response);
	            }
	       });
	    });
	
	
	
	
	    
	
	
	});
	</script>
	
	
	
	
	
	
	
	<form name="formx" id="formx">
	
	
	<table border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td align="left">
	
	
	
	
	
	
	<?php
	//Dapatkan semua 
	$query = mysql_query("SELECT * FROM provinsi ".
							"ORDER BY nama ASC");
	$row = mysql_fetch_assoc($query);
	?>
	
	<h3>PENGIRIMAN DARI : </h3> 
	
	<select name="provinsi" id="provinsi" class="btn btn-info btn-block">
	<option value="">- PROVINSI -</option>
	        <?php
	            do
	            	{
	            	$r_idprov = nosql($row['id_prov']);
					$r_nama = balikin($row['nama']);
					 
	                echo '<option value="'.$r_idprov.'">'.$r_nama.'</option>';
					}
				while ($row = mysql_fetch_assoc($query));
	        ?>
	</select>
	
	
	<select name="kabupaten" id="kabupaten" class="btn btn-info btn-block">
	<option value="">- KABUPATEN/KOTA -</option>
	</select>
	
	<select name="kecamatan" id="kecamatan" class="btn btn-info btn-block">
	<option value="">- KECAMATAN -</option>
	</select>
	
	<br>
	<br>
	
	
	
	<h3>TUJUAN :</h3> 
	
	
	<?php
	//Dapatkan semua 
	$query = mysql_query("SELECT * FROM provinsi ".
							"ORDER BY nama ASC");
	$row = mysql_fetch_assoc($query);
	?>
	<select name="provinsi2" id="provinsi2" class="btn btn-info btn-block">
	<option value="">- PROVINSI -</option>
	        <?php
	            do
	            	{
	            	$r_idprov = nosql($row['id_prov']);
					$r_nama = balikin($row['nama']);
					 
	                echo '<option value="'.$r_idprov.'">'.$r_nama.'</option>';
					}
				while ($row = mysql_fetch_assoc($query));
	        ?>
	</select>
	
	
	<select name="kabupaten2" id="kabupaten2" class="btn btn-info btn-block">
	<option value="">- KABUPATEN/KOTA -</option>
	</select>
	
	<select name="kecamatan2" id="kecamatan2" class="btn btn-info btn-block">
	<option value="">- KECAMATAN -</option>
	</select>
	
	
	
	
	<br>
	
	<p>
	<input type="submit" name="btnCARI" id="btnCARI" value="HITUNG ONGKIR JNE/POS/TIKI" class="btn btn-danger btn-block">
	</p>
	
	</form>
	


	<?php
	exit();
	}









//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	sleep(1);


	$provinsi = cegah($_GET["provinsi"]);
	$kabupaten = cegah($_GET["kabupaten"]);
	$kecamatan = cegah($_GET["kecamatan"]);
	$provinsi2 = cegah($_GET["provinsi2"]);
	$kabupaten2 = cegah($_GET["kabupaten2"]);
	$kecamatan2 = cegah($_GET["kecamatan2"]);
	
	
	
	//jika gak lengkap..
	if ((empty($provinsi)) OR (empty($kabupaten)) OR (empty($kecamatan)) OR (empty($provinsi2)) OR (empty($kabupaten2)) OR (empty($kecamatan2)))
		{
		echo "INPUT TIDAK LENGKAP...";
		
		exit();
		}
	else
		{
		//ASAL ////////////////////////////////////////////////////////////////////////////////////
		//ketahui kabupaten...
		$qprop = mysql_query("SELECT * FROM kabupaten ".
								"WHERE id_kab = '$kabupaten'");
		$rprop = mysql_fetch_assoc($qprop);
		$prop1 = balikin($rprop['id_prov']);
		$kota1 = balikin($rprop['id_kab']);
		$kota1_nama = balikin($rprop['nama']);
		
	
		//ketahui propinsinya...
		$qprop = mysql_query("SELECT * FROM provinsi ".
								"WHERE id_prov = '$provinsi'");
		$rprop = mysql_fetch_assoc($qprop);
		$prop1_nama = balikin($rprop['nama']);
		
		//ketahui kecamatan...
		$qprop = mysql_query("SELECT * FROM kecamatan ".
								"WHERE id_kec = '$kecamatan'");
		$rprop = mysql_fetch_assoc($qprop);
		$kec1 = balikin($rprop['id_kec']);
		$kec1_nama = balikin($rprop['nama']);
		
	
	
	
	
		//TUJUAN ////////////////////////////////////////////////////////////////////////////////////
		//ketahui kabupaten...
		$qprop = mysql_query("SELECT * FROM kabupaten ".
								"WHERE id_kab = '$kabupaten2'");
		$rprop = mysql_fetch_assoc($qprop);
		$prop2 = balikin($rprop['id_prov']);
		$kota2 = balikin($rprop['id_kab']);
		$kota2_nama = balikin($rprop['nama']);
		
	
		//ketahui propinsinya...
		$qprop = mysql_query("SELECT * FROM provinsi ".
								"WHERE id_prov = '$provinsi2'");
		$rprop = mysql_fetch_assoc($qprop);
		$prop2_nama = balikin($rprop['nama']);
		
		//ketahui kecamatan...
		$qprop = mysql_query("SELECT * FROM kecamatan ".
								"WHERE id_kec = '$kecamatan2'");
		$rprop = mysql_fetch_assoc($qprop);
		$kec2 = balikin($rprop['id_kec']);
		$kec2_nama = balikin($rprop['nama']);
	
	
	
	
	
	
	
	
	
		//hitung ongkos kirimnya...
		//hitung ongkos kirim
		//asal
		$qku = mysql_query("SELECT * FROM kabupaten ".
								"WHERE id_kab = '$kota1'");
		$rku = mysql_fetch_assoc($qku);
		$ku_kab = nosql($rku['ongkir']);
		$ku_kab_jne_yes = nosql($rku['ongkir_jne_yes']);
		$ku_kab_jne_reg = nosql($rku['ongkir_jne_reg']);
		$ku_kab_pos_express = nosql($rku['ongkir_pos_express']);
		$ku_kab_pos_kilat = nosql($rku['ongkir_pos_kilat']);
		$ku_kab_tiki_express = nosql($rku['ongkir_tiki_express']);
		$ku_kab_tiki_reg = nosql($rku['ongkir_tiki_reguler']);
		
		$qku = mysql_query("SELECT * FROM kecamatan ".
								"WHERE id_kec = '$kec1'");
		$rku = mysql_fetch_assoc($qku);
		$ku_kec = nosql($rku['ongkir']);
		$ku_kec_jne_yes = nosql($rku['ongkir_jne_yes']);
		$ku_kec_jne_reg = nosql($rku['ongkir_jne_reg']);
		$ku_kec_pos_express = nosql($rku['ongkir_pos_express']);
		$ku_kec_pos_kilat = nosql($rku['ongkir_pos_kilat']);
		$ku_kec_tiki_express = nosql($rku['ongkir_tiki_express']);
		$ku_kec_tiki_reg = nosql($rku['ongkir_tiki_reguler']);
	
	
	
	
		//tujuan
		$qku2 = mysql_query("SELECT * FROM kabupaten ".
								"WHERE id_kab = '$kota2'");
		$rku2 = mysql_fetch_assoc($qku2);
		$ku2_kab = nosql($rku2['ongkir']);
		$ku2_kab_jne_yes = nosql($rku2['ongkir_jne_yes']);
		$ku2_kab_jne_reg = nosql($rku2['ongkir_jne_reg']);
		$ku2_kab_pos_express = nosql($rku2['ongkir_pos_express']);
		$ku2_kab_pos_kilat = nosql($rku2['ongkir_pos_kilat']);
		$ku2_kab_tiki_express = nosql($rku2['ongkir_tiki_express']);
		$ku2_kab_tiki_reg = nosql($rku2['ongkir_tiki_reguler']);
		
		$qku2 = mysql_query("SELECT * FROM kecamatan ".
								"WHERE id_kec = '$kec2'");
		$rku2 = mysql_fetch_assoc($qku2);
		$ku2_kec = nosql($rku2['ongkir']);
		$ku2_kec_jne_yes = nosql($rku2['ongkir_jne_yes']);
		$ku2_kec_jne_reg = nosql($rku2['ongkir_jne_reg']);
		$ku2_kec_pos_express = nosql($rku2['ongkir_pos_express']);
		$ku2_kec_pos_kilat = nosql($rku2['ongkir_pos_kilat']);
		$ku2_kec_tiki_express = nosql($rku2['ongkir_tiki_express']);
		$ku2_kec_tiki_reg = nosql($rku2['ongkir_tiki_reguler']);
	
	
	
	
		
		//ongkir propinsi
		$qyuk = mysql_query("SELECT * FROM ongkir_propinsi ".
								"WHERE (propinsi1 = '$prop1_nama' ".
								"AND propinsi2 = '$prop2_nama') ".
								"OR (propinsi1 = '$prop2_nama' ".
								"AND propinsi2 = '$prop1_nama')");
		$ryuk = mysql_fetch_assoc($qyuk);
		$ongkir_prop = nosql($ryuk['ongkir_jne']);
	
	
	
	
	
		
		//jika propinsi sama
		if ($prop1 == $prop2)
			{
			$ongkirya_jne_yes = round($ku_kab_jne_yes + $ku_kec_jne_yes + $ku2_kab_jne_yes + $ku2_kec_jne_yes);
			$ongkirya_jne_reg = round($ku_kab_jne_reg + $ku_kec_jne_reg + $ku2_kab_jne_reg + $ku2_kec_jne_reg);
			$ongkirya_pos_express = round($ku_kab_pos_express + $ku_kec_pos_express + $ku2_kab_pos_express + $ku2_kec_pos_express);
			$ongkirya_pos_kilat = round($ku_kab_pos_kilat + $ku_kec_pos_kilat + $ku2_kab_pos_kilat + $ku2_kec_pos_kilat);
			$ongkirya_tiki_express = round($ku_kab_tiki_express + $ku_kec_tiki_express + $ku2_kab_tiki_express + $ku2_kec_tiki_express);
			$ongkirya_tiki_reg = round($ku_kab_tiki_reg + $ku_kec_tiki_reg + $ku2_kab_tiki_reg + $ku2_kec_tiki_reg);
			}
		
		//jika kabupaten sama
		else if ($kota1 == $kota2)
			{
			$ongkirya_jne_yes = round($ku_kec_jne_yes + $ku2_kec_jne_yes);
			$ongkirya_jne_reg = round($ku_kec_jne_reg + $ku2_kec_jne_reg);
			$ongkirya_pos_express = round($ku_kec_pos_express + $ku2_kec_pos_express);
			$ongkirya_pos_kilat = round($ku_kec_pos_kilat + $ku2_kec_pos_kilat);
			$ongkirya_tiki_express = round($ku_kec_tiki_express + $ku2_kec_tiki_express);
			$ongkirya_tiki_reg = round($ku_kec_tiki_reg + $ku2_kec_tiki_reg);
			}
		else
			{
			//total
			$ongkirya_jne_yes = round($ku_kab_jne_yes + $ku_kec_jne_yes + $ku2_kab_jne_yes + $ku2_kec_jne_yes + $ongkir_prop);
			$ongkirya_jne_reg = round($ku_kab_jne_reg + $ku_kec_jne_reg + $ku2_kab_jne_reg + $ku2_kec_jne_reg + $ongkir_prop);
			$ongkirya_pos_express = round($ku_kab_pos_express + $ku_kec_pos_express + $ku2_kab_pos_express + $ku2_kec_pos_express + $ongkir_prop);
			$ongkirya_pos_kilat = round($ku_kab_pos_kilat + $ku_kec_pos_kilat + $ku2_kab_pos_kilat + $ku2_kec_pos_kilat + $ongkir_prop);
			$ongkirya_tiki_express = round($ku_kab_tiki_express + $ku_kec_tiki_express + $ku2_kab_tiki_express + $ku2_kec_tiki_express + $ongkir_prop);
			$ongkirya_tiki_reg = round($ku_kab_tiki_reg + $ku_kec_tiki_reg + $ku2_kab_tiki_reg + $ku2_kec_tiki_reg + $ongkir_prop);
			}
	


	
		
		echo '<p>
		JNE YES : 
		<br>
		<b>'.xduit2($ongkirya_jne_yes).'</b>
		</p>

		<p>
		JNE REG : 
		<br>
		<b>'.xduit2($ongkirya_jne_reg).'</b>
		</p>
		

		<p>
		POS EXPRESS : 
		<br>
		<b>'.xduit2($ongkirya_pos_express).'</b>
		</p>
		
		<p>
		POS KILAT : 
		<br>
		<b>'.xduit2($ongkirya_pos_kilat).'</b>
		</p>
		
		<p>
		TIKI EXPRESS : 
		<br>
		<b>'.xduit2($ongkirya_tiki_express).'</b>
		</p>
		
		<p>
		TIKI REGULER : 
		<br>
		<b>'.xduit2($ongkirya_tiki_reg).'</b>
		</p>';
		}
	


	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>