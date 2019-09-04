<<?php 
if(isset($_post["Masuk"])){
echo "
<script type='text/javascript'>
	setTimeout function () 
	{
		swal ({
		title: 'Informasi',
		text: 'Berhasil Masuk',
		type: 'Info',
		showCancelButton: True,
		ConfirmbuttonColour: '#DD6B55',
		ConfirmbuttonText: 'OK',
		CancelButtonText: 'Cancel',
		}, function (isConfirm){
			if (isConfirm) {
				location.href = 'ceklogin.php';
			} else {
			 location.href = 'Login';
			}
		} )
		// body...
	}

</script>";
elseif (isset($_post["Daftar"])) { 
	header("locatin:index.php?page=Daftar")
	# code...
}
?>

<script>
function openConfirm() {
	swal({
  	title: 'Welcome',
    text: 'Welcome to our site!',
    showCancelButton: true,
    confirmButtonText: 'Sign In',
    cancelButtonText: 'Cancel'
  }).then(function (status) {
  	if (status.value) {
      console.log('Cofirmed!');
    } else {
    	console.log('Canceled');
    }
  });
}
</script>
<button onclick="openConfirm()">Click me!</button>

echo "<script>
function openConfirm() {
  swal({
    title: 'Confirm',
    text: 'Pengimputan Data Berhasil!',
    showCancelButton: true,
    confirmButtonText: 'Login',
    cancelButtonText: 'Cancel'
  }).then(function (status) {
    if (status.value) {
      console.log('login.php');
    } else {
      console.log('Canceled');
    }
  });
}
</script>'
<button onclick='openConfirm()'>OK</button>";
        } else {
          echo "<script>
function openConfirm() {
  swal({
    title: 'Confirm',
    text: 'Pengimputan Data Gagal',
    showCancelButton: true,
    //confirmButtonText: 'Kembali',
    cancelButtonText: 'Cancel'
  }).then(function (status) {
    if (status.value) {
      //console.log('login.php');
   // } else {
      console.log('Canceled');
    }
  });
}
</script>
<button onclick='openConfirm()'>OK</button>";