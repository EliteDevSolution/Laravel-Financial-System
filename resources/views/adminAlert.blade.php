<?php
if (Auth::user()->email_sent == 0) {
    echo '<script>window.location = "/";</script>';
}
$name = Auth::user()->name;
$email = Auth::user()->email;
$data = array(
    'name' => $name,
    'email' => $email,
);
$data2 = array(
    'name' => $name,
    'email' => $email,
);
$emails = ['sajjadaslammm@gmail.com', 'insurance@ksbin.com'];


\Mail::send('emails.userWelcome', $data2, function($message2) use ($data2, $email)
{
    $message2->from('amit@ksbin.com', "KSBIN New User");
    $message2->subject("User Registration");
    $message2->to($email);
});


\Mail::send('emails.newUser', $data, function($message) use ($data)
{
    $message->from('amit@ksbin.com', "KSBIN New User");
    $message->subject("New User Registration");
    $message->to(['sajjadaslammm@gmail.com']);
});

echo "Redirecting...";

Auth::user()->email_sent = 1;
Auth::user()->save();
echo '<script>window.location = "/";</script>';

?>