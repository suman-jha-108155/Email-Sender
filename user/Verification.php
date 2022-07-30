<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subsribe</title>
    <link rel="stylesheet" href="css/subscribe.css">
    <link rel="icon" href="https://media1.giphy.com/media/KGI4gmWK9yPsI/giphy.gif" type="image/gif" sizes="16x16">
</head>

<body>
    <div id="mainDiv">
        <form action="php/verify_otp.php" name="subscribe" method="post">
            <div id="formDiv">
                <img src="img/email.png" alt="E-mail" id="email-image">
                <div id="contentDiv">
                    <h1>XKCD Challange Subscription</h1>
                    <input type="text" name="OTP" placeholder="Enter Your OTP" id="emailField" />
                   <!-- <ul id="span-element" style="list-style-type: square;"><li ></li>
                    <ul>-->
                    <br>
                    <label style="margin-left: 2em;padding-top: 1em;"><b><?php if($_GET)
                    {echo $_GET['err'];} else{} ?></b></label><br>
                    <input type="submit" name="Submit" value="Verify" /> <br> <br> <br>
                </div>
            </div>
        </form>
    </div>

    <footer>
        <h4>© Suman Jha</h4>
    </footer>
</body>

</html>