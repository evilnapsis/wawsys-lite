create database wawsys;
use wawsys;

create table user(
	id int not null auto_increment primary key,
	name varchar(50),
	lastname varchar(50),
	username varchar(50),
	email varchar(255),
	password varchar(60),
	image varchar(255),
	status int default 1,
	franchise_id int,
	expire_at date,
	kind int default 1,/* 1. administrador, 2. subadmin,  3. franchise account */
	created_at datetime
);

/**
* password: encrypted using sha1(md5("mypassword"))
* status: 1. active, 2. inactive, 3. other, ...
* kind: 1. root, 2. other, ...
**/

/* insert user example */
insert into user (name,username,password,created_at) value ("Administrator","admin",sha1(md5("admin")),NOW());

create table k(
	id int not null auto_increment primary key,
	name varchar(255)
	);

insert into k (name) values ("Agroindustrial"),("Comercial"),("Domestico"),("Gubernamental"),("Industrial"),("Institucional"),("Recreativo");

create table w(
	id int not null auto_increment primary key,
	name varchar(255)
	);

insert into w (name) values ("Rio"),("Quebrada"),("Ca~o"),("Acuifero"),("Manantial"),("Mar");

create table r(
	id int not null auto_increment primary key,
	name varchar(255)
	);

insert into r (name) values ("Galones al a~o"),("Galones por minuto"),("Horas al dia"),("Dias a la semana"),("Semanas al a~o"),("Otro");

create table country(
	id int not null auto_increment primary key,
	name varchar(255)
	);

insert into country (name) value ("Costa Rica");

create table franchise(
	id int not null auto_increment primary key,
	name varchar(255),
	name_owner varchar(255),
	no varchar(255),
	no_dfa varchar(255),
	no_dfc varchar(255),
	start_at date,
	expire_at date,
	kind_drna int,
	kind_tariff int, /* 1. mensual, 2 anual */
	tariff double,
	caudal varchar(255),
	f_address varchar(255),
	f_city varchar(255),
	f_country_id int,
	f_cp varchar(255),
	p_address varchar(255),
	p_city varchar(255),
	p_country_id int,
	p_cp varchar(255),
	da int,
	da_kind int,
	da_year double,
	da_total double,
	da_no varchar(255),
	k_id int not null,
	created_at datetime,
	foreign key (k_id) references k(id)
);

create table well(
	id int not null auto_increment primary key,
	no varchar(255),
	name varchar(255),
	address varchar(255),
	barrio varchar(255),
	sector varchar(255),
	finca varchar(255),
	kilometro varchar(255),
	hectometro varchar(255),
	ciudad varchar(255),
	lat varchar(255),
	lng varchar(255),
	zoom varchar(255),
	diam double,/* diametro del tubo en pulgadas*/
	capacity_gpm double, /*capacidad en Galones por Minutos*/
	kt int, /* tipo de toma, 1. permanente, 2. portatil, 3. otro */
	kt_esp varchar(255),/* especificar tipo de toma*/
	depth double,
	kd int, /* 1. llano, 2. artesiano*/
	r_id int,
	r double,
	franchise_id int not null,
	created_at datetime,
	w_id int not null,
	kmt int, /* 1. superficial, 2. pozo profundo*/
	brand varchar(255),
	serie varchar(255),
	digits int, /* cantidad de digitos */
	unit int, /* 1. galones, 2. metros cubicos */
	factor double,
	kx int default 1, /* 1. normal, 2.reinicio, 3. ajuste */
	foreign key (w_id) references w(id),
	foreign key (r_id) references r(id),
	foreign key (franchise_id) references franchise(id)
);

create table val(
	id int not null auto_increment primary key,
	well_id int not null,
	val varchar(255),
	image varchar(255),
	date_at date,
	k int, /* 1. mensual, 2. diaria */
	kx int, /* 1. mensual, 2. diaria */
	user_id int not null,
	created_at datetime,
	foreign key (well_id) references well(id)
);

create table meter(
	id int not null auto_increment primary key,
	name varchar(255),
	brand varchar(255),
	serie varchar(255),
	person varchar(255),
	organization varchar(255),
	no varchar(255),
	phone varchar(255),
	email varchar(255),
	start_at date,
	expire_at date
);