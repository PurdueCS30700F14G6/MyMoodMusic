<?php
	$aResult = array();
	if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
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
			
			case: 'checkPassword':
				$email = $_POST['arguments'][0];
				$pass =  $_POST['arguments'][1];
				$result = mysql_query( "SELECT * FROM `USER` WHERE emailAddress='$email' AND encryptPass='$pass'");
				if (!$result) {
					die('Invalid query: ' . mysql_error());
				}
				while($row = mysql_fetch_array($result)){
					mysql_close($connection);
					$aResult['result'] = true;
				}    
				if(!isset($aResult['result'])){
					mysql_close($connection);
					$aResult['result'] = false;
				}
			default:
				$aResult['error'] = 'Malformed expression';
		}
	}
	json_encode($aResult);
?>
