/*Global Variables for controlling field updates and page orientation*/

//Form validation variables 
var validRegisterUsername = 0;
var validRegisterPassword = 0;
var validRegisterEmail = 0;
var validRegisterConfirmPassword = 0;
var validNewPassword = 0;
var validConfirmNewPassword = 0;

//Form Fieldname variables  ( CHANGE THESE VALUES TO SUIT YOUR OWN APPLICATION ) 
var usernameField_id = "#usernameField";
var passwordField_id = "#passwordField";
var emailField_id = "";
var regUsernameField_id = "#registerUsername_Field";
var regPasswordField_id = "#registerPassword_Field";
var regConfirmPasswordField_id = "#registerConfirmPassword_Field";
var regEmailField_id = "#registerEmail_Field";
var regConfirmEmailField_id = "#registerConfirmEmail_Field";
var forgottenPasswordField_id ="#forgottenPassword_Field";
var oldPasswordField_id = "#oldPassword_Field";
var newPasswordField_id = "#newPassword_Field";
var confirmNewPasswordField_id = "#confirmNewPassword_Field";

//Button ID's
var loginButton_id = "#aLoginButton";
var loadingButton_id = "#loadingButton";
var forgotEmailButton_id ="#remindMeButton";
var forgotPasswordButton_id="#aForgotPassword";
var registerLoadingButton_id  = "#loadingRegisterButton"
var registerButton_id ="#aRegisterButton";
 
// Error Message ID's
var passwordError_id ="#passwordError";
var usernameTakenError_id =" #nameTakenLabel";
var emailTakenError_id = "#emailTakenLabel"; 
var passwordError_id = "#passwordError_Label";

var currentUser_id = "#usernameSpan"; 

var emailAddressAvailable = 0;


$.getScript("./js/ajax_login_functions.js", function() {});

function documentRefresh() // Cal this function whenever you "Change page" or update the page content.
{
	
	$('input').each(function() { // Clear all text input fields on page loads and content refreshes
		$(this).val("");
	});
	
	$("#forgottenPasswordBlock").hide();
	$(usernameTakenError_id).hide();
	$(emailTakenError_id).hide();

	/*  Validated the registration fields */
	$(regUsernameField_id).keyup(function() {validateUsername(regUsernameField_id); }); 
	$(regPasswordField_id).keyup(function() {validatePassword(regPasswordField_id,"check"); });
	$(regConfirmPasswordField_id).keyup(function() {validatePassword(regConfirmPasswordField_id,"confirm");});
	$(regEmailField_id).keyup(function() {validateEmail(regEmailField_id,"check");});
	$(regConfirmEmailField_id).keyup(function() {validateEmail(regConfirmEmailField_id,"confirm");});  
	$(regUsernameField_id).change(function() {validateUsername(regUsernameField_id);}); 
	$(regPasswordField_id).change(function() {validatePassword(regPasswordField_id,"check");});
	$(regConfirmPasswordField_id).change(function() { validatePassword(regConfirmPasswordField_id,"confirm");});
	$(regEmailField_id).change(function() {validateEmail(regEmailField_id,"check");});
	$(regConfirmEmailField_id).change(function() {validateEmail(regConfirmEmailField_id,"confirm");});
	
	/*  Validated the change password fields */
	$(newPasswordField_id).keyup(function() {validatePassword(newPasswordField_id,"check");});
	$(confirmNewPasswordField_id).keyup(function() {validatePassword(confirmNewPasswordField_id,"confirmNew");});
	
	$('#register_block input').each(function() { // Reset registration fields if left empty
    	$(this).blur(function(){
	    	if($(this).val()=="")
	    	{
	    		var fieldName = "#"+getFieldName($(this).attr("id"));
	    		$(fieldName+"_ResponseImg").attr("src","images/greyTick002.png"); 
	    	}	
    	});
	});
	

	$('#changeDetailsBlock input').each(function() { // Reset registration fields if left empty
    	$(this).blur(function(){
	    	if($(this).val()=="")
	    	{
	    		var fieldName = "#"+getFieldName($(this).attr("id"));
	    		$(fieldName+"_ResponseImg").attr("src","images/greyTick002.png"); 
	    	}	
    	});
	});


	$(forgotEmailButton_id).click(function() { // clicked the remind me button
		performAction("forgottenPassword");
		console.log("erre");
	});//End remind me 
	
	$(forgotPasswordButton_id).click(function() { // clicked the forgotten Password button
		$("#loginBlock").hide();
		$("#forgottenPasswordBlock").show();
	});  //End forgot password
} // End document refresh function

$(document).ready(function() {
	  documentRefresh();
}); // End Document Ready Function