<?php
require_once('config.php');

if (empty($_SESSION["id"])) {
    header("location: index.php");
}

$pagina = 'inicial.php';
require_once('conexion_db.php');
date_default_timezone_set('America/Mexico_City');

// Obtener el ID del usuario desde la URL
$id_captura = $_GET['id'];

// Obtener los datos del usuario por su ID
/* $sql="select * from captura where idcaptura=$id_captura"; */
$sql = "CALL ObtenerProcedimientoPorID(?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_captura);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Fechacap = $row['fecha_cap'];
    $Fechaing = $row['fecha_ing'];
    $Fechaven = $row['fecha_ven'];
    $Numexp = $row['num_exp'];
    $Juicioproced = $row['juicio_proced'];
    $Actores = $row['actores'];
    $Accionante = $row['accionante'];
    $Estatus = $row['estatus'];
    $Abogado = $row['abogado'];
    $Ministro = $row['ministro'];
    $Asunto = $row['asunto'];
    $Seguimiento = $row['seguimiento'];
    $Prioridad = $row['prioridad'];
    $Acuse = $row['acuse'];
    $Observaciones = $row['observaciones'];

}
$stmt->close(); // Cerrar el resultado
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <!-- Bootstrap de CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function regresar() {
            // Redireccionar al formulario específico
            window.location.href = "consulta_procedimientos.php";
        }
    </script>

    <link rel="icon" href="images/icon/libro.ico" type="image/ico" />

    <!-- Title Page-->
    <title>CACCC</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <?php
    include('plantilla.php');
    ?>
    <!--INICIA DATOS A INGRESAR-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 h-100">
                        <div class="card h-100">
                            <div class="card-header">
                                <strong>Actualizar</strong> Expediente
                            </div>

                            <div class="card-body card-block h-100">
                                <form action="actualizar_procedimientos.php?id=<?php echo $id_captura; ?>" method="POST"
                                    class="h-100" id="formulario-actualizar" enctype="multipart/form-data">
                                    <input type="hidden" name="idcaptura" value="<?php echo $id_captura; ?>">
                                    <input type="hidden" name="estatus_modificado" id="estatus_modificado" value="0">
                                    <input type="hidden" name="abogado_modificado" id="abogado_modificado" value="0">
                                    <input type="hidden" name="ministro_modificado" id="ministro_modificado" value="0">
                                    <input type="hidden" name="seguimiento_modificado" id="seguimiento_modificado"
                                        value="0">
                                    <input type="hidden" name="acuse_modificado" id="acuse_modificado" value="0">
                                    <input type="hidden" name="observaciones_modificadas" id="observaciones_modificadas"
                                        value="0">
                                    <input type="hidden" name="fecha_ven_modificada" id="fecha_ven_modificada"
                                        value="0">

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="date-input" class="control-label mb-1">Fecha
                                                    de Captura<span class="required-field">*</span></label>
                                                <input type="date" name="fecha_cap" class="form-control"
                                                    style="font-size: 16px;" value="<?php echo $Fechacap; ?>" required
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="date-input" class="control-label mb-1">Fecha
                                                    de ingreso<span class="required-field">*</span></label>
                                                <input type="date" name="fecha_ing" class="form-control"
                                                    style="font-size: 16px;" value="<?php echo $Fechaing; ?>" required
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="date-input" class="control-label mb-1">Fecha
                                                    de vencimiento<span class="required-field">*</span></label>
                                                <input type="date" name="fecha_ven" id="fecha_ven" class="form-control"
                                                    style="font-size: 16px;" value="<?php echo $Fechaven; ?>"
                                                    onchange="onFechaVencimientoChange()"
                                                    data-original-value="<?php echo $Fechaven; ?>">
                                            </div>
                                        </div>

                                    </div>
                            </div>

                            <div class="card-body card-block h-100">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="textarea-input" class="control-label mb-1"># de
                                                Expediente<span class="required-field">*</span></label>
                                            <input type="text" name="num_exp" class="form-control"
                                                style="font-size: 16px;" value="<?php echo $Numexp; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="select" class="control-label mb-1">Juicio/Procedimiento<span
                                                    class="required-field">*</span></label>
                                            <?php
                                            require_once 'conexion_db.php';
                                            // Consulta SQL para obtener el nombre del asunto
                                            $sql = "SELECT t_juicio FROM cat_juicio WHERE id = $Juicioproced";
                                            $resultado = $conn->query($sql);

                                            if ($resultado->num_rows > 0) {
                                                $fila = $resultado->fetch_assoc();
                                                $nombreJuicio = $fila['t_juicio'];
                                            } else {
                                                $nombreJuicio = "Juicio no encontrado";
                                            }
                                            ?>
                                            <input type="text" name="juicio" size="1" class="form-control"
                                                style="font-size: 16px; width: 349px;"
                                                value="<?php echo $nombreJuicio; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="select" class="control-label mb-1">Actor/Demandado<span
                                                    class="required-field">*</span></label>
                                            <?php
                                            require_once 'conexion_db.php';
                                            // Consulta SQL para obtener el nombre del asunto
                                            $sql = "SELECT actord FROM cat_actor WHERE id = $Actores";
                                            $resultado = $conn->query($sql);

                                            if ($resultado->num_rows > 0) {
                                                $fila = $resultado->fetch_assoc();
                                                $nombreActor = $fila['actord'];
                                            } else {
                                                $nombreActor = "Actor no encontrado";
                                            }
                                            ?>
                                            <input type="text" name="juicio" size="1" class="form-control"
                                                style="font-size: 16px; width: 349px;"
                                                value="<?php echo $nombreActor; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body card-block h-100">
                                <div class="row">

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="textarea-input" class="control-label mb-1">Accionante<span
                                                    class="required-field">*</span></label>
                                            <input type="text" name="accionante" class="form-control"
                                                style="font-size: 16px;" value="<?php echo $Accionante; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="select" class="control-label mb-1">Estatus<span
                                                    class="required-field">*</span></label>
                                            <select name="estatus" id="estatus" size="1" class="form-control"
                                                style="font-size: 16px; width: 349px;" onchange="onEstatusChange()"
                                                required data-original-value="<?php echo $Estatus; ?>">
                                                <option value="" disabled>Seleccione un estatus</option>
                                                <?php
                                                // Incluye tu archivo de conexión a la base de datos
                                                require_once 'conexion_db.php';

                                                // Consulta SQL para obtener datos de la tabla cat_prioridad
                                                $sql = "SELECT * FROM cat_estatus";

                                                $resultado = $conn->query($sql);

                                                if ($resultado->num_rows > 0) {
                                                    // Si hay resultados, itera a través de ellos
                                                    while ($fila = $resultado->fetch_assoc()) {
                                                        // Accede a los campos de la fila
                                                        $id = $fila['id'];
                                                        $nombre = $fila['estatus'];

                                                        // Comprueba si esta opción debe estar seleccionada
                                                        $seleccionado = ($id == $Estatus) ? 'selected' : '';

                                                        // Hacer algo con los datos, por ejemplo, imprimirlos
                                                        echo '<option value="' . $fila['id'] . '" ' . $seleccionado . '>' . $fila['estatus'] . '</option>';
                                                    }
                                                } else {
                                                    echo "No se encontraron registros en la tabla cat_prioridad.";
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="select" class="control-label mb-1">Abogado
                                                Asignado<span class="required-field">*</span></label>
                                            <select name="abogado" id="abogado" size="1" class="form-control"
                                                style="font-size: 16px; width: 349px;" onchange="onAbogadoChange()"
                                                required data-original-value="<?php echo $Abogado; ?>">
                                                <option value="" disabled>Seleccione a un
                                                    abogado
                                                </option>
                                                <?php
                                                // Incluye tu archivo de conexión a la base de datos
                                                require_once 'conexion_db.php';

                                                // Consulta SQL para obtener datos de la tabla cat_prioridad
                                                $sql = "SELECT * FROM cat_abogado";

                                                $resultado = $conn->query($sql);

                                                if ($resultado->num_rows > 0) {
                                                    // Si hay resultados, itera a través de ellos
                                                    while ($fila = $resultado->fetch_assoc()) {
                                                        // Accede a los campos de la fila
                                                        $id = $fila['id'];
                                                        $nombre = $fila['n_abogado'];

                                                        // Comprueba si esta opción debe estar seleccionada
                                                        $seleccionado = ($id == $Abogado) ? 'selected' : '';

                                                        // Hacer algo con los datos, por ejemplo, imprimirlos
                                                        echo '<option value="' . $fila['id'] . '" ' . $seleccionado . '>' . $fila['n_abogado'] . '</option>';
                                                    }
                                                } else {
                                                    echo "No se encontraron registros en la tabla cat_prioridad.";
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body card-block h-100">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="select" class="control-label mb-1">Ministro instructor<span
                                                    class="required-field">*</span></label>
                                            <select name="ministro" id="ministro" size="1" class="form-control"
                                                style="font-size: 16px; width: 349px;" onchange="onMinistroChange()"
                                                required data-original-value="<?php echo $Ministro; ?>">
                                                <option value="" disabled>...</option>
                                                <?php
                                                // Incluye tu archivo de conexión a la base de datos
                                                require_once 'conexion_db.php';

                                                // Consulta SQL para obtener datos de la tabla cat_prioridad
                                                $sql = "SELECT * FROM cat_ministro";

                                                $resultado = $conn->query($sql);

                                                if ($resultado->num_rows > 0) {
                                                    // Si hay resultados, itera a través de ellos
                                                    while ($fila = $resultado->fetch_assoc()) {
                                                        // Accede a los campos de la fila
                                                        $id = $fila['id'];
                                                        $nombre = $fila['ministros'];

                                                        // Comprueba si esta opción debe estar seleccionada
                                                        $seleccionado = ($id == $Ministro) ? 'selected' : '';

                                                        // Hacer algo con los datos, por ejemplo, imprimirlos
                                                        echo '<option value="' . $fila['id'] . '" ' . $seleccionado . '>' . $fila['ministros'] . '</option>';
                                                    }
                                                } else {
                                                    echo "No se encontraron registros en la tabla cat_prioridad.";
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="textarea-input" class="control-label mb-1">Asunto<span
                                                    class="required-field">*</span></label>
                                            <textarea name="materia" rows="2" placeholder="..." class="form-control"
                                                style="resize: none; font-size: 16px;"
                                                oninput="this.value = this.value.toUpperCase()" required
                                                readonly><?php echo $Asunto; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="select" class="control-label mb-1">Seguimiento<span
                                                    class="required-field">*</span></label>
                                            <select name="seguimiento" id="seguimiento" size="1" class="form-control"
                                                style="font-size: 16px; width: 349px;" onchange="onSeguimientoChange()"
                                                required data-original-value="<?php echo $Seguimiento; ?>">
                                                <option value="" disabled>...</option>
                                                <?php
                                                // Incluye tu archivo de conexión a la base de datos
                                                require_once 'conexion_db.php';

                                                // Consulta SQL para obtener datos de la tabla cat_prioridad
                                                $sql = "SELECT * FROM cat_seguimiento";

                                                $resultado = $conn->query($sql);

                                                if ($resultado->num_rows > 0) {
                                                    // Si hay resultados, itera a través de ellos
                                                    while ($fila = $resultado->fetch_assoc()) {
                                                        // Accede a los campos de la fila
                                                        $id = $fila['id'];
                                                        $nombre = $fila['seguimiento'];

                                                        // Comprueba si esta opción debe estar seleccionada
                                                        $seleccionado = ($id == $Seguimiento) ? 'selected' : '';

                                                        // Hacer algo con los datos, por ejemplo, imprimirlos
                                                        echo '<option value="' . $fila['id'] . '" ' . $seleccionado . '>' . $fila['seguimiento'] . '</option>';


                                                    }
                                                } else {
                                                    echo "No se encontraron registros en la tabla cat_seguimiento.";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body card-block h-100">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="select" class="control-label mb-1">Prioridad<span
                                                    class="required-field">*</span></label>
                                            <?php
                                            require_once 'conexion_db.php';
                                            // Consulta SQL para obtener el nombre del asunto
                                            $sql = "SELECT nivel FROM cat_prioridad WHERE id = $Prioridad";
                                            $resultado = $conn->query($sql);

                                            if ($resultado->num_rows > 0) {
                                                $fila = $resultado->fetch_assoc();
                                                $nombrePrioridad = $fila['nivel'];
                                            } else {
                                                $nombrePrioridad = "Prioridad no encontrado";
                                            }
                                            ?>
                                            <input type="text" name="prioridad" size="1" class="form-control"
                                                style="font-size: 16px; width: 349px;"
                                                value="<?php echo $nombrePrioridad; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="file-input" class="control-label mb-1">Documento</label>
                                            <input type="file" name="acuse" id="acuse" class="form-control-file"
                                                style="font-size: 16px;" onchange="onAcuseChange()"
                                                accept=".pdf, .jpg, .jpeg, .png">
                                            <?php if (!empty($Acuse)): ?>
                                                <!-- Mostrar el nombre del archivo actual -->
                                                <p>Archivo actual:
                                                    <?php echo $Acuse; ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-body card-block h-100">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label for="textarea-input" class="control-label mb-1">Observaciones</label>
                                            <textarea name="observaciones" id="observaciones" rows="8"
                                                class="form-control" style="resize: none; font-size: 16px;"
                                                oninput="this.value = this.value.toUpperCase()"
                                                onchange="onObservacionesChange()"
                                                data-original-value="<?php echo $Observaciones; ?>"><?php echo rtrim($Observaciones); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="text" style="font-size: 14px;">Los campos con * son campos
                                    obligatorios</label>
                            </div>

                            <div class="card-footer">
                                <?php if (!empty($mensaje)): ?>
                                    <div class="alert alert-success" role="alert" style="display: none;">
                                        <?php echo $mensaje; ?>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-warning btn-lg" name="actualizar"
                                    id="btn-actualizar">
                                    <i class="fas fa-sync-alt" style="color: white;"></i>
                                    <span style="color: white;">Actualizar</span>
                                </button>
                                <button type="reset" class="btn btn-danger btn-lg" onclick="regresar()">
                                    <i class="fas fa-arrow-left"></i> Regresar
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--TERMINA DATOS A INGRESAR-->
    <br /><br /><br />
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            // Mostrar mensaje de éxito
            <?php if (!empty($mensaje)): ?>
                $(".alert-success").fadeIn().delay(3000).fadeOut();
            <?php endif; ?>
        });

        function onFechaVencimientoChange() {
            // Obtén el campo "Abogado" y el campo oculto "abogado_modificado"
            var fechaField = document.getElementById("fecha_ven");
            var fechaModificadoField = document.getElementById("fecha_ven_modificada");

            // Obtiene el valor original del campo "Abogado" desde un atributo data en el campo
            var valorOriginalFecha = fechaField.getAttribute("data-original-value");
            /* alert(fechaField + " - " + fechaModificadoField); */
            // Compara el valor actual con el valor original (puedes obtenerlo de alguna variable en PHP)
            if (fechaField.value !== valorOriginalFecha) {
                fechaModificadoField.value = "1"; // Marca como modificado
            } else {
                fechaModificadoField.value = "0"; // No modificado
            }
        }

        function onEstatusChange() {
            // Obtén el campo "Abogado" y el campo oculto "abogado_modificado"
            var estatusField = document.getElementById("estatus");
            var estatusModificadoField = document.getElementById("estatus_modificado");

            // Obtiene el valor original del campo "Abogado" desde un atributo data en el campo
            var valorOriginalEstatus = estatusField.getAttribute("data-original-value");

            // Compara el valor actual con el valor original (puedes obtenerlo de alguna variable en PHP)
            if (estatusField.value !== valorOriginalEstatus) {
                estatusModificadoField.value = "1"; // Marca como modificado
            } else {
                estatusModificadoField.value = "0"; // No modificado
            }
        }

        function onAbogadoChange() {
            // Obtén el campo "Abogado" y el campo oculto "abogado_modificado"
            var abogadoField = document.getElementById("abogado");
            var abogadoModificadoField = document.getElementById("abogado_modificado");

            // Obtiene el valor original del campo "Abogado" desde un atributo data en el campo
            var valorOriginalAbogado = abogadoField.getAttribute("data-original-value");

            // Compara el valor actual con el valor original (puedes obtenerlo de alguna variable en PHP)
            if (abogadoField.value !== valorOriginalAbogado) {
                abogadoModificadoField.value = "1"; // Marca como modificado
            } else {
                abogadoModificadoField.value = "0"; // No modificado
            }
        }

        function onMinistroChange() {
            // Obtén el campo "Abogado" y el campo oculto "abogado_modificado"
            var ministroField = document.getElementById("ministro");
            var ministroModificadoField = document.getElementById("ministro_modificado");

            // Obtiene el valor original del campo "Abogado" desde un atributo data en el campo
            var valorOriginalMinistro = ministroField.getAttribute("data-original-value");

            // Compara el valor actual con el valor original (puedes obtenerlo de alguna variable en PHP)
            if (ministroField.value !== valorOriginalMinistro) {
                ministroModificadoField.value = "1"; // Marca como modificado
            } else {
                ministroModificadoField.value = "0"; // No modificado
            }
        }

        function onSeguimientoChange() {
            // Obtén el campo "Abogado" y el campo oculto "abogado_modificado"
            var seguimientoField = document.getElementById("seguimiento");
            var seguimientoModificadoField = document.getElementById("seguimiento_modificado");

            // Obtiene el valor original del campo "Abogado" desde un atributo data en el campo
            var valorOriginalSeguimiento = seguimientoField.getAttribute("data-original-value");

            // Compara el valor actual con el valor original (puedes obtenerlo de alguna variable en PHP)
            if (seguimientoField.value !== valorOriginalSeguimiento) {
                seguimientoModificadoField.value = "1"; // Marca como modificado
            } else {
                seguimientoModificadoField.value = "0"; // No modificado
            }
        }

        function onAcuseChange() {
            // Obtén el campo "Abogado" y el campo oculto "abogado_modificado"
            var acuseField = document.getElementById("acuse");
            var acuseModificadoField = document.getElementById("acuse_modificado");

            // Comprueba si se ha seleccionado un archivo
            if (acuseField.files.length > 0) {
                acuseModificadoField.value = "1"; // Marca como modificado si se seleccionó un archivo
            } else {
                acuseModificadoField.value = "0"; // No modificado si no se seleccionó un archivo
            }
        }

        function onObservacionesChange() {

            // Obtén el campo "Abogado" y el campo oculto "abogado_modificado"
            var observacionesField = document.getElementById("observaciones");
            var observacionesModificadoField = document.getElementById("observaciones_modificadas");

            // Define valorOriginalObservaciones antes de usarlo
            var valorOriginalObservaciones = observacionesField.getAttribute("data-original-value");
            /* alert(observacionesField + " - " + observacionesModificadoField); */
            // Compara el valor actual con el valor original (puedes obtenerlo de alguna variable en PHP)
            if (observacionesField.value != valorOriginalObservaciones) {
                observacionesModificadoField.value = "1"; // Marca como modificado
            } else {
                observacionesModificadoField.value = "0"; // No modificado
            }



        }
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>