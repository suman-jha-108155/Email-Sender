<?php
session_start();
require_once __DIR__.'/database_connection.php';
require_once __DIR__.'/config.php';


     $user_mail;
     $otp;
     $header;
     $message;
     $config;
     $err;
    
    function send_mail_fun($user_mail){
        $config = new config();
        $user_mail = $user_mail;
        $otp = $otp;
        $message = '
            <body style="background-color:rgb(238,238,238);padding-top:10px;padding-bottom:10px;text-align:center;">
                <div style="width:100%;margin:0 auto;background-color:rgb(248,248,248);padding:10px;">
                    <h1>Congratulations ! <br> You have Un-Subscribed from XKCD Challange</h1><br>
                    <h2>You will not get further E-mails<h2>
                </div><br><br>
                <button style ="height:15px;"> <a href = "localhost/Mail Sender/user/php/Subscribe.php">Click to Subscribe </a></button>
            </body>
        ';

        if(mail($user_mail,'Email Un-Subscription ',$message,$config->header)){
            
        }
        else{
            $err= "Could not send mail please try again";
            header("Location: ../Verification.php?err=".$err);
        }
    }

  
    $otp = $_POST['UN-OTP'];
    $user_mail = $_SESSION['un-email'];

    if($otp == $_SESSION['un-otp'])
    {
        send_mail_fun($user_mail);
        $db = new db();
        $db = $db->database();

        $user_mail = trim($user_mail);
        $user_mail = htmlspecialchars($user_mail,ENT_QUOTES);
        $user_mail = mysqli_real_escape_string($db,$user_mail);

        $query = $db->prepare('DELETE FROM user_data where email = ?');
        $query->bind_param('s',$user_mail);
        $query->execute();
        if($query->affected_rows!=0){
            header("Location: ../Un-Congratulations.php");
        }
        else{
            kill();
            $err = "Please Try Again";
            header("Location: ../Un-verification.php?err=".$err);
            exit();
        }
    }
    else
    {
       
        $err= "Invaid OTP !";
        header("Location: ../Un-verification.php?err=".$err);
    }

    function kill()
    {
        unset($db);
        unset($query);
        unset($user_mail);
        unset($otp);
        unset($err);
        unset($header);
        unset($message);
        unset($config);
    }

?>