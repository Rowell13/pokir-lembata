<!-- <?php 
// session_start();
//session_destroy();
// include 'koneksi/koneksi.php';
// include 'koneksi/fungsi.php';

 ?>
  <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Tampilkan/Sembunyikan Menu"></div>
      </div>
      <a href="1_index.php" class="logo"><b>E<span>POKIR</span></b></a>
      <div class="nav notify-row" id="top_menu">
       <ul class="nav top-menu">         
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="image/infokom.png" width="35" height="35">
              </a>            
          </li>       
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="image/ntt.png" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="image/pemkab.png" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
        </ul>      
      </div>  
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <?php
          if ($_SESSION != NULL) {
             echo '<li><a class="logout" href="1_logout.php">Logout</a></li>';
           } else {
            echo '<li><a class="logout" href="3_login.php">Login</a></li>';
           } ?>
        </ul>
      </div>
    </header>
 -->