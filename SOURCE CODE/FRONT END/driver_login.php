<!DOCTYPEhtml>

<?php

session_start();
  include_once 'dbconnect.php';

  $error = false;

  if( isset($_POST['submit']) ) {
    
    $error = false;

    $usr = trim($_POST['usr']);
    $usr = strip_tags($usr);
    $usr = htmlspecialchars($usr);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);


    if(empty($pass)){
      $error = true;
      $errMSG1 = "Please enter your password.";
    }
    
    if(empty($usr)){
      $error = true;
      $errMSG1 = "Please enter your username.";
    }
    
    if (!$error) {

      $res=mysqli_query($conn,"SELECT password FROM driver_login WHERE user_name='$usr'");
      $row=mysqli_fetch_array($res);
      $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

      if( $count == 1 && $row['password']==$pass ) {
        $_SESSION['traffic'] = $usr;
        header("Location: pay_challan.php");
      } else {
        $errMSG1 = "Incorrect Credentials, Try again...";
      }

    }
  }

?>


<html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
<nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center">E-CHALLAN</a>
    </div>
    <?php 
      if (isset($_SESSION['traffic'])){
      ?>
    
    <?php } ?>
  </nav>

<center>
<div class="row">
<div class="col s8">
<div class="row valign-wrapper">
    <div class="col s12 m6">
      <div class="card blue-grey darken-1">

        <div class="card-content white-text">
          <span class="card-title"> DRIVER LOGIN</span>
          <div class="row">
    <form class="col s12" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
      <?php
    if(isset($errMSG1)){
    ?>
    <div><span style="color: red;"><?php echo $errMSG1; ?></span></div>
    <?php } ?>

      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate" name="usr">
          <label for="icon_prefix">USER NAME</label>
        </div>
	</div>
	<div class="row">
	<div class="input-field col s6">
          <i class="material-icons prefix">subdirectory_arrow_right</i>
          <input id="icon_prefix" type="password" class="validate" name="pass">
          <label for="icon_prefix">PASSWORD</label>
        </div>
	</div>
  <div class="card-action">
        <button class="btn waves-effect waves-light" type="submit" name="submit">Submit</button>
        
        </div>
    </form>
  </div>
        

      </div>
    </div>
  </div>
</div>
</div>
</div>
</center>


<footer class="page-footer">
          <CENTER>
		<div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">TRAFFIC POLICE </h5>
                <p class="grey-text text-lighten-4">Drive safe and be safe</p>
              </div>
	  
              <div class="col 14 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                   <li><a class="grey-text text-lighten-3" href="index.php">HOME</a></li>
                  <li><a class="grey-text text-lighten-3" href="driver_login.php">PAY CHALLAN</a></li>
                  <li><a class="grey-text text-lighten-3" href="police_login.php">ISSUE CHALLAN</a></li>
           
                </ul>
              </div>
            </div>
          </div>
</CENTER>
          <div class="footer-copyright">
       
            <div class="container">
         
           <CENTER> ©  allokik pranshu
            </CENTER>
  
            </div>
          </div>
        </footer>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>


























