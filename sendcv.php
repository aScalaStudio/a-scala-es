<?php


// configuracion de php del servidor de correo
ini_set("SMTP", "ejemplo.com");
ini_set("smtp_port", "localhost");
ini_set('sendmail_from', 'studio@a-scala.es');

// variables para el cuerpo del mensaje
$nombre = utf8_encode(strip_tags($_POST["nombre"]));
// $apellidos = utf8_encode(strip_tags($_POST["apellidos"]));
$mail_to = utf8_encode(strip_tags($_POST["correo"]));
$mail_to = "studio@a-scala.es"; // self send
$mensaje = utf8_encode(strip_tags($_POST["comentario"]));

// variables para el archivo adjunto
$nameFile = $_FILES['archivo']['name'];
$sizeFile = $_FILES['archivo']['size'];
$typeFile = $_FILES['archivo']['type'];
$tempFile = $_FILES['archivo']['tmp_name'];
$fecha = time();
$fechaFormato = date("j/n/Y", $fecha);
$correoDestino = $mail_to;
$asunto = "Enviado por " . $nombre . " ";

// este bloque es para mostrar el contenido de todas las variables usadas para enviar el correo
// este bloque se puede quitar una vez comprobado que todo funciona correctamente

// echo "Nombre = " . utf8_decode($nombre) . " " . utf8_decode($apellidos) . "<br />";
// echo "Mail To = " . $mail_to . "<br />";
// echo "Mensaje = " . utf8_decode($mensaje) . "<br />";
// echo "Archivo = " . $nameFile . "<br />";
// echo "Tamano = " . $sizeFile . "<br />";
// echo "Tipo = " . $typeFile . "<br />";
// echo "Temporal = " . $tempFile . "<br />";
// echo "Fecha = " . $fechaFormato . "<br />";

// Headers
$cabecera = "MIME-VERSION: 1.0\r\n";
$cabecera .= "Content-type: multipart/mixed;";
$cabecera .= "boundary=\"=D=E=L=I=M=I=T=A=D=O=R=\"\r\n";
$cabecera .= "From: studio@a-scala.es ";

// Primera parte del cuerpo -> Contenido de Texto
$cuerpo = "--=D=E=L=I=M=I=T=A=D=O=R=\r\n";
$cuerpo .= "Content-type: text/plain;";
$cuerpo .= "charset=utf-8\r\n";
$cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
$cuerpo .= "\r\n";
$cuerpo .= "Correo enviado por: " . $nombre . " ";
$cuerpo .= " con fecha " . $fechaFormato . "\r\n";
$cuerpo .= "Email: " . $mail_to . "\r\n";
$cuerpo .= "Mensaje: " . $mensaje . "\r\n";
$cuerpo .= "\r\n";

// Segunda parte del cuerpo -> Archivo adjunto
$cuerpo .= "--=D=E=L=I=M=I=T=A=D=O=R=\r\n";
$cuerpo .= "Content-type: application/octet-stream;";
$cuerpo .= "name=" . $nameFile . "\r\n";
$cuerpo .= "Content-Transfer-Encoding: base64\r\n";
$cuerpo .= "Content-Disposition: attachment; ";
$cuerpo .= "filename=" . $nameFile . "\r\n";
$cuerpo .= "\r\n";

// Leemos el archivo a adjuntar
$fp = fopen($tempFile, "rb");
$file = fread($fp, $sizeFile);
$file = chunk_split(base64_encode($file));

// Adjuntamos el archivo leido
$cuerpo .= "$file\r\n";
$cuerpo .= "\r\n";
$cuerpo .= "--=D=E=L=I=M=I=T=A=D=O=R=--\r\n"; // Delimitador de Fin de Mensaje

// Enviamos el correo
if (mail($correoDestino, $asunto, $cuerpo, $cabecera)) {
   echo "";
} else {
   echo "Error en envio";
}
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
              <h2 class="title text-center">CV enviado</h2> 
              <h4 class="text-center">en breve nos pondremos en contacto contigo</h4>
              <a href="trabaja-con-nosotros.html" class="btn btn-primary btn-lg btn-round thank-you" role="button" aria-disabled="true">Volver</a>
          </div>
      </div>
  </div>
</div>
</div>
</body>
</html>
 
<?php
 
?>
<!-- http://trocitosdecodigo.blogspot.com/2016/01/envio-de-email-con-archivos-adjuntos.html -->