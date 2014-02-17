<?php
	
	$msqladd = $_POST["mysqlAddress"];
	$dbADBName = $_POST["dbName"];
	$dbAUsername = $_POST["dbUsername"];
	$dbAPassword= $_POST["dbPassword"];
	$rDirectory= $_POST["yourDomain"];
	$tName= $_POST["tblName"];
	$sEAddress= $_POST["siteEmail"];
	
?>

<?php
$filename = 'ajax_register_settings.php';

if (file_exists($filename)) {

	unlink($filename) or die("There was a problem, check this script has write access to the php_functions folder");

	$content = "<?php";
	$content=$content." \n $"."dbAccessdomain"."=".'"'.$msqladd.'"'.";";
	$content=$content."\n $"."dbAccessDBName"."=".'"'.$dbADBName.'"'.";";
	$content=$content."\n $"."dbAccessUsername"."=".'"'.$dbAUsername.'"'.";";
	$content=$content."\n $"."dbAccessPassword"."=".'"'.$dbAPassword.'"'.";";
	$content=$content."\n $"."rootDirectory"."=".'"'.$rDirectory.'"'.";";
	$content=$content."\n $"."tableName"."=".'"'.$tName.'"'.";";
	$content=$content."\n $"."siteEmailAddress"."=".'"'.$sEAddress.'"'.";";
	
	
	$content = $content."\n?>";
	
	file_put_contents($filename, $content);
	
	
	$con = mysql_connect($msqladd,$dbAUsername,$dbAPassword);
	
	if (!$con)
	{
  		die('A connection could not be made:' . mysql_error());
  	}
	
	mysql_select_db($dbADBName, $con);
	
	$sql = 'CREATE TABLE IF NOT EXISTS `'.$tName. '` (
	`id` int(11) NOT NULL auto_increment,
	`username` varchar(32) NOT NULL UNIQUE,
	`password` varchar(32) NOT NULL,
	`email` varchar(100) NOT NULL UNIQUE,
	`active` int(1) NOT NULL default "0",
	`regTime` int(20) NOT NULL default "0",
	PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	';
	
	
	mysql_query($sql,$con);
	mysql_close($con);
	
} else {
		
	$filename = "testFunc.php"; 
	
	$content = "<?php";
	$content=$content." \n $"."dbAccessdomain"."=".'"'.$msqladd.'"'.";";
	$content=$content."\n $"."dbAccessDBName"."=".'"'.$dbADBName.'"'.";";
	$content=$content."\n $"."dbAccessUsername"."=".'"'.$dbAUsername.'"'.";";
	$content=$content."\n $"."dbAccessPassword"."=".'"'.$dbAPassword.'"'.";";
	$content=$content."\n $"."rootDirectory"."=".'"'.$rDirectory.'"'.";";
	$content=$content."\n $"."tableName"."=".'"'.$tName.'"'.";";
	$content=$content."\n $"."siteEmailAddress"."=".'"'.$sEAddress.'"'.";";
	
	
	$content = $content."\n?>";
	
	file_put_contents($filename, $content);
	
	$con = mysql_connect($msqladd,$dbAUsername,$dbAPassword);
	
	if (!$con)
	{
  		die('A connection could not be made:' . mysql_error());
  	}
	
	mysql_select_db($dbADBName, $con);
	
	$sql = 'CREATE TABLE IF NOT EXISTS `'.$tName. ' ` (
	`id` int(11) NOT NULL auto_increment,
	`username` varchar(32) NOT NULL,
	`password` varchar(32) NOT NULL,
	`email` varchar(100) NOT NULL,
	`active` int(1) NOT NULL default "0",
	`rtime` int(20) NOT NULL default "0",
	PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	';
	
	mysql_query($sql,$con);
	mysql_close($con);

}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
	
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<link href='http://fonts.googleapis.com/css?family=Chivo:400,900' rel='stylesheet' type='text/css' />
	<link href='../css/style.css' rel='stylesheet' type='text/css' />
	

	 		
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
		<div id="page">
			<div id="page_inner">
				
				<h2>Installation</h2>
				<p>
					Your installtion has finished with the following attributes : 
					
					<ul>
						<li>MySQL address : <?php echo($msqladd)?> </li>
						<li>Database name : <?php echo($dbADBName)?> </li>
						<li>Database username : <?php echo($dbAUsername)?> </li>
						<li>Database password : <?php echo($dbAPassword)?></li>
						<li>Your domain : <?php echo($rDirectory)?></li>
						<li>User table name : <?php echo($tName)?></li>
						<li>Your websites email address : <?php echo($sEAddress)?></li>
					</ul>
					<br/>
					To test your new installation , click <a href=<?php echo('"'.$rDirectory.'"') ?>>here</a>
					
				</p>
				
				
				</div>		
				</div>
		
			<div id="footer">
				<div id="footer_inner">
					<div>
						Quick and simple ajax registration and login !
					</div>
				</div>
			</div>
		
	</div>
	
	
</body>	
	
</html>







