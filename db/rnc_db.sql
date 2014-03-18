SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `rnc_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `rnc_db` ;

-- -----------------------------------------------------
-- Table `rnc_db`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`usuario` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `role` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`dilegenciadores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`dilegenciadores` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`dilegenciadores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) NULL,
  `dependencia` VARCHAR(150) NULL,
  `cargo` VARCHAR(150) NULL,
  `telefono` VARCHAR(150) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`entidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`entidad` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`entidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo_titular` TINYINT NULL,
  `titular` VARCHAR(150) NOT NULL,
  `tipo_nit` SMALLINT NULL,
  `nit` VARCHAR(64) NULL,
  `representante_legal` VARCHAR(150) NULL,
  `tipo_id_rep` SMALLINT NULL,
  `representante_id` VARCHAR(64) NULL,
  `ciudad_id` INT NULL,
  `telefono` VARCHAR(150) NULL,
  `direccion` VARCHAR(150) NULL,
  `email` VARCHAR(45) NULL,
  `estado` SMALLINT NULL,
  `comentario` TEXT NULL,
  `usuario_id` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `dilegenciadores_id` INT NOT NULL,
  `tipo_institucion_id` INT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX `fk_entidad_dilegenciadores1_idx` (`dilegenciadores_id` ASC),
  CONSTRAINT `fk_entidad_dilegenciadores1`
    FOREIGN KEY (`dilegenciadores_id`)
    REFERENCES `rnc_db`.`dilegenciadores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`tipo_coleccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`tipo_coleccion` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`tipo_coleccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`registros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`registros` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`registros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Entidad_id` INT NOT NULL,
  `numero_registro` INT NOT NULL,
  `fecha_dil` DATETIME NULL,
  `fecha_prox` DATETIME NULL,
  `estado` INT NOT NULL DEFAULT 0,
  `tipo_coleccion_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Registros_Entidad1_idx` (`Entidad_id` ASC),
  INDEX `fk_registros_tipo_coleccion1_idx` (`tipo_coleccion_id` ASC),
  CONSTRAINT `fk_Registros_Entidad1`
    FOREIGN KEY (`Entidad_id`)
    REFERENCES `rnc_db`.`entidad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registros_tipo_coleccion1`
    FOREIGN KEY (`tipo_coleccion_id`)
    REFERENCES `rnc_db`.`tipo_coleccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`pqrs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`pqrs` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`pqrs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `tipo_solicitud` INT NULL,
  `descripcion` TEXT NULL,
  `ruta_anexo` VARCHAR(45) NULL,
  `respuesta` TEXT NULL,
  `estado` INT NULL,
  `fecha` DATETIME NULL,
  `entidad_id` INT NULL,
  `registros_id` INT NULL,
  `fecha_respuesta` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`contactos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`contactos` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`contactos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) NULL,
  `cargo` VARCHAR(150) NULL,
  `dependencia` VARCHAR(150) NULL,
  `direccion` VARCHAR(150) NULL,
  `ciudad_id` INT NULL,
  `telefono` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`registros_update`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`registros_update` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`registros_update` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha_act` DATETIME NOT NULL,
  `fecha_rev` DATETIME NULL,
  `nombre` VARCHAR(150) NOT NULL,
  `acronimo` VARCHAR(45) NULL,
  `fecha_fund` INT NULL,
  `descripcion` TEXT NULL,
  `direccion` VARCHAR(150) NULL,
  `ciudad_id` INT NULL,
  `telefono` VARCHAR(150) NULL,
  `email` VARCHAR(45) NULL,
  `cobertura_tax` VARCHAR(200) NULL,
  `cobertura_geog` VARCHAR(200) NULL,
  `cobertura_temp` VARCHAR(200) NULL,
  `listado_anexos` TEXT NULL,
  `info_adicional` TEXT NULL,
  `pagina_web` VARCHAR(150) NULL,
  `redes_social` TEXT NULL,
  `comentario_obv` TEXT NULL,
  `estado` SMALLINT NULL DEFAULT 1,
  `comentario` TEXT NULL,
  `registro_id` INT NULL DEFAULT 0,
  `tamano_coleccion_total` INT NULL DEFAULT 0,
  `tipo_coleccion_total` INT NULL DEFAULT 0,
  `terminos` SMALLINT NULL,
  `deorreferenciados` FLOAT NULL,
  `sistematizacion` TEXT NULL,
  `contactos_id` INT NOT NULL,
  `dilegenciadores_id` INT NOT NULL,
  `registros_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Registros_update_contactos1_idx` (`contactos_id` ASC),
  INDEX `fk_Registros_update_dilegenciadores1_idx` (`dilegenciadores_id` ASC),
  INDEX `fk_Registros_update_registros1_idx` (`registros_id` ASC),
  CONSTRAINT `fk_Registros_update_contactos1`
    FOREIGN KEY (`contactos_id`)
    REFERENCES `rnc_db`.`contactos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Registros_update_dilegenciadores1`
    FOREIGN KEY (`dilegenciadores_id`)
    REFERENCES `rnc_db`.`dilegenciadores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Registros_update_registros1`
    FOREIGN KEY (`registros_id`)
    REFERENCES `rnc_db`.`registros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`grupo_taxonomico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`grupo_taxonomico` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`grupo_taxonomico` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`subgrupo_taxonomico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`subgrupo_taxonomico` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`subgrupo_taxonomico` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) NULL,
  `grupo_taxonomico_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subgrupo_taxonomico_grupo_taxonomico1_idx` (`grupo_taxonomico_id` ASC),
  CONSTRAINT `fk_subgrupo_taxonomico_grupo_taxonomico1`
    FOREIGN KEY (`grupo_taxonomico_id`)
    REFERENCES `rnc_db`.`grupo_taxonomico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`composicion_general`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`composicion_general` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`composicion_general` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subgrupo_otro` VARCHAR(250) NULL,
  `numero_ejemplares` INT NULL DEFAULT 0,
  `numero_catalogados` FLOAT NULL DEFAULT 0,
  `numero_sistematizados` FLOAT NULL DEFAULT 0,
  `numero_nivel_orden` FLOAT NULL,
  `numero_nivel_familia` FLOAT NULL,
  `numero_nivel_genero` FLOAT NULL,
  `numero_nivel_especie` FLOAT NULL DEFAULT 0,
  `Registros_update_id` INT NOT NULL,
  `grupo_taxonomico_id` INT NULL,
  `subgrupo_taxonomico_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_composicion_general_Registros_update1_idx` (`Registros_update_id` ASC),
  INDEX `fk_composicion_general_grupo_taxonomico1_idx` (`grupo_taxonomico_id` ASC),
  INDEX `fk_composicion_general_subgrupo_taxonomico1_idx` (`subgrupo_taxonomico_id` ASC),
  CONSTRAINT `fk_composicion_general_Registros_update1`
    FOREIGN KEY (`Registros_update_id`)
    REFERENCES `rnc_db`.`registros_update` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_composicion_general_grupo_taxonomico1`
    FOREIGN KEY (`grupo_taxonomico_id`)
    REFERENCES `rnc_db`.`grupo_taxonomico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_composicion_general_subgrupo_taxonomico1`
    FOREIGN KEY (`subgrupo_taxonomico_id`)
    REFERENCES `rnc_db`.`subgrupo_taxonomico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`archivos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`archivos` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`archivos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) NOT NULL,
  `tipo` VARCHAR(25) NOT NULL,
  `ruta` VARCHAR(500) NOT NULL,
  `size` VARCHAR(45) NULL,
  `clase` INT NOT NULL,
  `Registros_update_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_archivos_Registros_update1_idx` (`Registros_update_id` ASC),
  CONSTRAINT `fk_archivos_Registros_update1`
    FOREIGN KEY (`Registros_update_id`)
    REFERENCES `rnc_db`.`registros_update` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`tipo_preservacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`tipo_preservacion` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`tipo_preservacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`tamano_coleccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`tamano_coleccion` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`tamano_coleccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `unidad_medida` VARCHAR(500) NULL,
  `otro` VARCHAR(250) NULL,
  `Registros_update_id` INT NOT NULL,
  `tipo_preservacion_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tamaño_coleccion_Registros_update1_idx` (`Registros_update_id` ASC),
  INDEX `fk_tamano_coleccion_tipo_preservacion1_idx` (`tipo_preservacion_id` ASC),
  CONSTRAINT `fk_tamaño_coleccion_Registros_update1`
    FOREIGN KEY (`Registros_update_id`)
    REFERENCES `rnc_db`.`registros_update` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tamano_coleccion_tipo_preservacion1`
    FOREIGN KEY (`tipo_preservacion_id`)
    REFERENCES `rnc_db`.`tipo_preservacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`tipos_en_coleccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`tipos_en_coleccion` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`tipos_en_coleccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `grupo` VARCHAR(150) NULL,
  `informacion_ejemplar` VARCHAR(150) NULL,
  `nombre_cientifico` VARCHAR(150) NULL,
  `cantidad` INT NULL,
  `Registros_update_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tipos_en_coleccion_Registros_update1_idx` (`Registros_update_id` ASC),
  CONSTRAINT `fk_tipos_en_coleccion_Registros_update1`
    FOREIGN KEY (`Registros_update_id`)
    REFERENCES `rnc_db`.`registros_update` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`visitas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`visitas` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`visitas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `entidad` VARCHAR(150) NULL,
  `ciudad_id` INT NULL,
  `fecha_visita` DATETIME NULL,
  `concepto` TEXT NULL,
  `registros_id` INT NULL,
  `dilegenciadores_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_visitas_dilegenciadores1_idx` (`dilegenciadores_id` ASC),
  CONSTRAINT `fk_visitas_dilegenciadores1`
    FOREIGN KEY (`dilegenciadores_id`)
    REFERENCES `rnc_db`.`dilegenciadores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`archivos_pqrs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`archivos_pqrs` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`archivos_pqrs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) NULL,
  `ruta` VARCHAR(500) NULL,
  `visitas_id` INT NULL,
  `pqrs_id` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rnc_db`.`tipo_institucion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rnc_db`.`tipo_institucion` ;

CREATE TABLE IF NOT EXISTS `rnc_db`.`tipo_institucion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
