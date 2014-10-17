<?php
$passErr = $emailErr = "";
$pass = $email = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST["email"])){
		$emailErr = "Email is required";
	}else{
		$email = $_POST["email"];
	}
	if(empty($_POST["password"])){
		$passErr = "Password is required";
	}else{
		$pass = $_POST["password"];
	}
    if(checkPassword($email, $pass)){
		header('Location: test.php');
	}else{
		header('Location: home.html');
	}
}

function checkPassword($email, $pass){     
        $database = "mydb.ics.purdue.edu";
        $password = "MnBvCxZ";
        $user = "bunge";
        $connection = mysql_connect($database, $user, $password);
        $result = mysql_select_db($user , $connection);
        if (!$connection )
        {
            die('Could not connect: ' . mysql_error());
        }
        set_time_limit ( 0 );
        $result = mysql_query( "SELECT * FROM `USER` WHERE emailAddress='$email' AND encryptPass='$pass'");
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        while($row = mysql_fetch_array($result)){
            mysql_close($connection);
            return true;
        }    
        mysql_close($connection);
        return false;
    }
?>
