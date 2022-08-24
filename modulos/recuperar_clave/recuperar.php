<?php
require_once("conexion.php");

$email = $_POST['email'];


		
//$email = mysql_real_escape_string($email);

function buscarcorreo($email,$conexion){
 $sql = "SELECT persona.email , persona.nombre FROM `usuario` 
JOIN  persona on usuario.id_persona = persona.idpersona WHERE email = '$email'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)>0) {
  return 1;

}else{
 return 0;
    }
}

$errores = "";
$respuesta = [];

if ($email == "") {
    $errores .= "<li>El campo ' email' es obligatorio</li>";
}
if(buscarcorreo($email,$conexion)==0) {
    $errores .= "<li>Este correo no esxiste. </li>";
}


if ($errores != "") {
    $respuesta['error'] = true;
    $respuesta['msg'] = $errores;
    echo json_encode($respuesta);
        exit(0);

 }
 if(buscarcorreo($email,$conexion)==1) {
  $token=uniqid();
   $act= "UPDATE persona SET token='$token' WHERE email ='$email'" ;
   $result=mysqli_query($conexion, $act);

   $email_to= $email;
   $email_subject= "Cambio de contraseña";
   $email_from = "josejitho_1999@hotmail.com"; 


$email_message = "Hola solicitaste un cambiar tu contraseña.,Ingresa siguente link\\n\\n";
$email_message .= "https://droguerinventario.co="."&token=".$token."\\n\\n";
}
$headers = 'From: '.$email_from."\\r\\n".

'Reply-To: '.$email_from."\\r\\n" .

'X-Mailer: PHP/' . phpversion();

    // You can also use header('Location: thank_you.php'); to redirect to another page.;

@mail($email_to, $email_subject, $email_message, $headers);




echo "Te hemos enviado un email para el cambio de contraseña";
/*
  $respuesta = [];
if (mysqli_error($conexion) == "") {
    $respuesta['error'] = false;
    $respuesta['msg'] = echo $email;
} else {
    $respuesta['error'] = true;
    $respuesta['msg'] = echo $email;
}
echo json_encode($respuesta);*/

?>
