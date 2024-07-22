<?php

    require_once('xcrud/xcrud.php');
    $xcrud = Xcrud::get_instance(); 
    Xcrud_config::$search_on_typing = true;
    $xcrud->table("captura_historico"); //TABLA
    //AQUI VAN LOS CAMPOS A MOSTRAR
    $xcrud->columns('idcaptura,num_exp,num_int,juicio_proced,actores,accionante,estatus,abogado,ministro,asunto,seguimiento,prioridad,acuse,observaciones,year');
    $xcrud->fields_inline('num_exp,num_int,juicio_proced,actores,accionante,estatus,abogado,ministro,asunto,seguimiento,prioridad,acuse,observaciones,year');
    $xcrud->inline_edit_click('double_click');
    $xcrud->where('estatus>', 0);  // DE ESTA FORMA SE CONDICIONA LA PRESENTACION DE LOS DATOS
    // AQUI VAN LOS CATALOGOS DE LA TABLA PARA SU REPRESENTACION //
    $xcrud->relation('juicio_proced','cat_juicio','id','t_juicio');
    $xcrud->relation('actores','cat_actor','id','actord');
    $xcrud->relation('estatus','cat_estatus','id','estatus');
    $xcrud->relation('abogado','cat_abogado','id','n_abogado');
    $xcrud->relation('ministro','cat_ministro','id','ministros');
    $xcrud->relation('seguimiento','cat_seguimiento','id','seguimiento');
    $xcrud->relation('prioridad','cat_prioridad','id','nivel');
    // AQUI VAN LOS CATALOGOS DE LA TABLA PARA SU REPRESENTACION //
    // AQUI VAN LOS REGISTROS A CAMBIAR
    //$xcrud->fields('idcaptura,num_exp,num_int,juicio_proced,actores,accionante,estatus,abogado,ministro,asunto,seguimiento,prioridad,acuse,observaciones,year');
    // AQUI VAN LOS REGISTROS A CAMBIAR
    //POSICION DE LOS BOTONES
    $xcrud->buttons_position('left'); 
    //POSICION DE LOS BOTONES
    /* NOMBRE DE LOS CAMPOS */
    $xcrud->label('idcaptura','Id');
    //$xcrud->label('fecha_cap','# Fecha de captura');
    //$xcrud->label('fecha_ing','Fecha de ingreso');
    //$xcrud->label('dep_dep','Fecha de vencimiento');
    $xcrud->label('year','Año');
    $xcrud->label('num_exp','Número Expediente');
    $xcrud->label('num_int','Número interno');
    $xcrud->label('asunto','Asunto');
    $xcrud->label('observaciones','Observaciones');
    $xcrud->label('juicio_proced','Juicio / procedimiento');
    $xcrud->label('actores','Actor / demandado');
    $xcrud->label('accionante','Accionante');
    $xcrud->label('estatus','Estatus');
    $xcrud->label('abogado','Abogado');
    $xcrud->label('ministro','Ministro instructor');
    $xcrud->label('seguimiento','Seguimiento');
    $xcrud->label('prioridad','Prioridad');
    // AQUI SE MARCAN LOS REGISTROS SIN DATO // 
    $xcrud->highlight('acuse', '<', " ", 'F97171');
    $xcrud->highlight('acuse', '>', " ", '#8DED79');
    $xcrud->highlight('prioridad', '<', " ", 'F97171');
    $xcrud->highlight('prioridad', '>', " ", '#8DED79');
    $xcrud->highlight('asunto', '<', " ", 'F97171');
    $xcrud->highlight('asunto', '>', " ", '#8DED79');
    $xcrud->highlight('num_int', '<', " ", 'F97171');
    $xcrud->highlight('num_int', '>', " ", '#8DED79');
    $xcrud->highlight('observaciones', '<', " ", 'F97171');
    $xcrud->highlight('observaciones', '>', " ", '#8DED79');
    $xcrud->highlight('ministro', '<', 1, 'F97171');
    $xcrud->highlight('ministro', '>', 1, '#8DED79');
    $xcrud->highlight('accionante', '<', 1, 'F97171');
    $xcrud->highlight('accionante', '>', 1, '#8DED79');
    // AQUI SE MARCAN LOS REGISTROS SIN DATO // 
    /*SECCION PARA QUITAR BOTONES  */
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_remove();
    $xcrud->unset_view();
    //$xcrud->unset_csv();
    //$xcrud->unset_limitlist();
    $xcrud->unset_numbers();
    //$xcrud->unset_pagination();
    $xcrud->unset_print();
    //$xcrud->unset_search();
    $xcrud->unset_title();
    //$xcrud->unset_sortable();
    /*SECCION PARA QUITAR BOTONES  */

    require_once('config.php');
    if (empty($_SESSION["id"])) {
        header("location: index.php");
    }
    $pagina = 'inicial.php';
    require_once('conexion_db.php');
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
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.6.0/dist/multiple-select.min.css">
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        

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

        <!-- <script src="js/jquery-3.7.0.min.js"></script> -->
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://unpkg.com/multiple-select@1.6.0/dist/multiple-select.min.js"></script>

        <style>
            .tabla-responsiva {
                overflow-x: auto;
                /* Agrega una barra de desplazamiento horizontal si es necesario */
                max-width: 100%;
                /* Evita que la tabla se extienda más allá del ancho del contenedor */
            }

            #example {
                font-size: 14px;
                /* Cambia el valor según tu preferencia */
            }

            .editar-button {
                background-color: #FF8215 !important;
            }

            /* Estilos para el botón de eliminación (fondo rojo) */
            .consulta-button {
                background-color: #3F87EB !important;
            }

            .editar-button i,
            .consulta-button i {
                color: white !important;
                /* Color blanco para los íconos */
            }
        </style>
    </head>

    <body class="animsition">
        <?php
        include('plantilla.php');
            
        require_once('config.php');
        ?>

        <!--INICIA DATOS A INGRESAR-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 h-100">
                            <div class="card h-100">
                                <div class="card-header" style="font-size: 20px";>                            
                                    <strong>Consulta</strong> Expedientes
                                </div>
                                <div class="card-body">
                                    <?php /* ESTO SIEMPRE AL FINAL*/
                                    echo $xcrud->render(); ?>

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
        <!-- <script src="vendor/jquery-3.2.1.min.js"></script>  ///  QUITA ESTE PARA XCRUD -->
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
        <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script> -->
    </body>
    </html>