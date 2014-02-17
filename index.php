<?php

session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
	
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<link href='http://fonts.googleapis.com/css?family=Chivo:400,900' rel='stylesheet' type='text/css' />
	<link href='css/style.css' rel='stylesheet' type='text/css' />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

	<script src="js/ajax_login.js" type="text/javascript"></script>
	<script src="js/main.js" type="text/javascript"></script>
	 		
	<title>  Ajax / Jquery simple registration system  </title>
	
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
					
					<?php
						if( ! $_SESSION[s_UserID]) // If the user is NOT logged in
						{
							echo('
								<div id="userLoginArea">
									<div id="loginBlock">	
										
										<label>Username : </label>
										<input id="usernameField" type="text" name="username"  />
										
										<label>Password : </label>
										<input id="passwordField" type="password" name="password" />
										
										<a id="aLoginButton" class="buttonStyle formButton" onclick=\'performAction("login")\' >Sign In</a>
										<label style="display:none" id="loadingButton">Loading....</label>
										
										<br/>

										<label id="passwordError"><span>*</span> Incorrect password</label><a id="aForgotPassword">Forgotten Password?</a>		
									</div><!-- End Login Block -->
									
									<div id="forgottenPasswordBlock">
											<label>Email : </label>
											<input id="forgottenPassword_Field" type="text" name="forgottenPassword"  />
											<a class="buttonStyle longButton" id="remindMeButton">Remind Me</a>
											
											<br/>
											<label id="reminderError" style="display:none;"><span>* </span>Email address not found</label>
									</div><!-- End forgotten password Block -->
								</div>	<!-- End Login Area -->
							');
					}else{ // if the user IS logged in 
						
						echo('
							<div id="userLoginArea" style="display:none;">
									<div id="loginBlock">	
										
										<label>Username : </label>
										<input id="usernameField" type="text" name="username"  />
										
										<label>Password : </label>
										<input id="passwordField" type="password" name="password" />
										
										<a id="aLoginButton" class="buttonStyle formButton" onclick=\'performAction("login")\' >Sign In</a>
										<label style="display:none" id="loadingButton">Loading....</label>
										
										<br/>

										<label id="passwordError"><span>*</span> Incorrect password</label><a id="aForgotPassword">Forgotten Password?</a>		
									</div><!-- End Login Block -->
									
									<div id="forgottenPasswordBlock">
											<label>Email : </label>
											<input id="forgottenPassword_Field" type="text" name="forgottenPassword"  />
											<a  class="buttonStyle longButton" id="remindMeButton">Remind Me</a>
									</div><!-- End forgotten password Block -->
								</div>	<!-- End Login Area -->
						'); //Update here for contents in the login area whilst logged in.
					}
					?>
			</div><!-- End Header Inner -->
		</div><!-- End Header -->
		
		<div id="page">
			<div id="page_inner">
				
				<?php
				
				if( ! $_SESSION['s_UserID'])
				{
						
						echo('
						
						<div id="register_block" class="page_block">
							
							<h2 class="inputHeader">Register</h2>
							
							<div id="registerUsernameBlock">
								<label id="registerUsername_Label">Choose Username:</label>
								<label id="nameTakenLabel">This name is already taken</label>
							
								<div class="registerInputBlock" >
									<input id="registerUsername_Field"type="text" name="username"  />
									<img id="registerUsername_ResponseImg" src="images/greyTick002.png" alt="response image" />
								</div><!-- End register input block -->
							</div><!-- End register username block -->
							
							<br/>

							<div id="registerPasswordBlock">
								
								<label id="registerPassword_Label">Password:</label>
									<div class="registerInputBlock">
										<input id="registerPassword_Field" type="password" name="registerPassword" />
										<img id="registerPassword_ResponseImg" src="images/greyTick002.png" alt="response image"/>
									</div> <!-- End registerInputBlock  -->
							</div> <!--End registerPasswordBlock -->
								
							<br/>
							
							<div id="registerConfirmPasswordBlock">
								<label id="registerConfirmPassword_Label">Confirm Password:</label>
								<div class="registerInputBlock">
									<input id="registerConfirmPassword_Field" type="password" name="registerConfirmPassword" />
									<img id="registerConfirmPassword_ResponseImg" src="images/greyTick002.png" alt="response image"/>
								</div><!-- End registerInputBlock  -->
							</div><!-- End registerConfirmPasswordBlock  -->
							
							<br/>
								
							<div id="registerEmailBlock">
								<label id="registerEmail_Label">Email:</label>
								<label id="emailTakenLabel">This address is already registered</label>
								<div class="registerInputBlock">
									<input id="registerEmail_Field" type="text" name="registerEmail" />
									<img id="registerEmail_ResponseImg" src="images/greyTick002.png" alt="response image"/>
								</div><!-- End registerInputBlock -->
							</div><!-- End registerEmailBlock-->
							
							<br/>
								
							<div id="registerConfirmEmailBlock">
								<label id="registerConfirmEmail_Label">Confirm Email:</label>
								<div class="registerInputBlock">
									<input id="registerConfirmEmail_Field" type="text" name="registerConfirmEmail" />
									<img id="registerConfirmEmail_ResponseImg" src="images/greyTick002.png" alt="response image"/>
								</div> <!-- End registerInputBlock-->
							</div><!-- End registerConfirmEmailBlock -->
								
							<br/>
							
							<span id="registerPassword_InstructionsLabel">
								<span class="ast">*</span>
								The username and password must contain at least one uppercase letter, one number and be at least 6 digits long.
							</span>
							
							<br/>
							<br/>
								
							<div id="registerActions">
								<label style="display:none" id="loadingRegisterButton">Loading....</label> <!--Remember to chnage this iD -->
								<label id="regErrors" class="neg" style="visibility:hidden">There was an error</label>
								<a id="aRegisterButton" class="formButton" onclick=\'performAction("register")\' >Register</a>
								<label style="display:none" id="loadingButton">Loading....</label> <!--Remember to chnage this iD -->
								<br/>
								
							</div>
							</div>	
						</div>		
						
						');
				}else{
					
					echo('
						<h3>Welcome <span id="usernameSpan">'. $_SESSION['s_Username'].'</span> !</h3>
							<div id="userLogoutArea">
								<div id="logoutBlock">
								
								</div>
							</div>
					');

					if($_SESSION['s_UserActive'] == 1)// If the user as activated their account then :
					{
						
						echo('
						
						
							<p>
								To change your password, please fill in the form below :
								<br/><br/>
								
							</p>
						<div id="changeDetailsBlock">
						
						<div id="oldPasswordBlock">
								
								<label id="oldPasword_Label">Old Password:</label>
									<div class="oldPasswordInputBlock">
										<input id="oldPassword_Field" class="noResponse" type="password" name="registerPassword" />
										
									</div>
							</div>
						
							<div id="newPasswordBlock">
								
								<label id="changePasword_Label">New Password:</label>
									<div class="newPasswordInputBlock">
										<input id="newPassword_Field" type="password" name="newPassword" />
										<img id="newPassword_ResponseImg" src="images/greyTick002.png" alt="response image"/>
									</div>
							</div>
							
							
							<div id="confirmNewPasswordBlock">
								
								<label id="confirmNewPasword_Label">Confirm New Password:</label>
									<div class="confirmNewPasswordInputBlock">
										<input id="confirmNewPassword_Field" type="password" name="confirmNewPassword" />
										<img id="confirmNewPassword_ResponseImg" src="images/greyTick002.png" alt="response image"/>
									</div>
							</div>
							
							<div id="passwordErrorBlock">
								
								<label class="pos" id="passwordError_Label" style="visibility:hidden;">There was an error.</label>
									
							</div>
							
							<div id="changeDetailsControls">
								<a onclick="changePassword()" >Submit</a>
								<a onclick="logOut()" >Logout</a>								
							</div>
							
							<br/><br/>	
								<span id="registerPassword_InstructionsLabel"><span class="ast">*</span>The Password must contain at least one uppercase letter, one number and be at least 6 digits long.</span>
							<br/><br/>
							
						</div>
						
						
						');
						
						
					}else{ // If they have not activated their account print the following:
						
						echo('
							<p>
								We have sent you an activation email to the address you specified. <br/><br/>To update 
								your details you will need to follow the instructions in the email. 
								<br/><br/>
								Please activate your account or<a onclick="logOut()" > Logout</a>
								<br/><br/>
							</p>
						');
					}
				}
				?>
				
				
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