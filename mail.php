<?php
    
    
    error_reporting(e_all);
    ini_set('display_errors', 'On');
    set_error_handler("var_dump");

    $to = "sajjadaslammm@gmail.com";
    $subject = "New User";
     
    $message = "<b>Name:Sajjad</b><br>";
    $message .= "<b>Email:sajjadaslammm@gmail.com</b>";
    echo $message; 
    $header = "sajjadaslammm@gmail.com";
    
    if(mail("sajjadaslammm@gmail.com",$subject,$message,$header)) {
        echo "SENT";
    }
if ( function_exists( 'mail' ) )
{
    echo 'mail() is available';
}
else
{
    echo 'mail() has been disabled';
}

    // echo '<script>window.location = "/";</script>';

?>