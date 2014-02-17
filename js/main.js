//Update this script to suit your application . This is a group of functions that are called when actions are succesfully executed or fail
function passwordReset()
{
	$("#forgottenPasswordBlock").hide();
	$("#loginBlock").show();
	$("#passwordError").text("You have been sent new details.");
	$("#passwordError").prepend('<span>* </span>');
	$("#passwordError").show();
	return 0;
}

function loginSuccess()
{
	$('#loadingButton').show();
	updatePage();
	$("#userLoginArea").hide();	
}

function loginFailed()
{
	$("#passwordError").text( 'Incorrect password');
	$("#passwordError").prepend('<span>* </span>');
	$("#passwordError").show();
	$("#aLoginButton").show();
	$('#loadingButton').hide();	
}

function registerSuccess()
{
	$(registerLoadingButton_id).hide();
	$("#regErrors").text("Registration successful");
	$("#regErrors").attr("style","visibility:visible");	
	$("#regErrors").attr("class","pos");
	updatePage();
}
function registerFailed(printMessage)
{
	$("#regErrors").text(printMessage);
	$("#regErrors").attr("style","visibility:visible");	
	$("#regErrors").attr("class","neg");	
}


function updatePage()
{
	$.ajax({
    url: "./index.php", 
    cache: false,
    dataType:"html",
    success: function(response) {
    	
		result = $(response).find("#page_inner");
		$("#page_inner").html(result.html());
		
		$("#passwordError").hide();
		$("#loadingButton").hide();
		$("#reminderError").hide();
		documentRefresh();
    }
});	 
}



function failedPasswordReset()
{
	$("#reminderError").show();
}


