<?php
require_once('xcrud/xcrud.php');
//php error_reporting(0);
error_reporting(0);
$xcrud = Xcrud::get_instance();
$xcrud->table("captura");
$xcrud->buttons_position('left');
$xcrud->columns('id_usuario', true);
$xcrud->relation('juicio_proced', 'cat_juicio', 'id', 't_juicio');
$xcrud->relation('actores', 'cat_actor', 'id', 'actord');
$xcrud->relation('estatus', 'cat_estatus', 'id', 'estatus'); //cuando hay un catalogo para mostrar el contenido no el id
$xcrud->relation('abogado', 'cat_abogado', 'id', 'n_abogado');
$xcrud->relation('ministro', 'cat_ministro', 'id', 'ministros');
$xcrud->relation('seguimiento', 'cat_seguimiento', 'id', 'seguimiento');
$xcrud->relation('prioridad', 'cat_prioridad', 'id', 'nivel');
$xcrud->label('idcaptura', 'Id');
$xcrud->label('juicio_proced', 'Juicio Procedimiento');
$xcrud->label('actores', 'Actor');
$xcrud->label('fecha_cap', 'Fecha de Captura');
$xcrud->label('fecha_ing', 'Fecha de Ingreso');
$xcrud->label('fecha_ven', 'Fecha de Vencimiento');
$xcrud->label('fecha_ses', 'Fecha de Sesión');
$xcrud->label('num_exp', 'Número Expediente');
$xcrud->label('num_int', 'Número Interno');
$xcrud->label('ministro', 'Ministro Instructor');
$xcrud->where('captura.estatus<>',16);
//$xcrud->change_type('acuse', 'file', '', array('not_rename' => true));
$ini = $_POST['FechaIn'];
$fin = $_POST['FechaVen'];
$t_juicio = $_POST['t_juicio'];
$actord = $_POST['actord'];
//$xcrud->unset_print();


if ($t_juicio) {
    if ($actord) {
        if ($ini && $fin) {
            //echo "juicio actor y fechas";
            $qry2 = "SELECT idcaptura AS Id, fecha_ing AS Fecha_Ingreso, fecha_ses AS Fecha_Sesión, num_exp As Número_Expediente, num_int AS Número_Interno, accionante, observaciones, cat_estatus.estatus, cat_abogado.n_abogado AS Abogado, cat_ministro.ministros AS Ministro_Instructor, cat_prioridad.nivel AS Prioridad, cat_seguimiento.seguimiento AS Seguimiento, cat_juicio.t_juicio AS Juicio_Procedimiento, cat_actor.actord AS Actor_Demandado
                FROM captura 
                INNER JOIN cat_estatus 
                ON captura.estatus=cat_estatus.id 
                INNER JOIN cat_abogado ON captura.abogado=cat_abogado.id 
                INNER JOIN cat_ministro ON captura.ministro=cat_ministro.id 
                INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id 
                INNER JOIN cat_seguimiento ON captura.seguimiento=cat_seguimiento.id 
                INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id 
                INNER JOIN cat_actor ON captura.actores=cat_actor.id
                WHERE captura.estatus<>16 AND captura.juicio_proced='$t_juicio' AND captura.actores='$actord' AND captura.fecha_ing BETWEEN '$ini' AND '$fin'";
        } else {
            //echo "juicio y actor";
            $qry2 = "SELECT idcaptura AS Id, fecha_ing AS Fecha_Ingreso, fecha_ses AS Fecha_Sesión, num_exp AS Número_Expediente, num_int AS Número_Interno, accionante, observaciones, cat_estatus.estatus AS Estatus, cat_abogado.n_abogado AS Abogado, cat_ministro.ministros AS Ministro_Instructor, cat_prioridad.nivel AS Prioridad, cat_seguimiento.seguimiento AS Seguimiento, cat_juicio.t_juicio AS Juicio_Procedimiento, cat_actor.actord AS Actor_Demandado 
                FROM captura 
                INNER JOIN cat_estatus 
                ON captura.estatus=cat_estatus.id 
                INNER JOIN cat_abogado ON captura.abogado=cat_abogado.id 
                INNER JOIN cat_ministro ON captura.ministro=cat_ministro.id 
                INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id 
                INNER JOIN cat_seguimiento ON captura.seguimiento=cat_seguimiento.id 
                INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id 
                INNER JOIN cat_actor ON captura.actores=cat_actor.id
                WHERE captura.estatus<>16 AND captura.juicio_proced='$t_juicio' AND captura.actores='$actord'";
        }
    } else {
        if ($ini && $fin) {
            //echo "juicio y fechas";
            $qry2 = "SELECT idcaptura AS Id, fecha_ing AS Fecha_Ingreso, fecha_ses AS Fecha_Sesión, num_exp AS Número_Expediente, num_int AS Número_Interno, accionante, observaciones, cat_estatus.estatus AS Estatus, cat_abogado.n_abogado AS Abogado, cat_ministro.ministros AS Ministro_Instructor, cat_prioridad.nivel AS Prioridad, cat_seguimiento.seguimiento AS Seguimiento, cat_juicio.t_juicio AS Juicio_Procedimiento, cat_actor.actord AS Actor_Demandado 
                FROM captura 
                INNER JOIN cat_estatus ON captura.estatus=cat_estatus.id 
                INNER JOIN cat_abogado ON captura.abogado=cat_abogado.id 
                INNER JOIN cat_ministro ON captura.ministro=cat_ministro.id 
                INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id 
                INNER JOIN cat_seguimiento ON captura.seguimiento=cat_seguimiento.id 
                INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id 
                INNER JOIN cat_actor ON captura.actores=cat_actor.id
                WHERE captura.estatus<>16 AND captura.juicio_proced='$t_juicio' AND captura.fecha_ing BETWEEN '$ini' AND '$fin' ORDER BY captura.fecha_ing";
        } else {
            //echo "juicio";
            $qry2 = "SELECT idcaptura AS Id, fecha_ing AS Fecha_Ingreso, fecha_ses AS Fecha_Sesión, num_exp AS Número_Expediente, num_int AS Número_Interno, accionante, observaciones, cat_estatus.estatus AS Estatus, cat_abogado.n_abogado AS Abogado, cat_ministro.ministros AS Ministro_Instructor, cat_prioridad.nivel AS Prioridad, cat_seguimiento.seguimiento AS Seguimiento, cat_juicio.t_juicio AS Juicio_Procedimiento, cat_actor.actord AS Actor_Demandado
                FROM captura 
                INNER JOIN cat_estatus ON captura.estatus=cat_estatus.id 
                INNER JOIN cat_abogado ON captura.abogado=cat_abogado.id 
                INNER JOIN cat_ministro ON captura.ministro=cat_ministro.id 
                INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id 
                INNER JOIN cat_seguimiento ON captura.seguimiento=cat_seguimiento.id 
                INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id 
                INNER JOIN cat_actor ON captura.actores=cat_actor.id
                WHERE captura.estatus<>16 AND  captura.juicio_proced='$t_juicio'";
        }
    }
} else {
    if ($actord) {
        if ($ini && $fin) {
            //echo "actor con fechas";
            $qry2 = "SELECT idcaptura AS Id, fecha_ing AS Fecha_Ingreso, fecha_ses AS Fecha_Sesión, num_exp AS Número_Expediente, num_int AS Númerp_Interno, accionante, observaciones, cat_estatus.estatus AS Estatus, cat_abogado.n_abogado AS Abogado, cat_ministro.ministros AS Ministro_Instructor, cat_prioridad.nivel AS Prioridad, cat_seguimiento.seguimiento AS Deguimiento, cat_juicio.t_juicio AS Juicio_Procedimiento, cat_actor.actord AS Actor_Demandado
                FROM captura 
                INNER JOIN cat_estatus ON captura.estatus=cat_estatus.id 
                INNER JOIN cat_abogado ON captura.abogado=cat_abogado.id 
                INNER JOIN cat_ministro ON captura.ministro=cat_ministro.id 
                INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id 
                INNER JOIN cat_seguimiento ON captura.seguimiento=cat_seguimiento.id 
                INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id 
                INNER JOIN cat_actor ON captura.actores=cat_actor.id
                WHERE captura.estatus<>16 AND captura.actores='$actord'";
                
        } else {
            //echo "solo actor";
            $qry2 = "SELECT idcaptura AS Id, fecha_ing AS Fecha_Ingreso, fecha_ses AS Fecha_Sesión, num_exp AS Número_Expediente, num_int AS Número_Interno, accionante, observaciones, cat_estatus.estatus AS Estatus, cat_abogado.n_abogado AS Abogado, cat_ministro.ministros AS Ministro_Instructor, cat_prioridad.nivel AS Prioridad, cat_seguimiento.seguimiento AS Seguimiento, cat_juicio.t_juicio AS Juicio_Procedimiento, cat_actor.actord AS Actor
                FROM captura 
                INNER JOIN cat_estatus ON captura.estatus=cat_estatus.id 
                INNER JOIN cat_abogado ON captura.abogado=cat_abogado.id 
                INNER JOIN cat_ministro ON captura.ministro=cat_ministro.id 
                INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id 
                INNER JOIN cat_seguimiento ON captura.seguimiento=cat_seguimiento.id 
                INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id 
                INNER JOIN cat_actor ON captura.actores=cat_actor.id
                WHERE captura.estatus<>16 AND captura.actores='$actord'";
        }
    } else {
        if ($ini && $fin) {
            //echo "solo fechas";
            $qry2 = "SELECT idcaptura AS Id, fecha_ing AS Fecha_Ingreso, fecha_ses AS Fecha_Sesión, num_exp AS Número_Expediente, num_int AS Número_Interno, accionante, observaciones, cat_estatus.estatus AS Estatus, cat_abogado.n_abogado AS Abogado, cat_ministro.ministros AS Ministro_Instructor, cat_prioridad.nivel Prioridad, cat_seguimiento.seguimiento AS Seguimiento, cat_juicio.t_juicio AS Juicio_Procedimiento, cat_actor.actord AS Actor
                FROM captura 
                INNER JOIN cat_estatus ON captura.estatus=cat_estatus.id 
                INNER JOIN cat_abogado ON captura.abogado=cat_abogado.id 
                INNER JOIN cat_ministro ON captura.ministro=cat_ministro.id 
                INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id 
                INNER JOIN cat_seguimiento ON captura.seguimiento=cat_seguimiento.id 
                INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id 
                INNER JOIN cat_actor ON captura.actores=cat_actor.id
                WHERE captura.estatus<>16 AND captura.fecha_ing BETWEEN '$ini' AND '$fin' ORDER BY captura.fecha_ing";

        } else {
            //echo "general";
            $qry2 = "SELECT idcaptura AS Id, fecha_ing AS Fecha_Ingreso, fecha_ses AS Fecha_Sesión, num_exp AS Número_Expediente, num_int AS Número_Interno, accionante, observaciones, cat_estatus.estatus AS Estatus, cat_abogado.n_abogado AS Abogado, cat_ministro.ministros AS Ministro_Instructor, cat_prioridad.nivel AS Prioridad, cat_seguimiento.seguimiento AS Seguimiento, cat_juicio.t_juicio AS Juicio_Procedimiento, cat_actor.actord AS Actor 
                FROM captura 
                INNER JOIN cat_estatus ON captura.estatus=cat_estatus.id 
                INNER JOIN cat_abogado ON captura.abogado=cat_abogado.id 
                INNER JOIN cat_ministro ON captura.ministro=cat_ministro.id 
                INNER JOIN cat_prioridad ON captura.prioridad=cat_prioridad.id 
                INNER JOIN cat_seguimiento ON captura.seguimiento=cat_seguimiento.id 
                INNER JOIN cat_juicio ON captura.juicio_proced=cat_juicio.id 
                INNER JOIN cat_actor ON captura.actores=cat_actor.id WHERE captura.estatus<>16";
        }
    }
}
?>
<style>
    #mi-div {
        text-align: center;
    }

    .titulo-h2 {
        color: #333;
        /* Color del texto */
        font-size: 15px;
        /* Tamaño de la fuente */
        font-weight: bold;
        /* Grosor de la fuente */
        margin-bottom: 10px;
        /* Margen inferior */
        /* Otros estilos que desees agregar */
    }
</style>
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 h-100">
                <?php //echo "<h2 class='titulo-h2'>Se encontraron registros</h2>"; ?>
                <div class="card h-100">

                    <div class="card-body card-block h-100">

                        <div class="row">

                            <div class="col-3">

                                <div class="form-group">

                                </div>

                            </div>

                        </div>
                        <div style="font-size: 18px;">
                            <?php
                                $xcrud->query($qry2);
                                echo $xcrud->render();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>