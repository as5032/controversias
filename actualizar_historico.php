<?php
require_once('config.php');
/*if (empty($_SESSION["id"])) {
    header("location: index.php");
} */
require_once('conexion_db.php');
$mensaje = "";
// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha presionado el botón de "Actualizar"
    if (isset($_POST['actualizar'])) {
        // Obtiene los valores del formulario
        $id_captura = $_POST['idcaptura'];
        $Fechaven = $_POST['fecha_ven'];
        $Estatus = $_POST['estatus'];
        $Abogado = $_POST['abogado'];
        $Ministro = $_POST['ministro'];
        $Seguimiento = $_POST['seguimiento'];
        $Acuse = $_FILES['acuse'];
        $Observaciones = $_POST['observaciones'];

        // Recupera los indicadores de campos modificados (0 o 1)
        $fecha_ven_modificada = isset($_POST['fecha_ven_modificada']) ? intval($_POST['fecha_ven_modificada']) : 0;
        $estatus_modificado = isset($_POST['estatus_modificado']) ? intval($_POST['estatus_modificado']) : 0;
        $abogado_modificado = isset($_POST['abogado_modificado']) ? intval($_POST['abogado_modificado']) : 0;
        $ministro_modificado = isset($_POST['ministro_modificado']) ? intval($_POST['ministro_modificado']) : 0;
        $seguimiento_modificado = isset($_POST['seguimiento_modificado']) ? intval($_POST['seguimiento_modificado']) : 0;
        $acuse_modificado = isset($_POST['acuse_modificado']) ? intval($_POST['acuse_modificado']) : 0;
        $observaciones_modificadas = isset($_POST['observaciones_modificadas']) ? intval($_POST['observaciones_modificadas']) : 0;

        if (!empty($_FILES['acuse']['name'])) 
        {
            // Manejo de la carga del archivo
            $directorio_almacenamiento = 'documentos/'; // Debes configurar esta ruta
            $nombre_archivo = $_FILES['acuse']['name'];
            $archivo_temporal = $_FILES['acuse']['tmp_name'];
            $ruta_destino = $directorio_almacenamiento . $nombre_archivo;

            if (move_uploaded_file($archivo_temporal, $ruta_destino)) {

            } else {

            }
        }

        // Llama al stored procedure para actualizar los datos
        $sql = "CALL registro_actualizacion(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isiiiissiiiiiiii", $id_captura, $Fechaven, $Estatus, $Abogado, $Ministro, $Seguimiento, $ruta_destino, $Observaciones, $_SESSION["id"], $fecha_ven_modificada, $estatus_modificado, $abogado_modificado, $ministro_modificado, $seguimiento_modificado, $acuse_modificado, $observaciones_modificadas);

        // Ejecuta el SP
        if ($stmt->execute()) {
            /* echo "Procedimiento actualizado correctamente"; */
            header("Location: editar_procedimientos.php?id=" . $id_captura);
            /* echo $Fechaven;
            echo $fecha_ven_modificada;
            echo $Estatus;
            echo $estatus_modificado; */
        } else {
            echo "Error al actualizar el procedimiento: " . $conn->error;
        }

    }
}
if (isset($_GET['id'])) {
    $mensaje = "JUICIO/PROCEDIMIENTO ACTUALIZADO CORRECTAMENTE";
    // También puedes ejecutar borrarDatos() aquí
}

?>