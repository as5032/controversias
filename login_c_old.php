<?php
session_start();
$mensaje = "";

if (!empty($_POST["btnIngresar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["pass"])) {
        $usuario = $_POST["usuario"];
        $pass = $_POST["pass"];
        // Consulta preparada
        $sql = "SELECT * FROM logins WHERE usuario=? AND contra=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die("Error en la consulta: " . mysqli_error($conn));
        }
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "ss", $usuario, $pass);

        // Ejecutar consulta
        mysqli_stmt_execute($stmt);

        // Obtener resultados
        $result = mysqli_stmt_get_result($stmt);

        if ($datos = $result->fetch_object()) {
            $_SESSION["id"] = $datos->id;
            $_SESSION["nombre"] = $datos->nombre_completo;
            $_SESSION["tipo_usuario"] = $datos->tipo_usuario;
            header("location: inicial.php");

        } else {

            $mensaje = '<span style="color: red">Credenciales inválidas</span>';
        }

        // Cerrar declaración y resultados
        mysqli_stmt_close($stmt);
        mysqli_free_result($result);
    } else {

        $mensaje = '<span style="color: red">Llene los campos correctamente</span>';
    }
}
?>