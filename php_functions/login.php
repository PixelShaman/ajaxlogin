<?php




//action[0]         // Action (login / register / unegister / logout)
//action[1] 		// Param (username / password)
//action[2]			// Entry (Text from associated field or actual value to test against)

session_start();



include 'inputValidation.php';



			//   Register,     Password,  myusername|mypassword1|mail@email.com
			//   Login,        Username,  myusername|mypassword1  
function doDB(   $perform,     $param,    $entry)
{
	include 'ajax_register_settings.php';
		
	$con;
	$db;
	
	$con = mysql_connect($dbAccessdomain, $dbAccessUsername, $dbAccessPassword) or die(mysql_error());
	$db = mysql_select_db($dbAccessDBName, $con) or die(mysql_error());
	
	
	$entryPieces = explode("|", $entry);
											//$entryPieces[0] == Username / username1
											//$entryPieces[1] == Password / mypasswoord
											//$entryPieces[2] == Email / mail@email.com
	if($perform == "checkEmail")
	{
		
		if(emailValidate($entryPieces[0])==1) // Validate Username (username / no uppercase required / number required)
		{

			$myQuery = 'SELECT * FROM '.$tableName.' WHERE ' .'email' .'= "'. $entryPieces[0].'"' ;	
			$res = mysql_query($myQuery);
			$num = mysql_num_rows($res);	
			$row = mysql_fetch_assoc($res);

			if($num > 0) // If an entry is found this means the username is taken so we should return a NO or 0 value
			{
				echo("0");
			}else{
				echo("1");
			}
		}else{
			return "bad email";
		}
	}
	
	if($perform == "checkUsername")
	{
		
		if(textValidate($entryPieces[0],0,1 )==1) // Validate Username (username / no uppercase required / number required)
		{
			
			$myQuery = 'SELECT * FROM '.$tableName.' WHERE ' .'username' .'= "'. $entryPieces[0].'"' ;	
			$res = mysql_query($myQuery);
			$num = mysql_num_rows($res);	
			$row = mysql_fetch_assoc($res);

			if($num > 0) // If an entry is found this means the username is taken so we should return a NO or 0 value
			{
				echo("0");
			}else{
				echo("1");
			}
		}else{
			return "bad username";
		}

	}//End check username
	

		if($perform == "register")	
		{
			if(textValidate($entryPieces[0],0,1 )==1) // Validate Username (username / no uppercase required / number required)
			{
				if(textValidate($entryPieces[1],1,1 )==1) // Validate Password
				{
					if(emailValidate($entryPieces[2]) ==1 ) // Validate Email
					{
						$registerTime = date('U');
						$activator = md5($entryPieces[0]).$registerTime;
										
						$myQuery = "INSERT INTO `".$tableName."` (`username`, `password`, `email`, `regTime`) VALUES('".$entryPieces[0]."','". md5($entryPieces[1])."','".$entryPieces[2]."','".$registerTime."')";	
						$mailMessage = "Thank you for registering your account, please click the link below to activate your details"."\n\n".$rootDirectory."/activate.php?activator=".$activator;
						mail($entryPieces[2],"Ajax registration!",$mailMessage,"From:".$siteEmailAddress."");

						$res = mysql_query($myQuery);
						$num = mysql_num_rows($res);		
						$row = mysql_fetch_assoc($res);
				
						
						$myQuery = 'SELECT * FROM '.$tableName.' WHERE ' .username .'= "'. $entryPieces[0]. '"' ;	// Get the username back to chek it has written properly
						$res = mysql_query($myQuery);														// and update session from it
						$num = mysql_num_rows($res);		
						$row = mysql_fetch_assoc($res);
						
						$_SESSION[s_UserID] = $row[id];
						$_SESSION[s_Username]=$row[username];
						
						echo("1");	 
					}else{echo("bad email");}
				}else{echo( "bad password");}	
			}else{echo( "bad username");}
		} // End Register
		
		
		else if($perform == "login")
		{
				
				
			if(!$_SESSION[s_Username]) // Check that we are not already logged in .
			{
			if(textValidate($entryPieces[0],0,1 )==1) // Validate Username (username / no uppercase required / number required)
			{
				if(textValidate($entryPieces[1],1,1 )==1) // Validate Password
				{
					$myQuery = 'SELECT * FROM '.$tableName.' WHERE ' .'username' .'= "'. $entryPieces[0].'" '. 'AND password = "'.md5($entryPieces[1]).'"' ;	
					$res = mysql_query($myQuery);
					$num = mysql_num_rows($res);	
					$row = mysql_fetch_assoc($res);

					if($num)
					{
						$_SESSION[s_UserID] = $row[id];
						$_SESSION[s_Username]=$row[username];
						$_SESSION[s_UserActive] = $row[active];
						echo("1");
					}
				}else{echo( "bad password");}	
			}else{echo( "bad username");}
				
			}else
				{
					echo("You are already logged in.");
					return 0;
				}
		} else{ // end if login
		} // End action to perform  (login / reg etc)
} // End doDB()



if(isset($_POST['action']) && !empty($_POST['action'])) 
{
	$action = $_POST['action']; // Add the jquery variables into a php array	
	$entryPieces = explode("|", $action[2]);
									//$entryPieces[0] == Username / username1
									//$entryPieces[1] == Password / mypasswoord
									//$entryPieces[2] == Email / mail@email.com
	
	if(antiAttack($entryPieces[0])==$entryPieces[0] && antiAttack($entryPieces[1])==$entryPieces[1] && antiAttack($entryPieces[2])==$entryPieces[2]  ) 
	{
	   if($action[0] == "checkUsername" || $action[0] == "register" || $action[0] == "login" || $action[0] == "checkEmail")
	   {
			doDB($action[0],$action[1],$action[2]);
	   }else
		{
			echo("Not a valid action");
		}

	}else{echo("There was a problem");}//End call DB function

} // End If Isset
	
	
	

	
?>