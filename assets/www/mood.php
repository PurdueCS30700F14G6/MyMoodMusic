<?php
	if (strcmp($_GET['todo'], "setUser") == 0){
		$result =setUser($_GET['suName'], $_GET['sPass'], $_GET['email'], $_GET['pass'], $_GET['sq1ID'], $_GET['sq1Ans'], $_GET['sq2ID'], $_GET['sq2Ans'], $_GET['sq3ID'], $_GET['sq3Ans']);
	}
	else if(strcmp($_GET['todo'], "getSecurity") == 0){
		$result = getSecurity($_GET['email']);
	}
	else if(strcmp($_GET['todo'], "checkPassword") == 0){
		$result = checkPassword($_GET['email'], $_GET['pass']);
	}
	else if(strcmp($_GET['todo'], "test") == 0){
		$result = $_GET['username'] . " " . $_GET['password'];
	}
	else if(strcmp($_GET['todo'], "test") == 0){
		$result = checkSecurity($_GET['username'],  $_GET['idNum'], $_GET['Ans']);
	}
	
	print_r($result);
	echo("<br>Something Happened<br>");

	function setUser($potifyUserName, $potifyPassword, $mailAddress, $ncryptPass, $q1ID, $q1Ans, $q2ID, $q2Ans, $q3ID, $q3Ans ){
		print_r( $spotifyUserName ." " .$spotifyPassword ." ". $emailAddress ."<br>");     
		$database = "mydb.ics.purdue.edu";
		$password = "MnBvCxZ";
		$user = "bunge";
		$connection = mysql_connect($database, $user, $password);
		$result = mysql_select_db($user , $connection);
		if (!$connection )
		{
			die('Could not connect: ' . mysql_error());
		}
		print_r("We connected<br>");
		set_time_limit ( 0 );
		$result = mysql_query( "SELECT * FROM `USER` WHERE emailAddress='$mailAddress'");
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}
		while($row = mysql_fetch_array($result)){
			mysql_close($connection);
			return "User exists<br>";
		}
		$result = mysql_query( "INSERT INTO `USER` (spotifyUserName, spotifyPassword, emailAddress, encryptPass, sq1ID, sq1Ans, sq2ID, sq2Ans, sq3ID, sq3Ans) VALUES ( '$potifyUserName', '$potifyPassword', '$mailAddress', '$ncryptPass', '$q1ID', '$q1Ans', '$q2ID', '$q2Ans', '$q3ID', '$q3Ans')");
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}    
		mysql_close($connection);
		return "We made a user with an emailAddress " . $mailAddress . "<br>"; 
	}
	
	function getSecurity($emailAddress){
		$database = "mydb.ics.purdue.edu";
		$password = "MnBvCxZ";
		$user = "bunge";
		$connection = mysql_connect($database, $user, $password);
		$result = mysql_select_db($user , $connection);
		if (!$connection )
		{
			die('Could not connect: ' . mysql_error());
		}
		print_r("We connected<br>");
		set_time_limit ( 0 );
		$result = mysql_query( "SELECT * FROM `USER` WHERE emailAddress='$emailAddress'");
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}
		//print_r("The result:" . $result);
		$returnS = "";
		while($row = mysql_fetch_array($result)){
			$returnS = $row['sq1ID'] . " " . $row['sq2ID'] . " " . $row['sq3ID'];
		}
		print_r ($returnS);
		mysql_close($connection);
		return $returnS;
	
	}
	
	function checkPassword($email, $pass){
		print_r( $spotifyUserName ." " .$spotifyPassword ." ". $emailAddress ."<br>");     
		$database = "mydb.ics.purdue.edu";
		$password = "MnBvCxZ";
		$user = "bunge";
		$connection = mysql_connect($database, $user, $password);
		$result = mysql_select_db($user , $connection);
		if (!$connection )
		{
			die('Could not connect: ' . mysql_error());
		}
		print_r("We connected<br>");
		set_time_limit ( 0 );
		$result = mysql_query( "SELECT * FROM `USER` WHERE emailAddress='$email' AND encryptPass='$pass'");
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}
		while($row = mysql_fetch_array($result)){
			mysql_close($connection);
			return "true";
		}    
		mysql_close($connection);
		return "false";
	}
	
	function checkSecurity($email, $idNum, $Ans){
		//print_r( $spotifyUserName ." " .$spotifyPassword ." ". $emailAddress ."<br>");     
		$database = "mydb.ics.purdue.edu";
		$password = "MnBvCxZ";
		$user = "bunge";
		$connection = mysql_connect($database, $user, $password);
		$result = mysql_select_db($user , $connection);
		if (!$connection )
		{
			die('Could not connect: ' . mysql_error());
		}
		print_r("We connected<br>");
		set_time_limit ( 0 );
		$result = mysql_query( "SELECT * FROM `USER` WHERE emailAddress='$email' ");
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}
		while($row = mysql_fetch_array($result)){
			if($row['sq1ID'] == $idNum && $row['sq1Ans'] == $Ans){
				mysql_close($connection);
				return "true";
			}
			else if($row['sq2ID'] == $idNum && $row['sq2Ans'] == $Ans){
				mysql_close($connection);
				return "true";
			}
			else if($row['sq3ID'] == $idNum && $row['sq3Ans'] == $Ans){
				mysql_close($connection);
				return "true";
			}
		}    
		mysql_close($connection);
		return "false";
	}
	
?>
