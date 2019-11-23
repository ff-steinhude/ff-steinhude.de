<?php
require 'phpmailer/PHPMailerAutoload.php';

$name = $_POST["name"];
$sender = $_POST["sender"];
$inhalt = $_POST["inhalt"];

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '172.24.10.1';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'wekan';                 // SMTP username
$mail->Password = 'wekan';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('kontakt@ff-steinhude.de', 'Website');
$mail->addAddress('info@ff-steinhude.de', 'Freifunk Steinhude');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Kontaktanfrage', time();
$mail->Body    = 'Hallo Freifunker! <br> Folgende Anfrage wurde auf der Website gestellt: <br> Name: '.$name.'<br> E-Mail: '.$sender.'<br> Inhalt: '.$inhalt;

if(!$mail->send()) {
 	?>
	<script>
    	window.onload = function () {
        alert('Anfrage wurde nicht versendet! <?php echo $mail->ErrorInfo; ?>');
	window.location = "kontakt.php";
        
 	   }
	</script>
<?php

    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    ?>
	<script>
    	window.onload = function () {
        alert('Anfrage wurde versendet!');
	window.location = "index.php";
        
 	   }
	</script>
<?php
}
	