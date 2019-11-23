<?php
require 'phpmailer/PHPMailerAutoload.php';

require 'recaptchalib.php';

function sonderzeichen($string)
{
    $string = str_replace("ä", "ae", $string);
    $string = str_replace("ü", "ue", $string);
    $string = str_replace("ö", "oe", $string);
    $string = str_replace("Ä", "Ae", $string);
    $string = str_replace("Ü", "Ue", $string);
    $string = str_replace("Ö", "Oe", $string);
    $string = str_replace("ß", "ss", $string);
    $string = str_replace("´", "", $string);
    return $string;
}


// your secret key
$secret = "6LcplCcTAAAAAGD3O6szP5xVY0QaavkwyFbg2bSi";

// empty response
$response = null;

// check secret key
$reCaptcha = new ReCaptcha($secret);

// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
if ($response != null && $response->success) {

$form_name = sonderzeichen($_POST["name"]);
$form_inhalt = sonderzeichen($_POST["inhalt"]);
$form_reply = $_POST["reply"];
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '172.24.10.1';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'phpmailer';                 // SMTP username
$mail->Password = 'phpmailer';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('webmailer@ff-steinhude.de', 'Kontaktformular - Website');
$mail->addAddress('info@ff-steinhude.de', 'Freifunk Steinhuder Meer');     // Add a recipient
$mail->addReplyTo($form_reply, $form_name);
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Neue Anfrage von: '.$form_name;
$mail->Body    = 'Hallo liebes Freifunk Steinhuder Meer Team. <br> Es wurde eine neue Anfrage mit folgendem Inhalt auf der Website abgesendet: <br><hr><br>'.$form_inhalt;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   ?>
    <!--suppress ALL -->
    <script type="text/javascript">
        <!--
            alert("Anfrage wurde abgesendet!");
            window.location.href = "index.php";
        //–>
    </script>
<?php
}
} else {
 } ?>