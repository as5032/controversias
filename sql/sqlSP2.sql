DELIMITER //
CREATE PROCEDURE InsertRegistroCambio(
    IN p_id_captura INT,
    IN p_mensaje VARCHAR(255),
    IN p_documento VARCHAR(255),
    IN usuario_cambio INT
)
BEGIN
    INSERT INTO registro_cambios (fecha, id_usuario, id_registro_afectado, mensaje, documento)
    VALUES (NOW(), 
    usuario_cambio, 
    p_id_captura, 
    TRIM(p_mensaje), 
    TRIM(p_documento));
END //
DELIMITER ;
                                                        
                                                        