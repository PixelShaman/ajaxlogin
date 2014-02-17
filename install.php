<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
include 'php_functions/ajax_register_settings.php';
?>



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
	
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<link href='http://fonts.googleapis.com/css?family=Chivo:400,900' rel='stylesheet' type='text/css' />
	<link href='css/style.css' rel='stylesheet' type='text/css' />

	 		
	<title>  Ajax / Jquery simple registration system  </title>
	
</head>
	
<body>
	<div id="mainPage">
		<div id="header">
			<div id="header_inner">
				<div id="logoWrapper">
					
					<img id="ajax_logo" src="/images/logo001.png" alt="response image" />
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
					
</div><!-- End Header Inner -->
		</div><!-- End Header -->
		
		<div id="page" class="installer">
			<div id="page_inner">

<form method="post" action="php_functions/setup.php">
	
	<div class="form_item"><label>MySQL address : </label><input type="text" value=<?php echo($dbAccessdomain); ?> name="mysqlAddress" /></div>
	
	<div class="form_item"><label>Database name <span>(must already exists)<span> : </label><input type="text" value=<?php echo($dbAccessDBName); ?> name="dbName" /></div>
	
	<div class="form_item"><label>Database username : </label><input type="text"  name="dbUsername" /></div>
	
	<div class="form_item"><label>Database password : </label><input type="text"  name="dbPassword" /></div>
	
	<div class="form_item"><label>Your new domain login directory : </label><input type="text"  value=<?php echo("http://".$_SERVER["SERVER_NAME"])?> name="yourDomain" /></div>
	
	<div class="form_item"><label>User table name <span>(must not exist yet)</span> : </label><input type="text"  value=<?php echo($tableName)?> name="tblName" /></div>
	
	<div class="form_item"><label>Your websites email address : </label><input type="text"  value=<?php echo($siteEmailAddress)?> name="siteEmail" /></div>
	
	<input id="installButton" type="submit" value="Install" />
	
</form>
 
</div>				
			</div>
		
			<div id="footer">
				<div id="footer_inner">
					<div>
						Quick and simple ajax registration and login !
					</div>
				</div>
			</div>
			
</body>	
	
</html>