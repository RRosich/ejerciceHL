# ejerciceHL
ejercicio de prueba

Para arrancar el proyecto sera necesario completar los siguietes pasos:

1-Crear el siguiente esquema y tablas:


CREATE SCHEMA IF NOT EXISTS `hotellinking` DEFAULT CHARACTER SET latin1 ;
USE `hotellinking` ;

CREATE TABLE IF NOT EXISTS `hotellinking`.`promotion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `promoCode` VARCHAR(100) NOT NULL,
  `redeem` TINYINT(1) NOT NULL,
  `userId` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `userId` (`userId` ASC),
  UNIQUE INDEX `promoCode_UNIQUE` (`promoCode` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 19

CREATE TABLE IF NOT EXISTS `hotellinking`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = MyISAM
AUTO_INCREMENT = 17

2-configurar el archivo db/Conexion para definir los parametros correctos para establecer la conexion con la bbdd

3-arrancar el index.php en su servidor de confianza

4-cruzar los dedos
