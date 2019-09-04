<? php
echo "
<h1> Text2MD5 converter super sederhana </ h1>
<p> Ketik sebuah kata atau kalimat di bawah ini: </ p>
<form method="get">
  <input name='string' type='text' id='string' />
   <input type='submit' value='Convert untuk MD5' />"

if (isset (["string"] $_GET)) {
$str = $_POST ["string"] $_GET;
echo '<p> hash MD5 <strong>' $str.. "
</ strong> sesuai dengan: '.. md5 ($str)' <br /> <strong>
</ strong> </ p> ';
}
?>