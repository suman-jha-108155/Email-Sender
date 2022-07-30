function email_validate(user_mail) {
    const validRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (validRegex.test(user_mail)) {
        return true;
    }
    else {
        return false;
    }
}

function ajax_send_otp(user_mail) {
    var email_warn = document.getElementById("email-warn");
    email_warn.innerHTML = "";
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "./user/php/send_otp.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText.trim() == "OTP Sent Successfully"){
                alert("OTP was sent Successfully to your Email")
                window.location.href="localhost/Mail Sender/user/Verification.php";
            }
            else if(this.responseText.trim() == "Email is already in use"){
                
                email_warn.innerHTML = "Email is already in use !";
            }
            else if(this.responseText.trim() == "Invalid Email"){
                
                email_warn.innerHTML = "Invalid Email !";
            }
            else{
              
                email_warn = "Please try Again !";
            }            
        }
    }
    xhttp.send("email="+user_mail);
}



function sendotp()
{
	var email_warn = document.getElementById("email-warn");
	var user_mail = document.getElementById("useremail").value;

	if(user_mail != "" && email_validate(user_mail))
	{
		ajax_send_otp(user_mail);
	}
	else
	{
		email_warn.value = "Invalid Email !";
	}

}