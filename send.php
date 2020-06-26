<?php

/***librerias phpmailer**/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer/src/SMTP.php';
/**********/

$imagen = $_POST["imagen"];
$lyeo_regGP = $_POST["lyeo_regGP"];
$lyeo_regCA = $_POST["lyeo_regCA"];
$lyeo_regND = $_POST["lyeo_regND"];
$lyeo_regCD = $_POST["lyeo_regCD"];
$lyeo_regNA = $_POST["lyeo_regNA"];
/*
echo $imagen;
echo "<br>";
echo $lyeo_regGP;
echo "<br>";
echo $lyeo_regCA;
echo "<br>";
echo $lyeo_regND;
echo "<br>";
echo $lyeo_regCD;
echo "<br>";
echo $lyeo_regNA;
echo "<br>";
//die("fin");
**/
$imagen = preg_replace('#^data:image/[^;]+;base64,#', '', $imagen); 
$mensaje = '<b>Lectura y Expresión Oral y Escrita 1</b><br><b>Nombre del estudiante: </b>'.$lyeo_regNA.'<br><b>Grupo: </b> '.$lyeo_regGP.'<br><b>Docente: </b>'.$lyeo_regND;

$para = $lyeo_regCD;
$para2 = $lyeo_regCA;
$asunto = 'Lectura y Expresion Oral y Escrita 1: Actividad';				
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
//Agregar la imagen
$decode = base64_decode($imagen);
$mail->addStringAttachment($decode, "Actividad.png", "base64", "image/png");
$mensaje .= '<br><img src="https://majesticeducacion.com.mx/nuevo/wp-content/uploads/2018/08/logo-header-majesticeducacion.png">';
 
//Configuracion servidor mail

$mail->From = "ebook@majesticeducationdigital.com"; //remitente
$mail->FromName = "Majestic Education";//nombre remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //seguridad
$mail->Host = "mail.majesticeducationdigital.com"; // servidor smtp
$mail->Port = 465; //puerto
$mail->Username ='ebook@majesticeducationdigital.com'; //nombre usuario
$mail->Password = 'xAp3Rm9=xO+a'; //contraseña


 
//Agregar destinatario
$mail->AddAddress($para);
$mail->AddAddress($para2);
$mail->Subject = $asunto;
$mail->IsHTML(true);
$mail->Body = $mensaje;


 
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Enviado correctamente");
		   window.history.back();
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("No enviado, intenta de nuevo");
        </script>';
}
?>