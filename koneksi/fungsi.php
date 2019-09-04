<?php
// session_start();
$server   = "localhost";
$username = "root";
$password = "";
$database = "pokir";
$konek 	  = mysql_connect($server, $username, $password) or die ("Gagal konek ke server MySQL" .mysql_error());
$bukadb   = mysql_select_db($database) or die ("Gagal membuka database $database" .mysql_error());

function cInput($type, $size, $id, $name, $value) {
	echo "<tr><td colspan=\"3\"><input type=\"$type\" size=\"$size\" id=\"$id\" name=\"$name\" value=\"$value\" class=\"form-control\"></td></tr>";
}
function cInput2($label, $size, $name,  $value) {
	$pc_label = explode("|", $label);
	$pc_name  = explode("|", $name);
	$pc_size  = explode("|", $size);
	$pc_value = explode("|", $value);

	$label1 = $pc_label[0]; $label2 = $pc_label[1];
	$name1 = $pc_name[0]; $name2 = $pc_name[1];
	$size1 = $pc_size[0]; $size2 = $pc_size[1];
	$value1 = $pc_value[0]; $value2 = $pc_value[1];

	echo "
	<tr>
	<td width=\"20%\">$label1</td><td width=\"30%\"><input type=\"text\" name=\"$name1\" size=\"$size1\" value=\"$value1\" class=\"form-control\"></td>
	<td width=\"20%\">$label2</td><td width=\"30%\"><input type=\"text\" name=\"$name2\" size=\"$size2\" value=\"$value2\" class=\"form-control\"></td>
	</tr>";
}
function cInputtext($name,  $value) {
	echo "<tr><td colspan=\"3\"><textarea type=\"text\" name=\"$name\" value=\"$value\" class=\"form-control\"> </textarea></td></tr>";
}

function cRadio( $name, $label, $value, $isi) {
	$pc_label = explode("|", $label);
	$pc_value = explode("|", $value);
	$j_radio = count($pc_label);


	for ($i = 0; $i < $j_radio; $i++) {
		if ($pc_value[$i] == $isi) {
			echo "\r<label><input type='radio' name='$name' id='optionsRadios1' value='$pc_value[$i]' checked>&nbsp;$pc_label[$i]</label>&nbsp;";
		} else {
			echo "\r<label><input type='radio' name='$name' id='optionsRadios1' value='$pc_value[$i]'>&nbsp;$pc_label[$i]</label>&nbsp;";
		}
	}
	echo "</td>\r</tr>";
}

function getdapil($id_dapil) {
	$q = mysql_query("SELECT * FROM t_dapil WHERE id_dapil='$id_dapil'");
	$a = mysql_fetch_array($q);
	return $a[1];
}

function getfraksi($id_fraksi) {
	$q = mysql_query("SELECT * FROM t_fraksi WHERE id_fraksi='$id_fraksi'");
	$a = mysql_fetch_array($q);
	return $a[2];
}

function getkecamatan($id_kecamatan) {
	$q = mysql_query("SELECT * FROM kecamatan WHERE id_kec='$id_kecamatan'");
	$a = mysql_fetch_array($q);
	return $a[1];
}

function getdesa($id_desa) {
	$q = mysql_query("SELECT * FROM desa WHERE id_desa='$id_desa'");
	$a = mysql_fetch_array($q);
	return $a[2];
}

function getbidang($id_bidang) {
	$q = mysql_query("SELECT * FROM bidang WHERE id_bidang='$id_bidang'");
	$a = mysql_fetch_array($q);
	return $a[2];
}
function getdprd($id_dprd) {
	$q = mysql_query("SELECT * FROM t_dprd WHERE id_dprd='$id_dprd'");
	$a = mysql_fetch_array($q);
	return $a[1];
}
function getreses($id_reses) {
	$q = mysql_query("SELECT * FROM t_reses WHERE id_reses='$id_reses'");
	$a = mysql_fetch_array($q);
	return $a[1];
}
function getadmver($id_admver) {
	$q = mysql_query("SELECT * FROM t_admverifikasi WHERE id_admver='$id_admver'");
	$a = mysql_fetch_array($q);
	return $a[1];
}
function getJK($jk) {
	if ($jk == 1) {
		return "Laki-Laki";
	} else if ($jk == 2) {
		return "Perempuan";
	} else {
		return "Undefined";
	}
}

function cmbDB($name, $tabel, $f_value, $f_view, $selected) {
	echo "<select name='$name' class=\"form-control\"><option value=''>--</option>";
	$q = mysql_query("SELECT $f_value, $f_view FROM $tabel ORDER BY $f_value ASC");
	while ($a = mysql_fetch_array($q)) {
		if ($a[0] == $selected) {
			echo "<option value='$a[0]' selected>$a[1]</option>";
		} else {
			echo "<option value='$a[0]'>$a[1]</option>";
		}
	}
	echo "</select>";
}
function GetcmbDB($name, $tabel, $f_value, $f_view, $selected) {
	echo "<select name='$name' class=\"form-control\"><option value=''>$selected</option>";
	$q = mysql_query("SELECT $f_value, $f_view FROM $tabel ORDER BY $f_value ASC");
	while ($a = mysql_fetch_array($q)) {
		if ($a[0] == $selected) {
			echo "<option value='$a[0]' selected>$a[1]</option>";
		} else {
			echo "<option value='$a[0]'>$a[1]</option>";
		}
	}
	echo "</select>";
}
function gettahun($id_tahun) {
	$q = mysql_query("SELECT * FROM tahun WHERE tahun='$id_tahun' and status='Y'" );
	$a = mysql_fetch_array($q);
	return $a[1];
}

function acakHuruf() {
	$panjangacak = 5;
	$base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
	$max=strlen($base)-1;
	$acak='';
	mt_srand((double)microtime()*1000000);

	while (strlen($acak)<$panjangacak) {
		$acak.=$base{mt_rand(0,$max)};
	}
	return $acak;
}
function cCmbDapil($val1) {
	echo "<select class=\"form-control\" name='dapil'><option value=''></option>";
	$q = mysql_query("SELECT * FROM t_dapil ORDER BY id_dapil ASC");
	while ($a = mysql_fetch_array($q)) {
		if ($a[0] == $val1) {
			echo "<option value='$a[0]' selected>$a[1]</option>";
		} else {
			echo "<option value='$a[0]'>$a[1]</option>";
		}
	}
	echo "</select>";
}
function cCmbtahun($name, $val1) {
	echo "<select class=\"form-control\" name='$name'><option value=''></option>";
	$q = mysql_query("SELECT * FROM tahun where status= 'Y' ");
	while ($a = mysql_fetch_array($q)) {
		if ($a[0] == $val1) {
			echo "<option value='$a[0]' selected>$a[0]</option>";
		} else {
			echo "<option value='$a[0]'>$a[0]</option>";
		}
	}
	echo "</select>";
}
function cCmbTglLahir($d, $m, $y) {
	//echo "<div class=\"form-group\">
	echo "<div class = \"col-lg-3\"> TGL <select class=\"form-control\" \"col-lg-2\" name='tgl_lahir'><option value=''></option>";
	for ($tg =1; $tg <=31; $tg++) {
		if ($tg == $d) {
			echo "<option value='$tg' selected>$tg</option>";
		} else {
			echo "<option value='$tg'>$tg</option>";
		}
	}	
	echo "</select> </div> <div class ='col-lg-3'> BLN <select class=\"form-control\" name='bln_lahir'><option value=''></option>";
	for ($bl =1; $bl <=12; $bl++) {
		if ($bl == $m) {
			echo "<option value='$bl' selected>$bl</option>";
		} else {
			echo "<option value='$bl'>$bl</option>";
		}
	}		
	echo "</select> </div> <div class = \"col-lg-3\"> THN <select class=\"form-control\"  name='thn_lahir' ><option value=''></option>";
	for ($th = 2012; $th >=1920; $th--) {
		if ($th == $y) {
			echo "<option value='$th' selected>$th</option>";
		} else {
			echo "<option value='$th'>$th</option>";
		}
	}
	echo " </select> </div> ";
	//</div>";
}	
?>
<script type="text/javascript">
	function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>


