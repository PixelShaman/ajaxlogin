<?php


function textValidate($input,$uppercaseRequired,$numberRequired)
{
	$input = antiAttack($input);
	
	if ($uppercaseRequired==1 && strtolower($input) !== $input) // Check String contains uppercase
	{
		if($numberRequired==0)
		{
			return "1";
		}else{
		 // LOOK BACK AT THIS FOR ERROR CATCHING
		}
	}else{
		//echo("This Fied Requires at least one uppercase value.");
	}
	
	
	if((preg_match('#[0-9]#',$input))>0) // Check if string Contains Numbers
	{
		return "1";
	}else{
		
		return("This field requires at least 1 number.");
	}
}

function emailValidate($email)
{
	$email = antiAttack($email);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	  {
	  	return "0";
	  }
	else{return "1";}
}


function antiAttack($input){
	$input = trim(strip_tags(addslashes($input)));
	return $input;
}

?>