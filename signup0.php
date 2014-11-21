<?PHP
//session_start();
//if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	//header ("Location: login.php");
//}

//set the session variable to 1, if the user signs up. That way, they can use the site straight away
//do you want to send the user a confirmation email?
//does the user need to validate an email address, before they can use the site?
//do you want to display a message for the user that a particular username is already taken?
//test to see if the u and p are long enough
//you might also want to test if the users is already logged in. That way, they can't sign up repeatedly without closing down the browser
//other login methods - set a cookie, and read that back for every page
//collect other information: date and time of login, ip address, etc
//don't store passwords without encrypting them
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
	$pword = $_POST['password'];

	$uname = htmlspecialchars($uname);
	$pword = htmlspecialchars($pword);

	//====================================================================
	//	CHECK TO SEE IF U AND P ARE OF THE CORRECT LENGTH
	//	A MALICIOUS USER MIGHT TRY TO PASS A STRING THAT IS TOO LONG
	//	if no errors occur, then $errorMessage will be blank
	//====================================================================

	$uLength = strlen($uname);
	$pLength = strlen($pword);

	if ($uLength >= 10 && $uLength <= 20) {
		$errorMessage = "";
	}
	else {
		$errorMessage = $errorMessage . "Username must be between 10 and 20 characters" . "<BR>";
	}

	if ($pLength >= 8 && $pLength <= 16) {
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

	<html>
	 <script language="JavaScript" type="text/javascript" src="clientvalidation.js"></script> 
	<head>
	<title>Basic Login Script</title>


	</head>
	<body>


<FORM NAME ="form1" METHOD ="POST" ACTION ="signup.php">
First name: <INPUT TYPE = 'TEXT' Name ='firstname'  value="<?PHP print $fname;?>" maxlength="20" >
</br>
Second name: <INPUT TYPE = 'TEXT' Name ='secondname'  value="<?PHP print $sname;?>" maxlength="20">
</br>
Username: <INPUT TYPE = 'TEXT' Name ='username'  value="<?PHP print $uname;?>" maxlength="20" onchange="usernameChanged('<?PHP print $uname;?>'); return false;">
<p id="uname-comment"> write name</p>
</br>
Email: <INPUT TYPE = 'TEXT' Name ='email'  value="<?PHP print $email;?>" maxlength="20"  onchange="emailChanged('<?PHP print $email;?>'); return false;"> 
<p id="email-comment">write email</p>
</br>
Password: <INPUT TYPE = 'password' Name ='password1'  value="<?PHP print $pword1;?>" maxlength="16"  onchange="password1Changed('<?PHP print $pword1;?>'); return false;">
<p id="pwd1-comment">write pwd</p>
</br>
Re-enter password: <INPUT TYPE = 'password' Name ='password2'  value="<?PHP print $pword2;?>" maxlength="16" onchange="password2Changed('<?PHP print $pword2;?>'); return false;">
<p id="pwd2-comment">write pwd 2-nd time</p>

<P>
<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Register" onclick="submitButtonHit(); return false;"">


</FORM>
<P>

<?PHP print $errorMessage;?>

	</body>
	</html>
