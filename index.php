<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe</title>
    <link rel="stylesheet" href="user/css/subscribe.css">
    <link rel="icon" href="https://media1.giphy.com/media/KGI4gmWK9yPsI/giphy.gif" type="image/gif" sizes="16x16">
    <!--<script type="text/javascript" src="./js/subscribe.js"></script>-->
</head>

<body>
    <div id="mainDiv">
        <form name="subscribe" method="post" action="user/php/send_otp.php">
            <div id="formDiv">
                <img src="user/img/email.png" alt="E-mail" id="email-image">
                <div id="contentDiv">
                    <h1>XKCD Challange Subscription</h1>
                    <input type="text" name="email" placeholder="E-mail" id="useremail" />
                    <ul style="list-style-type: square;"><li id="span-element">OTP will be sent to your Email for Verification.</li>
                    <ul><br>
                    <label style="margin-left: 2em;padding-top: 1em;"><b><?php if($_GET)
                    {echo $_GET['err'];} else{} ?></b></label><br>
                    <input type="submit" name="Submit" value="Subscribe" /> <br> <br> <br>
                </div>
            </div>
        </form>
    </div>

    <footer>
        <h4>© Suman Jha</h4>
    </footer>
</body>

</html>