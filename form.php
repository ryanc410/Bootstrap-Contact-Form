<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$date = date("m-d-Y");
// Define variables and initialize with empty values
$nameErr = $emailErr = $messageErr = "";
$name = $email = $subject = $message = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate user name
    if (empty(test_input($_POST["form_name"]))) {
        $nameErr = "Please enter your name.";
    } else {
        $name = test_input($_POST["form_name"]);
        }

    // Validate email address
    if (empty(test_input($_POST["form_email"]))) {
        $emailErr = "Please enter your email address.";
    } else {
        $email = test_input($_POST["form_email"]);
        }

    // Validate user comment
    if (empty(test_input($_POST["form_message"]))) {
        $messageErr = "Please enter your comment.";
    } else {
        $comment = test_input($_POST["form_message"]);
    }

    // Check input errors before sending email
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {

        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;               //Enable verbose debug output
            $mail->isSMTP();                                     //Send using SMTP
            $mail->Host = '';                                    //Set the SMTP server to send through
            $mail->SMTPAuth = true;                              //Enable SMTP authentication
            $mail->Username = '';                                //SMTP username
            $mail->Password = '';                                //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;     //Enable implicit TLS encryption
            $mail->Port = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('noreply@713techsupport.com', 'noreply');
            $mail->addAddress('admin@713techsupport.com', 'Admin');     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body = <<<EOT
<h1>New Contact Form Submission</h1><br><br><br>
<h3>Date:</h3> $date<br><br>
<h3>Name:</h3> $name<br><br>
<h3>Email:</h3> $email<br><br>
<h3>Message:</h3> $comment
EOT;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            header("Location: thank-you.php");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Form with Jquery Live Validation</title>
<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Form Validation Styles -->
    <link rel="stylesheet" href="css/custom-styles.css" type="text/css">
<!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
<center><h1>Contact Form with Live Validation and PHPMailer</h1></center>
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-sm-12 d-block mx-auto">
            <form id="contactForm" method="post">
                <div class="mb-3 mt-3">
                    <label for="form_name" class="mb-1">Name</label>
                    <input type="text" class="form-control mb-1" name="form_name" id="form_name" />
                    <div class="name-msg"></div>
                    <div class="error"><?php echo $nameErr; ?></div>
                </div>
                <div class="mb-3">
                    <label for="form_email" class="mb-1">Email</label>
                    <input type="email" class="form-control mb-1" name="form_email" id="form_email" />
                    <div class="email-msg"></div>
                    <div class="error"><?php echo $emailErr; ?></div>
                </div>
                <div class="mb-3">
                    <label for="form_message" class="mb-1">Message</label>
                    <textarea class="form-control mb-1" rows="4" name="form_message" id="form_message"></textarea>
                    <div class="msg-msg"></div>
                    <div class="error"><?php echo $messageErr; ?></div>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" id="submit-btn" value="Send" />
                </div>
            </form>
        </form>
    </div>
</div>
<!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- LIVE FORM VALIDATION -->
    <script src="js/validation.js" type="text/javascript"></script>
</body>
</html>
