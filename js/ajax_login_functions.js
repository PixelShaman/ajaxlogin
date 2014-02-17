/*Prepare the details to be sent to backend*/
var allEntries=[];
allEntries[0]=""; // Action (login / register / unegister / logout)
allEntries[1]=""; // Param (username / password)
allEntries[2]=""; // Entry (Text from associated field or actual value to test against)


callAjax = function (dataToSend,dir) {
	var result = $.ajax({
		type: "POST",
		url: dir,
		data: {
			action: dataToSend
		},
           async: false,
            success: function (data) {
            	console.log("data"+data);
          }
        }) .responseText ;
        return  result;
} // end callAjax Function

function getFieldName(field)
{
	return fieldName=field.split("_")[0]; // Make the field we are working on easier to read.	
} // End getFieldName Function

function logOut(){
	 $.ajax({
		type: "POST",
		url: "./php_functions/logout.php",
		data: {
			action: "dataToSend"
		},
           async: false,
            success: function (data) {
            	updatePage();
          }
       }) ;	
	$("#userLoginArea").show();
    $("#loginBlock").show();
}

function changePassword()
{
		var entries=[];
		entries[0] = $(currentUser_id).text();
		entries[1] = $(oldPasswordField_id).val()
		entries[2] = $(confirmNewPasswordField_id).val();
		
		if(validNewPassword==1 && validConfirmNewPassword ==1)
		{
			$.ajax({
			type: "POST",
			url: "./php_functions/changePassword.php",
			data: {
				action: entries
			},
	           async: false,
	            success: function (data) {
	            	
	            	if(data=="1")
	            	{
	            		$(passwordError_id).text("Password successfully changed");
	            		$(passwordError_id).attr("style","visibility:visible");	
	            		$(passwordError_id).attr("class","pos");
	            	}
	            	else{
	            		$(passwordError_id).text(data);
	            		$(passwordError_id).attr("style","visibility:visible");
	            		$(passwordError_id).attr("class","neg");
	            	}
	          }
	       });
       }else
       {
		   	$(passwordError_id).text("The new password was not formatted correctly.");
			$(passwordError_id).attr("style","visibility:visible");
			$(passwordError_id).attr("class","neg");
       }
}// End change password function

function validatePassword(field,validateAction)
{
	var entry = $(field).val(); 
	var fieldName=getFieldName(field);// Make the field we are working on easier to read.
	if(validateAction=="check")
	{
		if(entry.length > 5 && entry.length < 15)
		{
			if(/\d/.test(entry)) // Test the password contains at least 1 number
			{
				if(entry.match(/[A-Z]/)) // Check for at least 1 uppercase letter
				{	
					if($(fieldName+"_ResponseImg")){ 
						$(fieldName+"_ResponseImg").attr("src","images/greenTick002.png"); // This is a valid password
					}
					validNewPassword = 1;
					validRegisterPassword = 1;
					return 1;
				}else{$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");validRegisterPassword=0;}
			}else{$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");validRegisterPassword=0;}
		}else{$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");validRegisterPassword=0;}
	}
	
	if (validateAction=="confirm")
	{
		
		$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");validRegisterConfirmPassword=0;
		if($(regPasswordField_id).val() == $(regConfirmPasswordField_id).val())
		{
			validRegisterConfirmPassword = 1;
			$(fieldName+"_ResponseImg").attr("src","images/greenTick002.png");	
		}else{$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");validRegisterConfirmPassword=0;}
	} // End confirm password
	
	if (validateAction=="confirmNew")
	{
		
		$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");validRegisterPassword=0;
		if($(confirmNewPasswordField_id).val() == $(newPasswordField_id).val())
		{
			validConfirmNewPassword = 1;
			$(fieldName+"_ResponseImg").attr("src","images/greenTick002.png");	
		}else{$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");validRegisterPassword=0;}
	} // End confirm password
}//End validatePassword Function


function validateEmail(field,validateAction)
{
	var theEmail = $(field).val();
	var fieldName = getFieldName(field);
	var atis=theEmail.indexOf("@");
	var dotis=theEmail.lastIndexOf(".");
	
	if(validateAction=="check")
	{	
		if (atis<1 || dotis<atis+2 || dotis+2>=theEmail.length) // If not valid
	  	{
	  		$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");
			return 0;
	  	}
	if (!(atis<1 || dotis<atis+2 || dotis+2>=theEmail.length))
	{
		if(performAction("checkEmail")==0)// CHECK EMAIL IS NOT TAKEN
	  			{
			  		$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");
			  		emailAddressAvailable = 0;
			  		$(emailTakenError_id).show();
			  	}else{
			  		$(fieldName+"_ResponseImg").attr("src","images/greenTick002.png");
			  		$(emailTakenError_id).hide();
			  		emailAddressAvailable = 1;
			  	}//email taken!
	}//End checking the dot / @ positions
	} // End checking email 
	
	 if(validateAction=="confirm")
  		{

	  		if($(regConfirmEmailField_id).val()== $(regEmailField_id).val())
	  		{
	  				if(emailAddressAvailable==1){
	  					validRegisterEmail = 1;
	  					$(fieldName+"_ResponseImg").attr("src","images/greenTick002.png");
	  				}else{
	  					validRegisterEmail = 0;
	  					$(regConfirmEmailField_id+"_ResponseImg").attr("src","images/redCross002.png");	
	  				}
	  		}else
	  		{
	  			$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");
	  			validRegisterEmail = 0;
	  		}
  		}// End confirm
}//End validateEmail Function


function performAction(action)
{
	allEntries[0] = action;
	
	if(action == "forgottenPassword")
	{
		var entry = $(forgottenPasswordField_id).val();
		allEntries[1]="action";
		allEntries[2]=entry;
		
		if(callAjax(allEntries,"./php_functions/forgottenPassword.php")=="1") // Pass the details to the server
		{
			passwordReset();
		}else{
			failedPasswordReset();
		}
	}
	
	if(action == "login" )
	{
		if(validateUsername(usernameField_id)==1 && validatePassword(passwordField_id,"check")==1  )
		{
			var entry = $(usernameField_id).val()+"|"+$(passwordField_id).val();
			allEntries[1]="action";
			allEntries[2]=entry;
			
			$(loginButton_id).hide();
			$(loadingButton_id).show();
			
			if(callAjax(allEntries,"./php_functions/login.php")=="1") // Pass the details to the server
			{
				$(loginButton_id).show();
				$(passwordError_id).hide();
				loginSuccess();
			}else
			{
				loginFailed();
				return 0;
			}		
		}else
		{
			loginFailed();
			return 0;
		}
		
		
		
	} // End Login action
	
	
	if(allEntries[0] == "checkUsername")
	{
		var entry = $(regUsernameField_id).val();
		allEntries[1]="action";
		allEntries[2]=entry;
		
		if(callAjax(allEntries,"./php_functions/login.php")=="1") // Pass the details to the server
		{
			validRegisterUsername=1; // Confirm the username has been validated
			$(usernameTakenError_id).hide();
			$(getFieldName(regUsernameField_id)+"_ResponseImg").attr("src","images/greenTick002.png");
		}else{
			validRegisterUsername=0;
			$(usernameTakenError_id).show();
			$(getFieldName(regUsernameField_id)+"_ResponseImg").attr("src","images/redCross002.png");
		}
			
	} // End Check Username action
	
	if(allEntries[0] == "checkEmail")
	{
		var entry = $(regEmailField_id).val();
		allEntries[1]="action";
		allEntries[2]=entry;
		
		if(callAjax(allEntries,"./php_functions/login.php")=="1") // Pass the details to the server
		{
			
			$(regEmailField_id+"_ResponseImg").attr("src","images/greenTick002.png");
			return 1;
		}else{
			$(regEmailField_id+"_ResponseImg").attr("src","images/redCross002.png");
			return 0;
		}
			
	} // End Check Username action
	
	
	if(allEntries[0] == "register")
	{
		var entry = $(regUsernameField_id).val()+"|"+$(regPasswordField_id).val()+"|"+$(regEmailField_id).val();
		allEntries[1]="action";
		allEntries[2]=entry;

		if(validRegisterUsername && validRegisterPassword && validRegisterEmail && validRegisterConfirmPassword) // Confirm registration form has been validated.
		{
			$(registerLoadingButton_id).show();
			$(registerButton_id).hide();
			if(callAjax(allEntries,"./php_functions/login.php")=="1")
			{
				validRegisterUsername = 0;
				validRegisterPassword = 0;
				validRegisterConfirmPassword = 0;
				validRegisterEmail = 0;
				vallidNewPassword = 0;
				validConfirmNewPassword = 0; 
				registerSuccess();
			}else
			{
				registerFailed("There was an error");	
			}
		}else
		{
			registerFailed("Please complete the form.");
		}
	}// End Register action
}// End performAction Function

function validateLoginName()
{
	if(   $(userName).val().length>=6   &&    $(userName).val().length<=15    ) // If registration username attempt is correct length
	{
		if(/\d/.test( $(userName).val() )  ) // Test the username contains at least 1 number
		{	
			return 1;
		}else
		{
			return 0;
		}
	}else
	{
		return 0;
	}
}

function validateUsername(userName)
{
	if(userName == usernameField_id)
	{
		
		if(   $(userName).val().length>=6   &&    $(userName).val().length<=15    ) // If registration username attempt is correct length
		{
			if(/\d/.test( $(userName).val() )  ) // Test the username contains at least 1 number
			{	
				return 1;
			}
		}else
			{
				$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");
		}		
	}else
	{
		var fieldName=getFieldName(userName);// Make the field we are working on easier to read.
		if(   $(userName).val().length>=6   &&    $(userName).val().length<=15    ) // If registration username attempt is correct length
		{
			if(/\d/.test( $(userName).val() )  ) // Test the username contains at least 1 number
			{	
				performAction("checkUsername");
			}
		}else
			{
				$(fieldName+"_ResponseImg").attr("src","images/redCross002.png");
		}			
	}
	

		
	

} // End the username validation Function




