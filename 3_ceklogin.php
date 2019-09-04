<?php
include "koneksi/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
$username	= anti_injection($_POST["username"]);
$pass		= anti_injection(md5($_POST["password"]));

if (!ctype_alnum($username) OR !ctype_alnum($pass)){
header("location:3_login.php");
}else{
	$login	=mysql_query("SELECT * FROM t_dprd WHERE username='$username' AND password='$pass' AND status='Y'");
	$ketemu	=mysql_num_rows($login);
	if ($ketemu > 0){
		session_start();
	  	$r = mysql_fetch_array($login);
		$_SESSION["username"]   = $r["username"];
		$_SESSION["password"]   = $r["password"];
		$_SESSION["email"]		= $r["email"];
		$_SESSION["nama"]       = $r["namaanggoata"];
		$_SESSION["avatar"]  	= $r["foto"];
		$_SESSION["status"] 	= "Y";
		header('location:drpd/1_index.php');
	}else{
    header("location:3_login.php");
	}
}
?>
