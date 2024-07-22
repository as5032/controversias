USE sistemacaccc;
-- SELECT DE JUICIOS POR ABOGADO --------------------------------------
SELECT
cat_abogado.n_abogado AS abogado,
COUNT(captura.juicio_proced) AS count_registros
FROM 
    captura
LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
GROUP BY abogado;

 -- SELECT DE JUICIOS POR ESTATUS --------------------------------------
SELECT
cat_estatus.estatus AS estatus,
COUNT(captura.juicio_proced) AS count_registros
FROM 
    captura
LEFT JOIN cat_estatus ON captura.estatus = cat_estatus.id
GROUP BY estatus;

 -- SELECT DE JUICIOS POR ASUNTO --------------------------------------
SELECT
cat_asunto.asunto AS asunto,
COUNT(captura.juicio_proced) AS count_registros
FROM 
    captura
LEFT JOIN cat_asunto ON captura.asunto = cat_asunto.id
GROUP BY asunto;

 -- SELECT DE JUICIOS POR PRIORIDAD --------------------------------------
SELECT
cat_prioridad.nivel AS prioridad,
COUNT(captura.juicio_proced) AS count_registros
FROM 
    captura
LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id
GROUP BY prioridad;





SELECT
    captura.juicio_proced,
    cat_abogado.n_abogado AS abogado,
    (
        DATEDIFF(fecha_ven, fecha_ing) + 1
        - (WEEK(fecha_ven) - WEEK(fecha_ing)) * 2
        - IF(WEEKDAY(fecha_ing) > 4, 2, 0)
        - IF(WEEKDAY(fecha_ven) < 5, 0, 1)
    ) AS dias_habiles
FROM
    captura
LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id;
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
    
-- SELECT DE DIAS HABILES DE VENCIMIENTOS RESPECTO A LA FECHA ACTUAL DE 5 DÍAS O MENOS --------------------------------------
    SELECT
		juicio_proced, cat_abogado.n_abogado AS abogado,
		(DATEDIFF(fecha_ven, CURDATE()) + 1) -
		(WEEK(fecha_ven) - WEEK(CURDATE())) * 2 -
		IF(WEEKDAY(CURDATE()) > 4, 2, 0) -
		IF(WEEKDAY(fecha_ven) < 5, 0, 1) AS dias_habiles_restantes
	FROM
		sistemacaccc.captura
		LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
	WHERE
		DATEDIFF(fecha_ven, CURDATE()) <= 6 -- Obtiene datos con 5 días hábiles o menos antes de la fecha de vencimiento
    AND DATEDIFF(fecha_ven, CURDATE()) >= 0; -- Añade esta condición para excluir registros vencidos
    
    -- SELECT DE DIAS HABILES DE VENCIMIENTOS RESPECTO A LA FECHA ACTUAL DE 5 DÍAS O MENOS --------------------------------------
    SELECT
		juicio_proced, cat_abogado.n_abogado AS abogado,
		(DATEDIFF(fecha_ven, CURDATE()) + 1) -
		(WEEK(fecha_ven) - WEEK(CURDATE())) * 2 -
		IF(WEEKDAY(CURDATE()) > 4, 2, 0) -
		IF(WEEKDAY(fecha_ven) < 5, 0, 1) AS dias_habiles_restantes
	FROM
		sistemacaccc.captura
		LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
	WHERE
		DATEDIFF(fecha_ven, CURDATE()) >= 7; -- Obtiene datos con 5 días hábiles o menos antes de la fecha de vencimiento

SELECT COUNT(*) as count_registros 
FROM sistemacaccc.captura 
WHERE DATEDIFF(fecha_ven, CURDATE()) >= 7;

SELECT COUNT(*) as count_registros 
FROM sistemacaccc.captura 
WHERE DATEDIFF(fecha_ven, CURDATE()) <= 6;

SELECT COUNT(*) as count_registros 
FROM sistemacaccc.captura 
WHERE DATEDIFF(fecha_ven, CURDATE()) <= 6;

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
    
    

    
    
    
DELETE FROM sistemacaccc.captura WHERE idcaptura IN (8);

SELECT * FROM captura where idcaptura=1;

use sistemacaccc;

SELECT
	captura.idcaptura,
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
LEFT JOIN cat_prioridad ON captura.prioridad = cat_prioridad.id;
WHERE idcaptura = 12;

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
    
    
    
    SELECT
                                        juicio_proced, cat_abogado.n_abogado AS abogado,
                                        (DATEDIFF(fecha_ven, CURDATE()) + 1) -
                                        (WEEK(fecha_ven) - WEEK(CURDATE())) * 2 -
                                        IF(WEEKDAY(CURDATE()) > 4, 2, 0) -
                                        IF(WEEKDAY(fecha_ven) < 5, 0, 1) AS dias_habiles_restantes
                                    FROM
                                         sistemacaccc.captura
                                         LEFT JOIN cat_abogado ON captura.abogado = cat_abogado.id
                                    WHERE
                                        fecha_ven >= CURDATE();
