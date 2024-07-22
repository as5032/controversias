CREATE TABLE registro_cambios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT,  -- El ID del usuario que realizó el cambio
    id_registro_afectado INT,  -- El ID del registro que se modificó
    campo_afectado VARCHAR(255),  -- El nombre del campo que se modificó
    valor_anterior VARCHAR(250),  -- El valor anterior del campo
    valor_nuevo VARCHAR(250),  -- El nuevo valor del campo
    FOREIGN KEY (id_usuario) REFERENCES logins(id),  -- Ajusta según tu estructura de usuarios
    FOREIGN KEY (id_registro_afectado) REFERENCES captura(idcaptura)  -- Ajusta según tu estructura de registros
);