<?php

session_start();
  include_once 'dbconnect.php';

  $error = false;
  $mm = false;

  if( isset($_POST['actt']) ) {
    
    $error = false;

    $pass = trim($_POST['lic']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);


    if(empty($pass)){
      $error = true;
      $errMSG1 = "Please enter license number.";
    }
    
    if (!$error) {

      $res=mysqli_query($conn,"SELECT id FROM licence WHERE id='$pass'");
      if (!$res) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
      }
      $row=mysqli_fetch_array($res);
      $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

      if( $count == 1 && $row['id']==$pass ) {
        $mm = true;
        $msg = "Correct";
      } else {
        $errMSG1 = "Incorrect License number, Try again...";
      }

    }
  }


    if ( isset($_POST['submit']) ) {

    // clean user inputs to prevent sql injections
    $name = trim($_POST['nam']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);

    $challan = trim($_POST['chal']);
    $challan = strip_tags($challan);
    $challan = htmlspecialchars($challan);

    $place = trim($_POST['plc']);
    $place = strip_tags($place);
    $place = htmlspecialchars($place);

    $date = trim($_POST['dt']);
    $date = strip_tags($date);
    $date = htmlspecialchars($date);
    
    $time = trim($_POST['tm']);
    $time = strip_tags($time);
    $time = htmlspecialchars($time);
    
    $rule = trim($_POST['rb']);
    $rule = strip_tags($rule);
    $rule = htmlspecialchars($rule);
    
    $vehicle = trim($_POST['vno']);
    $vehicle = strip_tags($vehicle);
    $vehicle = htmlspecialchars($vehicle);
    
    $amount = trim($_POST['amt']);
    $amount = strip_tags($amount);
    $amount = htmlspecialchars($amount);

    
    if (empty($name)) {
      $error = true;
      $errMSG = "Please enter full name.";
    } else if (strlen($name) < 3) {
      $error = true;
      $errMSG = "Name must have atleat 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
      $error = true;
      $errMSG = "Name must contain alphabets and space.";
    }

    if(empty($place)){
    $error = true;
    $errMSG = "Please enter place."; 
    }    

    if(empty($date)){
    $error = true;
    $errMSG = "Please enter date."; 
    }  

    if(empty($time)){
    $error = true;
    $errMSG = "Please enter time."; 
    }  
    
    if(empty($rule)){
    $error = true;
    $errMSG = "Please enter rule broken."; 
    } 

    if(empty($vehicle)){
    $error = true;
    $errMSG = "Please enter vehicle number."; 
    }  

    if(empty($amount)){
    $error = true;
    $errMSG = "Please enter amount."; 
    }   

    if(empty($challan)){
    $error = true;
    $errMSG = "Please enter challan no.."; 
    } 

    // if there's no error, continue to signup
    if( !$error ) {

      $query1 = "INSERT INTO challan(no, place, dat, tim, total_amt, rc) VALUES('$challan','$place','$date','$time','$amount','$vehicle')";
      $res1 = mysqli_query($conn,$query1);

      $query2 = "INSERT INTO violation(challan, rule) VALUES('$challan','$rule')";
      $res2 = mysqli_query($conn,$query2);

      if ($res1 and $res2) {
        $errTyp = "success";
        $errMSG2 = "Successfully issued";
        unset($name);
        unset($challan);
        unset($place);
        unset($date);
        unset($time);
        unset($rule);
        unset($vehicle);
        unset($amount);
        //header("Location: travel_1.php");
      } else {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later...";
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
          <span class="card-title"><CENTER>ISSUE CHALLAN</CENTER></span>
         


       

<CENTER>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
<div class="row">
        <div class="col s12">
          ENTER THE LICENCE NO. :
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="lic">
            <label for="email_inline"></label>
            <span class="helper-text" data-error="wrong" data-success="right">Helper text</span>
          </div>
          <?php if(isset($errMSG1)){?>
    <div><span style="color: red;"><?php echo $errMSG1; ?></span></div>
    <?php } elseif(isset($msg)) {?>
      <div><span style="color: green;"><?php echo $msg; ?></span></div>
    <?php } ?>
        </div>
      </div>

</form>
</CENTER>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
<div class="row">
  <?php if(isset($errMSG)){?>
    <div><span style="color: red;"><?php echo $errMSG; ?></span></div>
    <?php } ?>
    <?php if(isset($errMSG2)){?>
    <div><span style="color: green;"><?php echo $errMSG2; ?></span></div>
    <?php } ?>
        <div class="col s12">
          NAME:
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="nam">
            <label for="email_inline">ALLOKIK PRANSHU</label>
          </div>
        </div>
</div>
<div class="row">
        <div class="col s12">
          CHALLAN NO. :
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="chal">
            <label for="email_inline">12476</label>
          </div>
        </div>
</div>
<div class="row">
        <div class="col s12">
          PLACE:
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="plc">
            <label for="email_inline">STATUE CIRCLE</label>
          </div>
        </div>
</div>
<div class="row">
        <div class="col s12">
          DATE :
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="dt">
            <label for="email_inline">2008-01-02</label>
          </div>
        </div>
      </div>
<div class="row">
        <div class="col s12">
          TIME :
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="tm">
            <label for="email_inline">16:01:06</label>
          </div>
        </div>
      </div>
<div class="row">
        <div class="col s12">
          RULE BROKEN :
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="rb">
            <label for="email_inline">303-A</label>
          </div>
        </div>
      </div>

<div class="row">     
        <div class="col s12">
          VEHICLE RC NO.:
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="vno">
            <label for="email_inline">129587</label>
          </div>
        </div>
      </div>



<div class="row">
        <div class="col s12">
          TOTAL AMOUNT :
          <div class="input-field inline">
            <input id="email_inline" type="text" class="validate" name="amt">
            <label for="email_inline">370 /- </label>
          </div>
        </div>
      </div>



 
        </div>
        <div class="card-action">
          <button class="btn waves-effect waves-light" type="submit" name="submit">ISSUE
  </button>
        </div>
      </div>
    </div>
  </div>
</form>















<footer class="page-footer">
     
		<div class="container">
            <div class="row">
              <div class="col 23 s29">
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

      <script>
          $(document).ready(function(){
            $('select').formSelect();
          });
      </script>script>
    </body>
  </html>


























