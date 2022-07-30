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
            <body style=\'background-color:rgb(238,238,238);padding-top:10px;padding-bottom:10px;text-align:center;\'>
                <div style=\'width:50%;margin:0 auto;background-color:rgb(248,248,248);padding:10px\'>
                    <h3>Congratulations ! <br> You have Succesfully Subscribed to XKCD Challange</h3>
                </div><br><br>
                <button> <a href = "localhost/Mail Sender/user/php/Unsuscribe.php">Click to Unsuscribe </a></button>
            </body>
        ';

        if(mail($user_mail,'Email Subscription : Congratulations',$message,$config->header)){
            
        }
        else{
            $err= "Could not send mail please try again";
            header("Location: ../Verification.php?err=".$err);
        }
    }

  
    $otp = $_POST['OTP'];
    $user_mail = $_SESSION['email'];

    if($otp == $_SESSION['otp'])
    {
        send_mail_fun($user_mail);
        $db = new db();
        $db = $db->database();

        $user_mail = trim($user_mail);
        $user_mail = htmlspecialchars($user_mail,ENT_QUOTES);
        $user_mail = mysqli_real_escape_string($db,$user_mail);
        $otp_set = 1;
        $query = $db->prepare('INSERT INTO user_data(email,otp_set) VALUES(?,?)');
        $query->bind_param('ss',$user_mail,$otp_set);
        $query->execute();
        if($query->affected_rows!=0){
            header("Location: ../Congratulations.php");
        }
        else{
            kill();
            $err = "Please Try Again";
            header("Location: ../Verification.php?err=".$err);
            exit();
        }
    }
    else
    {
       
        $err= "Invaid OTP !";
        header("Location: ../Verification.php?err=".$err);
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