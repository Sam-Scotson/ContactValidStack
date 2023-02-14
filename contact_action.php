<?php session_start();
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$msg = $_POST['msg'];
$captcha_val = $_POST['captcha_val'];
$error = array();
if (strlen($name) < 2) {
    $error[] = 'Min lenght 3 characters, No digits or special charaters';
}
if (strlen($name) > 2) {
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $error[] = 'Min lenght 3 characters, No digits or special charaters';
    }
}
if (strlen($name) > 20) {
    $error[] = 'Max length 20 Characters';
}

if ($email == '') {
    $error[] = 'Please enter email';

}

if (strlen($email) != '') {
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) {
        $error[] = 'Enter valid email';
    }
}
if (strlen($msg) == '') {
    $error[] = 'Please enter your message';

}
if ($captcha_val == '') {
    $error[] = 'Please enter captcha';

}
if ($captcha_val != '') {
    if ($_SESSION['captcha'] != $captcha_val) {
        $error[] = 'Invalid captcha';

    }

}

$error_str = implode('<br>', $erro);
if ($error != NULL) {
    $last_status = 'failed';
}
if ($error == NULL) {

    $FromName = 'CoastFM';
    $FromEmail = 'cfm-contact-form@gotech.co.nz';
    $to_email = 'dave@coastfm.net.nz';
    $ReplyTo = $email;
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: " . $FromName . " <" . $FromEmail . ">\n";
    $headers .= "Reply-To: " . $ReplyTo . "\n";
    $headers .= "X-Sender: <" . $FromEmail . ">\n";
    $headers .= "X-Mailer: PHP\n";
    $headers .= "X-Priority: 1\n";
    $headers .= "Return-Path: <" . $FromEmail . ">\n";
    $subject = "You have received a contact message from  " . $FromName;
    $msg = $message = 'Name:- ' . $name . '<br>Email:- ' . $email . '<br> Mobile Number:- ' . $mobile . '<br> Message:- ' . $msg;
    if (mail($to_email, $subject, $msg, $headers, '-f' . $FromEmail)) {

        $last_status = 'success';
    } else {
        $last_status = "failed";
        $error_str = "Please try again ...";
    }
}
$response = array(
    'errors' => $error_str,
    'status' => $last_status
);
echo json_encode($response);

?>