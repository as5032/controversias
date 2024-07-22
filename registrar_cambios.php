<?php
session_start();
require_once('config.php');
if (empty($_SESSION["id"])) {
    header("location: index.php");
} 

require_once('conexion_db.php');
// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha presionado el botón de "Guardar"
    if (isset($_POST['registro'])) {
        // Obtiene los valores del formulario
        $id_captura = $_POST['id'];
        $Comentario = $_POST['Comentario'];
        $Documento = $_FILES['Documento'];

        if (!empty($_FILES['Documento']['name'])) {
            // Manejo de la carga del archivo
            $directorio_almacenamiento = 'documentos/'; // Debes configurar esta ruta
            $nombre_archivo = $_FILES['Documento']['name'];
            $archivo_temporal = $_FILES['Documento']['tmp_name'];
            $ruta_destino = $directorio_almacenamiento . $nombre_archivo;

            if (move_uploaded_file($archivo_temporal, $ruta_destino)) {

            } else {

            }
        }
        $id_cliente = $_SESSION["id"];
        $nombres = $_SESSION["nombre"];
        $usuario = $_SESSION["usuarioars"];
        $observa= $_POST["Comentario"];
        $texto="Se modificaron observaciones se agrego: ".$observa;

        // Llama al stored procedure para actualizar los datos
        $sql = "CALL InsertRegistroCambio(?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ississis", $id_captura, $Comentario, $ruta_destino,  $id_cliente,$nombres, $ip_cliente, $usuario,$texto);

        
        //$conn = new mysqli("localhost", "root", "4dm1n1str4d0r", "sistemacaccc");
        //mysqli_set_charset($conn, "utf8");
                $qry2 = "UPDATE logs 
        JOIN (SELECT MAX(logs_id) AS max_logs_id FROM logs) AS max_logs 
        SET logs.table_name= 'registro_cambios', logs.action='UPDATE', logs.updated_by = {$_SESSION["id"]}, updated='', logs.record.id={$id_captura};
        WHERE logs.logs_id = max_logs.max_logs_id";        
        $cs2 = mysqli_query($conn, $qry2);
         
        if ($stmt->execute()) {
            /* echo "Procedimiento actualizado correctamente"; */
            header("refresh:0.1;url=seguimiento_procedimiento.php?id=" . $id_captura);
        } else {
            echo "Error al cargar comentarios: " . $conn->error;
        } 

    }
}
?>