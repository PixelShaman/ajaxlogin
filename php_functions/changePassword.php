<?php

session_start();

include 'inputValidation.php';

function doDB(  $username, $oldPass, $newPass)
{
	include 'ajax_register_settings.php';
	
	$con;
	$db;
	
	$con = mysql_connect($dbAccessdomain, $dbAccessUsername, $dbAccessPassword) or die(mysql_error());
	$db = mysql_select_db($dbAccessDBName, $con) or die(mysql_error());
	
	$myQuery = 'SELECT * FROM '.$tableName.' WHERE ' .'username' .'= "'. $username.'" AND password = '.'"'.md5($oldPass).'"'  ;	
	$res = mysql_query($myQuery);
	$num = mysql_num_rows($res);	
	$row = mysql_fetch_assoc($res);
	
	if($num>0)
	{
		$newPasswordmd5 = md5($newPass);
		
		$myQuery_update = 'UPDATE '.$tableName.' SET password='.'"'.$newPasswordmd5.'"'.' WHERE ' .'username' .'= "'. $username.'"' ;	
		$res_update = mysql_query($myQuery_update);
		$num_update = mysql_num_rows($res_update);	
		$row_update = mysql_fetch_assoc($res_update);
	
		echo ("1");
		return 1;
	}else{
		echo("The old password was incorrect");
		return 0;
	}
}

if(isset($_POST['action']) && !empty($_POST['action'])) 
{
	
	$validationPassed = 0 ;

	$action = $_POST['action'];
	//action[0]         // Username
	//action[1]         // oldPassword
	//action[2] 		// newPassword
	
	if(textValidate($action[2],1,1)=="1")
	{
		
		if($action[2] == antiAttack($action[2]))
		{
		$validationPassed = 1 ;
		}else{
			$validationPassed = 0 ;
		}
	}else{
		echo("The password was not formatted properly");
		return 0;
	} // End validation 
	
	if($validationPassed == 1)
	{
		doDb($action[0],$action[1],$action[2]);
	}else{
		echo ("There was a problem with the data.");
		return 0;	
	}

} 
?>