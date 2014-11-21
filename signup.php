<!DOCTYPE html>

<?php
//require_once 'C:/xampp/htdocs/moonlightinlodka/dashboard/checkcredentials.php';
$fname = "";
$sname = "";

$uname = "";

$pword1 = "";
$pword2 = "";

$email = "";

$errorMessage = "";
$num_rows = 0;
function quote_smart($value, $handle) {

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }

   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//====================================================================
	//	GET THE CHOSEN U AND P, AND CHECK IT FOR DANGEROUS CHARCTERS
	//====================================================================
	$uname = $_POST['username'];
	$fname = $_POST['firstname'];
	$sname = $_POST['secondname'];
	$pword1 = $_POST['password1'];
	$pword2 = $_POST['password2'];
	$email = $_POST['email'];

	$uname = htmlspecialchars($uname);
	$fname = htmlspecialchars($fname);
	$sname = htmlspecialchars($sname);
	$pword = htmlspecialchars($pword1);
	$pword = htmlspecialchars($pword2);
	$email = htmlspecialchars($email);
	
	//====================================================================
	//	CHECK TO SEE IF U AND P ARE OF THE CORRECT LENGTH
	//	A MALICIOUS USER MIGHT TRY TO PASS A STRING THAT IS TOO LONG
	//	if no errors occur, then $errorMessage will be blank
	//====================================================================

	$unLength = strlen($uname);
	$fnLength = strlen($fname);
	$snLength = strlen($sname);
	$p1Length = strlen($pword1);
	$p2Length = strlen($pword2);


	if ($unLength >= 10 && $unLength <= 20) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Username must be between 10 and 20 characters" . "<BR>";
	}
	
	if ($fnLength >= 10 && $fnLength <= 20) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "First name must be between 10 and 20 characters" . "<BR>";
	}
	
	if ($snLength >= 10 && $snLength <= 20) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Second name must be between 10 and 20 characters" . "<BR>";
	}
	
	

	if ($p1Length >= 8 && $p1Length <= 16) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Password must be between 8 and 16 characters" . "<BR>";
	}
	
	

	if ($p2Length >= 8 && $p2Length <= 16) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Password must be between 8 and 16 characters" . "<BR>";
	}



//test to see if $errorMessage is blank
//if it is, then we can go ahead with the rest of the code
//if it's not, we can display the error

	//====================================================================
	//	Write to the database
	//====================================================================
	if ($errorMessage == "") {

	$user_name = "root";
	$pass_word = "";
	$database = "moonlightinlodka";
	$server = "127.0.0.1";

	$db_handle = mysql_connect($server, $user_name, $pass_word);
	$db_found = mysql_select_db($database, $db_handle);

	if ($db_found) {

		$uname = quote_smart($uname, $db_handle);
		$pword = quote_smart($pword, $db_handle);

	//====================================================================
	//	CHECK THAT THE USERNAME IS NOT TAKEN
	//====================================================================

		$SQL = "SELECT * FROM login WHERE nombre = $uname";
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);

		if ($num_rows > 0) {
			$errorMessage = "Username already taken";
		}
		
		else {
		//check if the email already exists
		$SQL = "SELECT * FROM login WHERE direccion = $uname";
		$result = mysql_query($SQL);
		$num_rows = mysql_num_rows($result);

		if ($num_rows > 0) {
			$errorMessage = "Email address already used";
		} else {
		

			$SQL = "INSERT INTO login (nombre, contrasena,direccion) VALUES ($uname, md5($pword),$email)";

			$result = mysql_query($SQL);

			mysql_close($db_handle);

		//=================================================================================
		//	START THE SESSION AND PUT SOMETHING INTO THE SESSION VARIABLE CALLED login
		//	SEND USER TO A DIFFERENT PAGE AFTER SIGN UP
		//=================================================================================

			session_start();
			$_SESSION['login'] = "1";

			header ("Location: login.php");
			}

		}

	}
	else {
		$errorMessage = "Database Not Found";
	}




	}

}



?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>DASHGUM - Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	<script language="JavaScript" type="text/javascript" src="clientvalidation.js"></script> 

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="signup-page">
	  	<div class="container">
	  	<b>jjj</b> 
	  	<b>jjj</b> 
		      <form name="form1" method="post" class="form-signup" action="/moonlightinlodka/dashboard/signuserup.php">
		        <h2 class="form-signup-heading">sign up now</h2>
		        <div class="signup-wrap">
		            <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $fname;?>" maxlength="20" onchange="userDataChanged(); return false;" autofocus>
		            <br>
		            <input type="text" class="form-control" name="secondname" placeholder="Last Name" value="<?php echo $sname;?>" maxlength="20" onchange="userDataChanged(); return false;">
		            <br>
					<input type="text" class="form-control" name="email" placeholder="Email address" value="<?php echo $email;?>" maxlength="50" onchange="userDataChanged(); return false;">
		            <br>
		            <input type="text" class="form-control" name="username" placeholder="User ID" value="<?php echo $uname;?>" maxlength="20" onchange="userDataChanged(); return false;">
		            <br>
		            <input type="password" class="form-control" name="password1" placeholder="Password" value="<?php echo $pword1;?>" maxlength="16" onchange="userDataChanged(); return false;">
		            <br>
		            <input type="password" class="form-control" name="password2" placeholder="Confirmed Password" value="<?php echo $pword2;?>" maxlength="16" onchange="userDataChanged(); return false;">
		            <br>
		            
					 <button id="signup-btn" class="btn btn-theme btn-block disabled" href="signuserup.php" type="Login"><i class="icon-chevron-sign-up"></i> SIGN UP</button>
		            <hr>
		            
		            <div class="centered">
		            <p class="" style="">We will send you a confirmation link on your email.</p>
		                <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
		                <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
		            </div>
		         </div>
		
		       
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
