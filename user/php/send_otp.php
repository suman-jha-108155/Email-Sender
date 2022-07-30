<?php
session_start();
require_once __DIR__.'/database_connection.php';
require_once __DIR__.'/config.php';


     $db;
     $query;
     $user_mail;
     $otp;
     $new_otp;
     $header;
     $message;
     $config;
    
    function kill()
    {
        unset($db);
        unset($query);
        unset($user_mail);
        unset($otp);
        unset($new_otp);
        unset($header);
        unset($message);
        unset($config);
    }

    function send_mail_fun($user_mail, $otp){
        $config = new config();
        $user_mail = $user_mail;
        $otp = $otp;
        $message = '
            <body style=\'background-color:rgb(238,238,238);padding-top:10px;padding-bottom:10px;text-align:center;\'>
                <div style=\'width:50%;margin:0 auto;background-color:rgb(248,248,248);padding:10px\'>
                    <h3>Your OTP for email verification is</h3>
                    <h1>'.$otp.'</h1>
                </div>
            </body>
        ';

        if(mail($user_mail,'Email Subscription',$message,$config->header)){
            header("Location: ../Verification.php");
        }
        else{
            echo 'Please try Again';
        }
    }

    
        if(isset($_POST['email'])){
            $user_mail = $_POST['email'];
        }
        else{
            
            $err = "Invalid Mail";
            header("Location: ../../index.php?err=".$err);
            exit();
        }

        if (!filter_var($user_mail, FILTER_VALIDATE_EMAIL)) {

            kill();
            $err = "Invalid Mail";
            header("Location: ../../index.php?err=".$err);
            exit();
        }

        $new_otp = random_int(100000, 999999);
        $db = new db();
        $db = $db->database();

        $user_mail = trim($user_mail);
        $user_mail = htmlspecialchars($user_mail,ENT_QUOTES);
        $user_mail = mysqli_real_escape_string($db,$user_mail);

        $query = $db->prepare('SELECT * FROM user_data WHERE email=?');
        $query->bind_param('s',$user_mail);
        $query->execute();
        $query->store_result();

        if ($query->num_rows != 0) {
            kill();
            $err= "Email is already in use";
            header("Location: ../../index.php?err=".$err);
            exit();
        }

        else{
            

            send_mail_fun($user_mail,$new_otp);
            $_SESSION['otp'] = $new_otp;
            $_SESSION['email'] = $user_mail;
    }

?>