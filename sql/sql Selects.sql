-- SELECT DE DIAS HABILES DE VENCIMIENTOS RESPECTO A LA FECHA ACTUAL --------------------------------------
SELECT
    *,
    (DATEDIFF(fecha_ven, CURDATE()) + 1) -
    (WEEK(fecha_ven) - WEEK(CURDATE())) * 2 -
    IF(WEEKDAY(CURDATE()) > 4, 2, 0) -
    IF(WEEKDAY(fecha_ven) < 5, 0, 1) AS dias_habiles_restantes
FROM
     sistemacaccc.captura
WHERE
    fecha_ven >= CURDATE();


-- SELECT DE DIAS HABILES DE VENCIMIENTOS --------------------------------------
SELECT
*, 
    DATEDIFF(fecha_ven, fecha_ing) + 1 - 
    (WEEK(fecha_ven) - WEEK(fecha_ing)) * 2 - 
    (CASE WHEN WEEKDAY(fecha_ing) = 6 THEN 1 ELSE 0 END) - 
    (CASE WHEN WEEKDAY(fecha_ven) = 5 THEN 1 ELSE 0 END) AS dias_habiles
FROM 
    sistemacaccc.captura
WHERE 
    fecha_ven >= fecha_ing;
-- ***************************************** --------------------------------------
    
    
    
DELETE FROM sistemacaccc.captura WHERE idcaptura IN (33,34);

SELECT * FROM captura where idcaptura=1;



SELECT
    captura.fecha_ing,
    captura.fecha_ven,
    captura.juicio_proced,
    captura.accionante,
    cat_asunto.asunto AS asunto,
    cat_abogado.n_abogado AS abogado,
    captura.materia,
    cat_estatus.estatus AS estatus,
    cat_prioridad.nivel AS prioridad,
    captura.acuse,
    captura.observaciones
FROM
    captura
LEFT JOIN cat_asunto ON captura.asunto = cat_asunto.id
LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id
LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id
WHERE idcaptura = 1;

UPDATE captura
SET
    fecha_ing = TRIM(fecha_ing),
    fecha_ven = TRIM(fecha_ven),
    juicio_proced = TRIM(juicio_proced),
    accionante = TRIM(accionante),
    asunto = TRIM(asunto),
    abogado = TRIM(abogado),
    materia = TRIM(materia),
    estatus = TRIM(estatus),
    prioridad = TRIM(prioridad),
    acuse = TRIM(acuse),
    observaciones = TRIM(observaciones);
