<?php
if(isset($_POST['email'])) {
 
    // EMAIL DE RECEPCIÓN y ASUNTO
    $email_to = "studio@a-scala.es";
    $email_subject = "Contacto desde el sitio web a-Scala Studio";
 
    function died($error) {
        // your error code can go here
        echo "Lo sentimos, pero hay errores n el envío. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('Lo sentimos, hay algunos errores.');       
    }
  
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Email no valido.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Nombre no valido.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'Parece que el formato no es valido.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalles del envío\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }    
 
    $email_message .= "Nombre y Apellidos: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- thank you page -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="./assets/img/favicon.png"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Contacto
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- CSS Files -->
	<link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="./assets/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="./assets/demo/demo.css" rel="stylesheet" />
</head>
<body class="contact-page sidebar-collapse burger-menu scala"> 
	<div class="main">
		<div class="contact-content">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-5 ml-auto mr-auto">
						<h2 class="title text-center">Gracias por escribirnos</h2> 
						<h4 class="text-center">en breve nos pondremos en contacto contigo</h4>
						<a href="contacto.html" class="btn btn-primary btn-lg btn-round thank-you" role="button" aria-disabled="true">Volver</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
 
<?php
 
}
?>