<?php


include 'inputValidation.php';


			//   Register,     Password,  username|mypassword1|user@email.com
			//   Login,        Username,  username|mypassword1  
function doDB(  $entry)
{
	include 'ajax_register_settings.php';
	$con;
	$db;
	
	$con = mysql_connect($dbAccessdomain, $dbAccessUsername, $dbAccessPassword) or die(mysql_error());
	$db = mysql_select_db($dbAccessDBName, $con) or die(mysql_error());
	
	$myQuery = 'SELECT * FROM '.$tableName.' WHERE ' .'email' .'= "'. $entry.'"' ;	
	$res = mysql_query($myQuery);
	$num = mysql_num_rows($res);	
	$row = mysql_fetch_assoc($res);
	
	if($num>0)
	{
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$tempPasswordString = "abcdefghijk";
		
		for ($i = 0; $i < strlen($tempPasswordString); $i++) {
			$tempPasswordString[$i] =$chars[rand(0, strlen($chars)-1)] ;
		}
		$tempPasswordString = $tempPasswordString . rand(0,999);
		
		$newPassword=$tempPasswordString;
		
		
		$myQuery_update = 'UPDATE '.$tableName.' SET password='.'"'.md5($newPassword).'"'.' WHERE ' .'email' .'= "'. $entry.'"' ;	
		$res_update = mysql_query($myQuery_update);
		$num_update = mysql_num_rows($res_update);	
		$row_update = mysql_fetch_assoc($res_update);
		
		$mailMessage = "Here is your new password : ".$newPassword."\n\n Please login and change your password at http://localhost";
		
		mail($entry,'Ajax register lost password',$mailMessage, 'From:'.  $siteEmailAddress.'');
		
		echo ("1");
		return;
		
	}else{
		
		echo("email does not exist");
		return;
	}
	
	
}


if(isset($_POST['action']) && !empty($_POST['action'])) 
{

	$action = $_POST['action'];
	//action[0]         // Action (forgottenPassword)
	//action[1] 		// Param (username / password)		
	//action[2]			// Entry (Text from associated field or actual value to test against)	$action = $_POST['action'];
	
	if($action[0] == "forgottenPassword")
	{
		doDb($action[2]);
	}	else {
		echo ("not a valid request");
		return;	
	}

}


?>