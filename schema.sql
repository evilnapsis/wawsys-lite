/**
 * WawSys - Control de Consumo de Agua
 * Schema simplificado de Base de Datos
 * Base de datos: wawsys
 **/

create database if not exists wawsys character set utf8mb4 collate utf8mb4_unicode_ci;
use wawsys;

set foreign_key_checks = 0;
drop table if exists val;
drop table if exists client;
drop table if exists meter;
drop table if exists location;
drop table if exists category;
drop table if exists configuration;
drop table if exists user;
-- Tablas obsoletas eliminadas del modelo anterior:
drop table if exists well;
drop table if exists franchise;
drop table if exists w;
drop table if exists r;
drop table if exists country;
drop table if exists k;
set foreign_key_checks = 1;

-- ==============================================================================
-- 1. TABLA: user (Usuarios del sistema)
-- ==============================================================================
create table user (
    id int not null auto_increment primary key,
    name varchar(50) not null,
    lastname varchar(50) default '',
    username varchar(50) not null unique,
    email varchar(255) default null,
    password varchar(60) not null,
    image varchar(255) default null,
    status int not null default 1,       /* 1. Activo, 2. Inactivo, 3. Suspendido */
    kind int not null default 1,         /* 1. Administrador, 2. Operador / Lector */
    created_at datetime not null default current_timestamp
) engine=innodb default charset=utf8mb4;

-- Usuario administrador inicial (password default: 'admin' con sha1(md5('admin')))
insert into user (name, lastname, username, email, password, status, kind, created_at)
values ('Administrador', '', 'admin', 'admin@wawsys.local', sha1(md5('admin')), 1, 1, now());


-- ==============================================================================
-- 2. TABLA: category (Categorías de consumo - antes tabla 'k')
-- ==============================================================================
create table category (
    id int not null auto_increment primary key,
    name varchar(100) not null unique,
    description text default null,
    created_at datetime not null default current_timestamp
) engine=innodb default charset=utf8mb4;

-- Datos iniciales migrados de la antigua tabla k
insert into category (name) values
('Agroindustrial'),
('Comercial'),
('Domestico'),
('Gubernamental'),
('Industrial'),
('Institucional'),
('Recreativo');


-- ==============================================================================
-- 3. TABLA: location (Ubicaciones / Zonas / Sectores)
-- ==============================================================================
create table location (
    id int not null auto_increment primary key,
    name varchar(150) not null unique,
    description text default null,
    created_at datetime not null default current_timestamp
) engine=innodb default charset=utf8mb4;


-- ==============================================================================
-- 4. TABLA: meter (Medidores de agua)
-- Antes: name, brand, serie, start_at, expire_at, etc.
-- Ahora simplificado con identifier, marca, serie, fechas opcionales y status
-- ==============================================================================
create table meter (
    id int not null auto_increment primary key,
    identifier varchar(100) not null unique,  /* Identificador único / Código del medidor */
    brand varchar(100) not null,              /* Marca del medidor */
    serie varchar(100) not null,              /* Número de serie */
    issued_at date default null,              /* Fecha de expedición (opcional) */
    expired_at date default null,             /* Fecha de expiración (opcional) */
    status int not null default 1,            /* 1. Activo, 2. Mantenimiento, 3. Baja */
    created_at datetime not null default current_timestamp
) engine=innodb default charset=utf8mb4;


-- ==============================================================================
-- 5. TABLA: client (Clientes de la empresa)
-- ==============================================================================
create table client (
    id int not null auto_increment primary key,
    code varchar(50) default null unique,     /* Código de cuenta / contrato (opcional) */
    name varchar(100) not null,
    lastname varchar(100) default '',
    dni varchar(50) default null,             /* Documento de identidad (DNI/RFC/Cédula) */
    phone varchar(50) default null,
    email varchar(255) default null,
    address varchar(255) default null,        /* Dirección física del suministro */
    location_id int default null,             /* Ubicación / Sector asignado */
    category_id int default null,             /* Categoría de consumo */
    meter_id int default null unique,         /* Medidor asignado al cliente */
    status int not null default 1,            /* 1. Activo, 2. Suspendido, 3. Cancelado */
    created_at datetime not null default current_timestamp,
    constraint fk_client_location foreign key (location_id) references location(id) on delete set null,
    constraint fk_client_category foreign key (category_id) references category(id) on delete set null,
    constraint fk_client_meter foreign key (meter_id) references meter(id) on delete set null
) engine=innodb default charset=utf8mb4;


-- ==============================================================================
-- 6. TABLA: val (Control de lecturas periódicas de consumo)
-- ==============================================================================
create table val (
    id int not null auto_increment primary key,
    client_id int not null,                   /* Cliente asociado */
    meter_id int not null,                    /* Medidor con el que se tomó la lectura */
    val decimal(12,2) not null,               /* Valor leído en el medidor */
    previous_val decimal(12,2) default 0.00,  /* Lectura del periodo anterior (para cálculo directo) */
    consumption decimal(12,2) default 0.00,   /* Consumo neto = val - previous_val */
    image varchar(255) default null,          /* Foto del medidor / evidencia */
    date_at date not null,                    /* Fecha en que se tomó la lectura */
    period varchar(20) default null,          /* Periodo contable o de facturación (ej: '2026-09') */
    comment text default null,                /* Observaciones (fuga, medidor dañado, etc.) */
    user_id int not null,                     /* Usuario/lector que registró la toma */
    created_at datetime not null default current_timestamp,
    constraint fk_val_client foreign key (client_id) references client(id) on delete cascade,
    constraint fk_val_meter foreign key (meter_id) references meter(id) on delete cascade,
    constraint fk_val_user foreign key (user_id) references user(id) on delete restrict,
    index idx_val_date (date_at),
    index idx_val_client_period (client_id, period)
) engine=innodb default charset=utf8mb4;


-- ==============================================================================
-- 7. TABLA: configuration (Variables y configuración del sistema)
-- ==============================================================================
create table configuration (
    id int not null auto_increment primary key,
    short varchar(255) unique,
    name varchar(255) unique,
    kind int,
    val varchar(255)
) engine=innodb default charset=utf8mb4;

insert into configuration(short,name,kind,val) value("title","Titulo del Sistema",2,"WawSys Lite");

