

<?php

session_start();
  include_once 'dbconnect.php';

  $error = false;

  if( isset($_POST['pay']) ) {
    
    $error = false;

    $challan = trim($_POST['chal']);
    $challan = strip_tags($challan);
    $challan= htmlspecialchars($challan);

    $card = trim($_POST['card']);
    $card = strip_tags($card);
    $card= htmlspecialchars($card);

    $name = trim($_POST['name']);
    $name = strip_tags($name);
    $name = htmlspecialchars($name);

    $cvv = trim($_POST['cvv']);
    $cvv = strip_tags($cvv);
    $cvv = htmlspecialchars($cvv);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    $dat = trim($_POST['dt']);
    $dat = strip_tags($dat);
    $dat = htmlspecialchars($dat);


    if(empty($challan)){
      $error = true;
      $errMSG1 = "Please enter challan no.";
    }
    if(empty($card)){
      $error = true;
      $errMSG1 = "Please enter your card no.";
    }
    
    if(empty($name)){
      $error = true;
      $errMSG1 = "Please enter the name on the card.";
    }
    if(empty($cvv)){
      $error = true;
      $errMSG1 = "Please enter the cvv.";
    }
    if(empty($pass)){
      $error = true;
      $errMSG1 = "Please enter your password.";
    }
    if(empty($dat)){
      $error = true;
      $errMSG1 = "Please enter the expiry date.";
    }
    
    
    if (!$error) {

      $res=mysqli_query($conn,"SELECT cvv, pin FROM card WHERE no='$card'");
      $row=mysqli_fetch_array($res);
      $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

      if( $count == 1 && $row['cvv']==$cvv && $row['pin']==$pass ) {
        mysqli_query($conn,"DELETE FROM challan WHERE no='$challan'");
        mysqli_query($conn,"DELETE FROM violation WHERE challan='$challan'");
        header("Location: after_pay.php");
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
  </nav>

<CENTER>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
<div class="row">
    <div class="col s12 m6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">PAYMENT GATEWAY</span>
 <div class="row">         
 <p>
    <label>
      <input class="with-gap" name="group3" type="radio" checked />
      <span>CREDIT CARD     </span>
    </label>
    <label>
      <input class="with-gap" name="group3" type="radio" checked />
      <span>DEBIT CARD </span>
    </label>
  </p>
</div>

<div class="row">
        <div class="input-field col s6">
          <input placeholder="11245" id="CVV" type="text" class="validate" name="chal">
          <label for="CVV">challan no</label>
        </div>
      </div>
<div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="1234567890" id="CARD_NO" type="text" class="validate" name ="card">
          <label for="CARD_NO">CARD NO.</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="ALLOKIK PRANSHU" id="first_name" type="text" class="validate" name="name">
          <label for="first_name">NAME ON CARD</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="***" id="CVV" type="password" class="validate" name="cvv">
          <label for="CVV">CVV</label>
        </div>
      </div>  
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="*********" id="PASSWORD" type="password" class="validate" name="pass">
          <label for="PASSWORD">PASSWORD</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="2008-01-21" id="DATE" type="text" class="validate" name="dt">
          <label for="DATE">EXPIRY DATE</label>
        </div>
      </div>  


        </div>
        <div class="card-action">
          <button class="btn waves-effect waves-light" type="submit" name="pay">pay</button>
        </div>
      </div>
    </div>
  </div>
 </form>




</CENTER>






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
    </body>
  </html>


























