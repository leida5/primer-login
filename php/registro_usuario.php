<?php

    include 'conexion.php';

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST ['correo'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    /*Encriptamiento de la contraseña*/
    /*$contrasena =hash('sha512', $contrasena);*/

    $query = "INSERT INTO usuarios(nombre_completo,correo,usuario,contrasena)
                VALUES('$nombre_completo','$correo','$usuario','$contrasena')";
//* verificar que el correo no se repita en la base de datos*//

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");

    if (mysqli_num_rows($verificar_correo) >0) {
        echo '
            <script>
                alert ("Este correo ya esta Registrado en la Base de datos, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    //* verificar que el nombre de usuario no se repita en la base de datos*//

    $verificar_usuario = mysqli_query($conexion, "SELECT* FROM usuarios WHERE usuario = '$usuario'");

    if (mysqli_num_rows($verificar_usuario) >0) {
        echo '
            <script>
                alert ("Este usuario ya esta Registrado en la Base de datos, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();

}

    $ejecutar = mysqli_query($conexion, $query);
    if($ejecutar){
        echo '
            <script>
                alert ("Usuario registrado exitosamente");
                window.location = "../index.php";
            </script>
        ';
    }else{
        echo '
            <script>
                alert ("Intentalo de nuevo, usuario no almacenado en la Base de datos");
                window.location = "../index.php";
            </script>
        ';
        exit();


}

    mysqli_close($conexion);

?>
