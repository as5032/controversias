<?php
session_start();
$mensaje = "";
if (!empty($_POST["btnIngresar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["pass"])) {
        $usuario = $_POST["usuario"];
        $pass = $_POST["pass"];
        $pass_hash = md5($pass); // Genera el hash MD5 de la contraseña ingresada

        $sql = "SELECT * FROM logins WHERE usuario=? AND contra=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            die("Error en la consulta: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "ss", $usuario, $pass_hash);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($datos = $result->fetch_object()) {
            $status = $datos->status;
            if ($status != 2) { // status 2 usuario dado de baja
                $_SESSION["id"] = $datos->id;
                $_SESSION["nombre"] = $datos->nombre_completo;
                $_SESSION["tipo_usuario"] = $datos->tipo_usuario;
                $_SESSION["iniciales"] = $datos->usuario;
                $qry1 = "INSERT INTO logs2 (l_nombre, l_tiempo, l_ip, l_usuario) 
                VALUES ('{$_SESSION["nombre"]}', CURRENT_TIMESTAMP, '{$_SERVER["REMOTE_ADDR"]}', '{$_SESSION["id"]}')";
                $cs1 = mysqli_query($conn, $qry1);
                header("location: inicial.php");
            } else {
                $mensaje = '<span style="color: red">Usuario no válido</span>';
            }
        } else {
            $mensaje = '<span style="color: red">Credenciales inválidas</span>';
        }
        mysqli_stmt_close($stmt);
        mysqli_free_result($result);
    } else {
        $mensaje = '<span style="color: red">Llene los campos correctamente</span>';
    }
}
