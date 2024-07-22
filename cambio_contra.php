<?php
require_once('config.php');

if (empty($_SESSION["id"])) {
    header("location: index.php");
}

$pagina = 'inicial.php';

require_once('conexion_db.php');
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtención de los datos introducidos por el usuario
    if (isset($_POST['Insert'])) {
        $contrasena_actual = $_POST['ContrasenaActual']; // Nombre del campo para la contraseña actual
        $nueva_contrasena = $_POST['NuevaContrasena']; // Nombre del campo para la nueva contraseña

        // Aquí puedes realizar las verificaciones necesarias, como verificar la contraseña actual antes de actualizarla

        // Ejemplo de verificación de contraseña actual
        // Suponiendo que tienes la contraseña actual almacenada en $contrasena_guardada
        // Reemplaza esto por la lógica adecuada para obtener la contraseña actual del usuario
        // Puedes utilizar consultas a la base de datos o métodos de autenticación seguros
        $sql = "SELECT contra FROM logins WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_SESSION["id"]);
        $stmt->execute();
        $stmt->store_result();


        // Verificar si se encontró un resultado
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($contrasena_guardada);
            $stmt->fetch();

            // Verificar si la contraseña actual coincide
            if ($contrasena_actual !== $contrasena_guardada) {
                $mensaje = "La contraseña actual es incorrecta";
            } else {
                // Actualizar la contraseña en la base de datos
                $sql_update = "UPDATE logins SET contra = ? WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param('si', $nueva_contrasena, $_SESSION["id"]);
                if ($stmt_update->execute() === false) {
                    die("Error al ejecutar la consulta: " . $stmt_update->error);
                } else {
                    $mensaje = "CONTRASEÑA ACTUALIZADA CORRECTAMENTE";
                }
                $stmt_update->close();
            }
        } else {
            $mensaje = "No se encontró la contraseña actual del usuario";
        }

        $stmt->close();
    }
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
    $mensaje = "CONTRASEÑA ACTUALIZADA CORRECTAMENTE";
    // También puedes ejecutar borrarDatos() aquí
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
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
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


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

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
        }

        .page-wrapper {
            background-color: white;
            height: 100vh;
        }

        .page-content--bge5 {
            background: #9F2241;
            height: 60vh;
        }
    </style>
</head>

<body>
    <?php
    include('plantilla.php');
    ?>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div id="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="au-card chart-percent-card">
                            <div class="au-card-inner">
                                <div class="card-header" style="font-size: 20px;">
                                    <strong>Cambiar</strong> Contraseña
                                </div>

                                <div class="card-body card-block h-100">
                                    <form action="" method="POST" class="h-100" id="miFormulario" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="textarea-input" class="control-label mb-1">Contraseña actual<span class="required-field">*</span></label>
                                                    <textarea name="ContrasenaActual" id="textarea-input" rows="1" placeholder="..." class="form-control" style="resize: none; font-size: 16px;" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="textarea-input" class="control-label mb-1">Nueva contraseña<span class="required-field">*</span></label>
                                                    <textarea name="NuevaContrasena" id="textarea-input" rows="1" placeholder="..." class="form-control" style="resize: none; font-size: 16px;" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <?php if (!empty($mensaje)) : ?>
                                                <div class="alert alert-success" role="alert" style="display: none;">
                                                    <?php echo $mensaje; ?>
                                                </div>
                                            <?php endif; ?>
                                            <button type="submit" class="btn btn-success btn-lg" name="Insert">
                                                <i class="fa fa-dot-circle-o"></i>
                                                Cambiar
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
    </div>


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
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script>
        $(document).ready(function() {
            // Mostrar mensaje de éxito
            <?php if (!empty($mensaje)) : ?>
                $(".alert-success").fadeIn().delay(3000).fadeOut();
            <?php endif; ?>
        });

        function borrarDatos() {
            var textboxes = document.querySelectorAll("input[type='file'], input[type='date'], input[type='text']");
            textboxes.forEach(function(textbox) {
                textbox.value = "";
            });
        }
    </script>
</body>

</html>