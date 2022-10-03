/* BASE DE DATOS */

/* PRIMER MODELO */
/* NUEVAMENTE SE HAN BORRADO LAS LLAVES FORÁNEAS*/

USE fora;

CREATE TABLE suscriptor (
	email VARCHAR(40) NOT NULL PRIMARY KEY,
	nombre VARCHAR(30) NOT NULL,
	apellidos VARCHAR(40) NOT NULL,
	fecha_registro DATETIME NOT NULL
);

CREATE TABLE baja (
	id_baja INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	suscrip_email VARCHAR(40) NOT NULL,
	motivo VARCHAR(30) NOT NULL,
	fecha_baja DATETIME NOT NULL
);

CREATE TABLE administrador (
	email VARCHAR(40) NOT NULL PRIMARY KEY,
	clave VARCHAR(30) NOT NULL,
	nombre VARCHAR(30) NOT NULL,
	apellidos VARCHAR(40) NOT NULL,
	genero ENUM("Hombre", "Mujer", "Otro") NOT NULl,
	acceso VARCHAR(20) NOT NULL
);


DELIMITER $$
CREATE PROCEDURE dardebaja(IN _motivo VARCHAR(50), IN _email VARCHAR(40), OUT res INT)
BEGIN
START TRANSACTION;
INSERT INTO `baja`(`suscrip_email`, `motivo`, `fecha_baja`) VALUES (_email, _motivo, NOW());
DELETE FROM `suscriptor` WHERE email = _email;
SET res = ROW_COUNT();
COMMIT;
END $$
DELIMITER ;

INSERT INTO privilegio VALUES ('Admin', 'moduloBajas');



