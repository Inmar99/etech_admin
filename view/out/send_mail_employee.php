<?php 

require ('../../config/config_global.php');

/* Validamos que el usuario tenga una sasion activa */
if (isset($_SESSION['id_usuario']) && isset($_SESSION['id_perfil'])) {
  if(empty($_SESSION['id_usuario']) && empty($_SESSION['id_perfil'])){
    header("Location: login.php");
  }else{
  }
}else{
  header("Location: login.php");
}


if (isset($_POST['name_employee']) && isset($_POST['email_employee']) && isset($_POST['code_employee']) && isset($_POST['user_employee']) && isset($_POST['password'])) {
    



require "../../src/PHPMailer/class.smtp.php";
require "../../src/PHPMailer/class.phpmailer.php";



$email_envia = "info.iposystems@gmail.com";
$email_password = "iposdeveloper2020";
$email_smtp = "smtp.gmail.com";
$email_puerto = "587";
$email_notis = $_POST['email_employee'];
$email_notis_prog = $email_notis;
$mensaje = "Se ha registrado como usuario en iPOS-Systems..";



$name_employee = $_POST['name_employee'];
$cod = $_POST['code_employee'];
$user_employe = $_POST['user_employee'];
$password = $_POST['password'];
$company_name = $_SESSION['company_comercial_name'];

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = $email_puerto;
$mail->IsHTML(true);
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $email_smtp;
$mail->Username = $email_envia;
$mail->Password = $email_password;


$mail->From = $email_envia; // Email desde donde envio el correo.
$mail->FromName = $email_envia;
$mail->AddAddress($email_notis);
$mail->AddAddress($email_notis_prog); // Esta es la direcci�n a donde enviamos los datos del formulario

$mail->Subject = "El equipo de la comunidad de iPOSSystems te da la bienvenida"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
    <td style='padding: 10px 0 30px 0;'>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'
            style='border: 1px solid #cccccc; border-collapse: collapse;'>
            <tr>
                <td align='center' bgcolor='#06274c'
                    style='padding: 40px 0 30px 0; color: #ffffff; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>
                    <b aling='center'>$company_name</b>
                </td>
            </tr>
            <tr>
                <td bgcolor='#ffffff' style='padding: 40px 30px 40px 30px;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tr>
                            <td style='color: #0f2f64; font-family: Arial, sans-serif; font-size: 20px;'>
                                <b aling='center'>
                                    $name_employee,
                            </td>
                        </tr>
                        <table></table<td style='color: #0b0e13; font-family: Arial, sans-serif; font-size: 18px;'>
                        <b aling='center'>
                            te damos la bienvenida a $company_name ,
                            Comienza a completar tus tareas y automatizar los procesos.
                            Administrar mi perfil
                            Felicitaciones, tu cuenta ya está lista para usarse. Ahora tienes acceso a una variedad
                            de herramientas que permitirán ampliar el alcance de tus tareas.</b>
                </td>
            </tr>
            <tr>
                <td>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tr>
                            <td>
                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td padding: 30px 30px 30px 30px;
                                            style='padding: 1px 0 0 100; color: #020202; font-family: Arial, sans-serif; font-size: 16px;  '>
                                            <strong>
                                                <h2>Datos del Empleado:</h2>
                                            </strong>

                                            Nombre completo:
                                            <strong>$name_employee</strong><br />

                                            Codigo de Empleado:
                                            <strong>$cod</strong><br />

                                            Usuario:
                                            <strong>$user_employe</strong><br />

                                            Password:
                                            <strong>$password</strong><br />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td bgcolor='#06274c' style='padding: 30px 30px 30px 30px;'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%'>
            <tr>
                <td style='color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;' width='75%'>
                    <a href='#' style='color: #ffffff;'>
                        <font color='#ffffff'></font>
                    </a>
                    © 2012 - 2020 | iPOS-Systems
                </td>
                <td align='right' width='25%'>
                    <table border='0' cellpadding='0' cellspacing='0'>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
</td>
</tr>
</table>"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  )
);

/*   $mail->AddStringAttachment($doc, $nombrePDF.'.pdf', 'base64', 'application/pdf'); */
$estadoEnvio = $mail->Send();
if ($estadoEnvio) {
 
echo "ENVIADO CON EXITO";

} else { 

    echo "Error en el envio";

}



}else{
    echo "SIN DATOS";
}
?>

