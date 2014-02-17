<?php

session_start();
include 'php_functions/ajax_register_settings.php';
include 'php_functions/inputValidation.php';

$myTableName =$tableName;
$myRootDirectory = $rootDirectory;

$con;
$db;
	
$con = mysql_connect($dbAccessdomain, $dbAccessUsername, $dbAccessPassword) or die(mysql_error());
$db = mysql_select_db($dbAccessDBName, $con) or die(mysql_error());
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
	
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<link href='http://fonts.googleapis.com/css?family=Chivo:400,900' rel='stylesheet' type='text/css' />
	<link href='css/style.css' rel='stylesheet' type='text/css' />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>


	 		
	<title>  Ajax / Jquery simple registration system  </title>
	
	<script type="text/javascript">
		window.setTimeout(function() {
    		window.location.href = 'http://localhost';
		}, 5000);

	</script>
	
</head>
	
<body>
	<div id="mainPage">
		<div id="header">
			<div id="header_inner">
				<div id="logoWrapper">
					
					<img id="ajax_logo" src="images/logo001.png" alt="response image" />
				</div>
					
				<h2>Welcome to the ajax user registration system!</h2>
			
						<div id="headerContentBlock">
							<ul>
								<li>Super simple <a>setup</a> !</li>
								<li>Realtime username availability feedback  </li>
								<li>Built to be easily customized </li>
								<li>Uses jQuery, PHP and MySql </li>
								<li>Full input field validation </li>		
							</ul>
						</div><!--end headcontentblock div -->
			</div><!--End Header Inner -->
			</div><!--End Header-->
			
			<div id="page">
				<div id="page_inner">
				
				<?php
				
				$activator = antiAttack($_GET['activator']);
				if(!$activator){
					echo ' <label>There was a problem, Please try again click <a href="'.$myRootDirectory.'">here</a> to return home.';
				}else{
					$res = mysql_query("SELECT * FROM ".$myTableName." WHERE `active` = '0'");
		
					while($row = mysql_fetch_assoc($res)){	
						if($activator == md5($row['username']).$row['regTime']){
							$res1 = mysql_query("UPDATE ".$myTableName." SET `active` = '1' WHERE `id` = '".$row['id']."'");
							$_SESSION[s_UserActive] = 1;
							echo '<label> Your account has been activated!</label><br/><br/><label>Please wait while we redirect you.</label>';
						}
					}
				}
				?>
					</div>
				</div>
				<div id="footer">
					<div id="footer_inner">
						<div>
								Quick and simple ajax registration and login !
						</div>
					</div><!-- End Footer Inner-->
				</div><!-- End Footer-->
	</body>
</html>


