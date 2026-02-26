CREATE DATABASE IF NOT EXISTS `direccion-genero`
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE `direccion-genero`;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS masculinidades_caso_violencia;
DROP TABLE IF EXISTS masculinidades_caso_medida;
DROP TABLE IF EXISTS masculinidades_grupo_familiar;
DROP TABLE IF EXISTS masculinidades_casos;
DROP TABLE IF EXISTS masculinidades_tipos_violencia;
DROP TABLE IF EXISTS medidas_cautelares;
DROP TABLE IF EXISTS espacios_grupales;
DROP TABLE IF EXISTS situaciones_sanitarias;
DROP TABLE IF EXISTS situaciones_habitacionales;
DROP TABLE IF EXISTS masculinidades_derivaciones;

DROP TABLE IF EXISTS ive_medicaciones;
DROP TABLE IF EXISTS ive_caso_red;
DROP TABLE IF EXISTS ive_caso_violencia;
DROP TABLE IF EXISTS ive_casos;

DROP TABLE IF EXISTS personas;
DROP TABLE IF EXISTS redes_contencion;
DROP TABLE IF EXISTS tipos_violencia;
DROP TABLE IF EXISTS niveles_estudio;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE niveles_estudio (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO niveles_estudio (nombre) VALUES
('Primaria'),
('Secundaria'),
('Terciario'),
('Universidad');

CREATE TABLE tipos_violencia (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO tipos_violencia (nombre) VALUES
('Psicologica'),
('Economica'),
('Fisica');

CREATE TABLE redes_contencion (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO redes_contencion (nombre) VALUES
('Pareja'),
('Familiares'),
('Amigos'),
('Organizaciones');

CREATE TABLE personas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    apellido VARCHAR(150) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    dni VARCHAR(20) NOT NULL UNIQUE,
    domicilio VARCHAR(255),
    barrio VARCHAR(150),
    telefono VARCHAR(50),
    nivel_estudio_id BIGINT UNSIGNED,
    trabaja BOOLEAN NOT NULL DEFAULT 0,
    grupo_sanguineo VARCHAR(5),
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (nivel_estudio_id)
        REFERENCES niveles_estudio(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ive_casos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    persona_id BIGINT UNSIGNED NOT NULL,
    fum DATE,
    eco_semanas INT,
    obra_social BOOLEAN NOT NULL DEFAULT 0,
    cantidad_hijos INT DEFAULT 0,
    interrupcion_previa BOOLEAN NOT NULL DEFAULT 0,
    alta DATE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (persona_id)
        REFERENCES personas(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ive_caso_violencia (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ive_caso_id BIGINT UNSIGNED NOT NULL,
    tipo_violencia_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (ive_caso_id)
        REFERENCES ive_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (tipo_violencia_id)
        REFERENCES tipos_violencia(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ive_caso_red (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ive_caso_id BIGINT UNSIGNED NOT NULL,
    red_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (ive_caso_id)
        REFERENCES ive_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (red_id)
        REFERENCES redes_contencion(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ive_medicaciones (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ive_caso_id BIGINT UNSIGNED NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    numero_lote VARCHAR(100) NOT NULL,
    FOREIGN KEY (ive_caso_id)
        REFERENCES ive_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE masculinidades_derivaciones (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO masculinidades_derivaciones (nombre) VALUES
('Patronatos deliberados'),
('Juzgado de familia'),
('Direccion de genero'),
('Juzgado penal'),
('Voluntad propia');

CREATE TABLE situaciones_habitacionales (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO situaciones_habitacionales (nombre) VALUES
('Casa'),
('Departamento'),
('Casilla'),
('Rancho');

CREATE TABLE situaciones_sanitarias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO situaciones_sanitarias (nombre) VALUES
('Muy buena'),
('Buena'),
('Regular'),
('Mala');

CREATE TABLE espacios_grupales (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO espacios_grupales (nombre) VALUES
('Club'),
('Agrupacion'),
('Religion');

CREATE TABLE medidas_cautelares (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO medidas_cautelares (nombre) VALUES
('Perimetros'),
('Boton de panico'),
('Recorridas dinamicas');

CREATE TABLE masculinidades_tipos_violencia (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO masculinidades_tipos_violencia (nombre) VALUES
('Fisica'),
('Psicologica'),
('Economica');

CREATE TABLE masculinidades_casos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    persona_id BIGINT UNSIGNED NOT NULL,
    victima_id BIGINT UNSIGNED,
    derivacion_id BIGINT UNSIGNED NOT NULL,
    situacion_habitacional_id BIGINT UNSIGNED,
    nivel_estudio_id BIGINT UNSIGNED,
    trabaja BOOLEAN NOT NULL DEFAULT 0,
    red_contencion BOOLEAN NOT NULL DEFAULT 0,
    situacion_sanitaria_id BIGINT UNSIGNED,
    realiza_tratamiento BOOLEAN,
    descripcion_tratamiento TEXT,
    consumo BOOLEAN NOT NULL DEFAULT 0,
    terapia BOOLEAN NOT NULL DEFAULT 0,
    espacio_grupal_id BIGINT UNSIGNED,
    hijos_en_comun INT DEFAULT 0,
    relacion_actual BOOLEAN DEFAULT 0,
    descripcion_relacion TEXT,
    situacion_judicial TEXT,
    desobediencia BOOLEAN DEFAULT 0,
    reincidencia INT DEFAULT 0,
    asistencia_dispositivo INT DEFAULT 0,
    observaciones TEXT,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (persona_id)
        REFERENCES personas(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (victima_id)
        REFERENCES personas(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (derivacion_id)
        REFERENCES masculinidades_derivaciones(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    FOREIGN KEY (situacion_habitacional_id)
        REFERENCES situaciones_habitacionales(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (nivel_estudio_id)
        REFERENCES niveles_estudio(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (situacion_sanitaria_id)
        REFERENCES situaciones_sanitarias(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (espacio_grupal_id)
        REFERENCES espacios_grupales(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE masculinidades_grupo_familiar (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    caso_id BIGINT UNSIGNED NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    apellido VARCHAR(150) NOT NULL,
    dni VARCHAR(20),
    telefono VARCHAR(50),
    vinculo_actual VARCHAR(100),
    FOREIGN KEY (caso_id)
        REFERENCES masculinidades_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE masculinidades_caso_medida (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    caso_id BIGINT UNSIGNED NOT NULL,
    medida_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (caso_id)
        REFERENCES masculinidades_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (medida_id)
        REFERENCES medidas_cautelares(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE masculinidades_caso_violencia (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    caso_id BIGINT UNSIGNED NOT NULL,
    tipo_violencia_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (caso_id)
        REFERENCES masculinidades_casos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (tipo_violencia_id)
        REFERENCES masculinidades_tipos_violencia(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;