SELECT
 captura.idcaptura,
 captura.fecha_cap,
 captura.fecha_ing,
 captura.fecha_ven,
 captura.num_exp,
 cat_juicio.t_juicio AS juicio,
 cat_actor.actord AS actor,
 captura.accionante,
 cat_estatus.estatus AS estatus,
 cat_abogado.n_abogado AS abogado,
 captura.asunto,
 cat_seguimiento.seguimiento AS seguimiento,
 cat_prioridad.nivel AS prioridad,
 captura.observaciones
FROM
 captura
LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id
LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
LEFT JOIN cat_juicio ON captura.juicio_proced = cat_juicio.id
LEFT JOIN cat_actor ON captura.actores = cat_actor.id
LEFT JOIN cat_seguimiento ON captura.seguimiento = cat_seguimiento.id
LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id
WHERE 
cat_estatus.estatus <> 'CONCLUIDO';
                                                
-- SELECT DE CANTIDAD DE JUICIOS POR ABOGADO --------------------------------------
SELECT
    cat_abogado.n_abogado AS abogado,
    COUNT(captura.idcaptura) AS total_juicios_asignados
FROM
    captura
LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
WHERE 
	captura.abogado = 8
GROUP BY
    cat_abogado.n_abogado;

-- SELECT DE CANTIDAD DE JUICIOS POR ABOGADO Y RANGO DE FECHA --------------------------------------
SELECT
    cat_abogado.n_abogado AS abogado,
    COUNT(captura.idcaptura) AS total_juicios_asignados
FROM
    captura
LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
WHERE
    captura.abogado = id
    AND captura.fecha_cap >= '2023-04-11' -- Fecha Inicio ----
    AND captura.fecha_cap <= '2024-05-30' -- Fecha Final ----
GROUP BY
    cat_abogado.n_abogado;