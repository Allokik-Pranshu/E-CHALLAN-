<?php

session_start();
  include_once 'dbconnect.php';

  $error = false;
  if( isset($_POST['actt']) ) {
    
    $error = false;

    $pass = trim($_POST['chal']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);


    if(empty($pass)){
      $error = true;
      $errMSG1 = "Please enter license number.";
    }
    
    if (!$error) {

      $res1=mysqli_query($conn,"SELECT no,place,dat,tim,total_amt,rc FROM challan WHERE no='$pass'");
      $res2=mysqli_query($conn,"SELECT rule FROM violation WHERE challan='$pass'");
      if (!$res1) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
      }
      $row1=mysqli_fetch_array($res1);
      $row2=mysqli_fetch_array($res2);
      $count = mysqli_num_rows($res1); // if uname/pass correct it returns must be 1 row
      
      


      if( $count == 1 && $row1['no']==$pass ) {
        $_SESSION['traffic'] = $pass;
        $place=$row1['place'];
        $dat=$row1['dat'];
        $tim=$row1['tim'];
        $total=$row1['total_amt'];
        $vehicle=$row1['rc'];
        $rule=$row2['rule'];
      } else {
        $errMSG1 = "Incorrect Challan number, Try again...";
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
  </nav>

<div class="row">
    <div class="col s12 m6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title"><CENTER>PAY CHALLAN</CENTER></span>
         


       

<CENTER>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
  <?php if(isset($errMSG1)){?>
    <div><span style="color: red;"><?php echo $errMSG1; ?></span></div>
    <?php } ?>
<div class="row">
        <div class="col s12">
          ENTER THE CHALLAN NO. :
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="chal">
            <label for="email_inline">11925</label>
            <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
          </div>
        </div>
      </div>
<button class="btn waves-effect waves-light" type="submit" name="actt">CHECK
  </button>
</form>

</CENTER>


<div class="row">
  <?php if(isset($place)){?>
    <div class="col s6"><span style="color: #fff;">PLACE: <?php echo $place; ?></span></div>
    <div class="col s6"><span style="color: #fff;">DATE: <?php echo $dat; ?></span></div>
</div>
<div class="row">
    <div class="col s6"><span style="color: #fff;">TIME: <?php echo $tim; ?></span></div>
    <div class="col s6"><span style="color: #fff;">TOTAL AMOUNT: <?php echo $total; ?></span></div>
</div>
<div class="row">
    <div class="col s6"><span style="color: #fff;">VEHICLE NO.: <?php echo $vehicle; ?></span></div>
    <div class="col s6"><span style="color: #fff;">RULE: <?php echo $rule; ?></span></div>
    <?php } ?>
</div>
       
        <div class="card-action">
          <button onClick="window.location='payment.php'" class="btn waves-effect waves-light" type="submit" name="pay">PAY
  </button>
        </div>
    </div>
  </div>
  </div>
</div>

















<footer class="page-footer">
     
		<div class="container">
            <div class="row">
              <div class="col 42 s29">
                <h5 class="white-text">TRAFFIC POLICE</h5>
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


























