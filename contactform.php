<?php
/**
 * New version as of 8/4/18
 */
// echo 'PHP version: ' . phpversion();

ini_set('display_errors',1);
error_reporting(E_ALL);

$msg = '';
$name = $email = $message = "";

if (!empty($_POST['name']) ) {
    $name = test_input($_POST['name']);
    $email = test_input($_POST["email"]);
    $message = test_input($_POST['message']);

    require 'contact/vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->setFrom('contact@vietwar.sitehost-test.iu.edu', 'Vietnam War Stories');
    //$mail->addAddress('ejblom@iu.edu', 'John Doe');
    // $mail->addAddress('osgoodr@indiana.edu', 'Professor Ron Osgood');
    $mail->addAddress('shchua@iu.edu', 'CCJOSEPH');
    $mail->Subject = 'A message from Vietnam War Stories';

    if (!empty($_FILES['userfile']['name']) ) {
        // create the body
        $body = "Message from: " . $name . "\r\n" . "Contact them: " . $email . "\r\n" . "Their message: " . $message;

        // First handle the upload
        // Don't trust provided filename - same goes for MIME types
        // See http://php.net/manual/en/features.file-upload.php#114004 for more thorough upload validation
        // $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['userfile']['name']));
        $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['userfile']['name']));
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

            $mail->Body = $body;

            // Attach the uploaded file
            $mail->addAttachment($uploadfile, $_FILES['userfile']['name']);
            if (!$mail->send()) {
                $msg .= "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $msg .= "<h1>Thanks for contacting us!</h1><p>Your message has been sent. We may contact you about your story<p>";
    ;
            }
        } else {
            $msg .= '<p>Failed to upload file ' . $uploadfile . ". It may have been too big. Try a file less than 5 mb.<p>";
        }
    } else {        
        // create the body
        $body = "Message from: " . $name . "\r\n" . "Contact them: " . $email . "\r\n" . "Their message: " . $message;

        $mail->Body = $body;

        if (!$mail->send()) {
                $msg .= "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $msg .= "<h1>Thanks for contacting us!</h1><p>Your message has been sent. We may contact you about your story<p>";
            }
    }
} else {
    $msg ="<p>You got here the wrong way.</p>";
}

// does some validation
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="css/bootstrap/bootstrap-multiselect.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cardo" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">

<title>Contact Us</title>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
li { font-family: 'Raleway', sans-serif;
}
</style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Vietnam War Stories <small>Stories From All Sides</small></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="./index.html"><b>HOME</b></a></li>
                        <li><a href="./glossary.html"><b>GLOSSARY</b></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FILM <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="https://vimeo.com/312861149" target="_blank">Trailer</a></li>
                                <!-- <li><a href="http://www.ronosgood.com/vietnam-waramerican-war2.html" target="_blank">Film Information</a></li> -->
                                <li><a href="https://nam12.safelinks.protection.outlook.com/?url=http%3A%2F%2Fwww.ronosgood.com%2Fvietnam-waramerican-war.html&amp;data=05%7C01%7Cshchua%40iu.edu%7Caa576bdeff9d4437ae7808da60879ba9%7C1113be34aed14d00ab4bcdd02510be91%7C0%7C0%7C637928432790818256%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C3000%7C%7C%7C&amp;sdata=6FgpTnViTMiEPi0LNdvTadR0iTLlSp2N3tI%2FE6HyESA%3D&amp;reserved=0" target="_blank">Film Information</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="https://www.facebook.com/VietnamWarStories/" target="_blank">Facebook</a></li>
                                <li><a href="https://www.youtube.com/channel/UCOhrQ7v8S5URDi0rf7z6UHw/videos" target="_blank">YouTube</a></li>
                            </ul>
                        </li>
                        <li><a href="./contactform.html"><b>TELL YOUR STORY</b></a></li>
                    </ul> <!-- /.navbar-nav -->
                </div> <!-- #navbar -->
            </div> <!-- /.container-fluid -->
        </nav> <!-- /.navbar -->

<div class="container">
<?php
echo $msg;
?>
<p>Back to <a href="https://vietwar.sitehost-test.iu.edu\">Vietnam War Stories</a></p>
</div>
</body>
