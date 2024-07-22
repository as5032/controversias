<?php
// Archivo verificar_numexp.php

// Verificar si se recibieron datos de la solicitud AJAX
if (isset($_POST['numExp']) && isset($_POST['juicio'])) 
{
    // Obtener los datos enviados por la solicitud AJAX
    $numExp = $_POST['numExp'];
    $juicio = $_POST['juicio'];

    // Realizar la conexión a la base de datos (debes incluir tu propio archivo de conexión)
    require_once 'conexion_db.php';

    // Consulta SQL para verificar si el número de expediente existe para el tipo de juicio seleccionado
    $sql = "SELECT * FROM captura WHERE num_exp = ? AND juicio_proced = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $numExp, $juicio);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // El número de expediente ya existe para este tipo de juicio
        echo 'existe';
    } else {
        // El número de expediente no existe o no está duplicado
        echo 'no_existe';
    }

    // Cerrar la conexión y liberar los recursos
    $stmt->close();
    $conn->close();
} else {
    // Si no se recibieron datos de la solicitud AJAX, regresar un mensaje de error
    echo 'error';
}
?>
