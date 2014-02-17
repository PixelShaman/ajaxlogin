<?php
session_start();
session_destroy();



if(isset($_POST['action']) && !empty($_POST['action'])) 
{
}else
	{
		include 'inputValidation.php';
		header('Location:'.$rootDirectory);
	}

?>