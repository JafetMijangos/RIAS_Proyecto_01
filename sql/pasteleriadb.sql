CREATE DATABASE pasteleriadb CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';

use pasteleriadb;

/*Para crear la tabla productos*/
CREATE TABLE Productos (
		nClaveProducto INT AUTO_INCREMENT NOT NULL,
        	sNombre VARCHAR(30) NOT NULL,
        	nLinea VARCHAR(12) NOT NULL,
        	nTipo VARCHAR(10) NOT NULL,
        	sDescripcion VARCHAR(100) NOT NULL,
        	sSabor VARCHAR(100) NOT NULL,
        	sImagen VARCHAR(20) NOT NULL,
        	sPrecio NUMERIC(10,2) NOT NULL,
        	bActivo TINYINT(1) default 1,
        	PRIMARY KEY (nClaveProducto)
	);

/*Para crear la tabla usuarios*/
CREATE TABLE Usuario (
                sCorreo VARCHAR(100) NOT NULL,
                sContrasenia VARCHAR(9) NOT NULL,
                bActivo BOOLEAN DEFAULT true NOT NULL,
                PRIMARY KEY (sCorreo)
);

/*Para crear la tabla clientes*/
CREATE TABLE Cliente (
                sCorreo VARCHAR(100) NOT NULL,
                sNombre VARCHAR(150) NOT NULL,
                calle VARCHAR(30) NOT NULL,
                numero int NOT NULL,
                colonia VARCHAR(30) NOT NULL,
                ciudad VARCHAR(30) NOT NULL,
                estado VARCHAR(30) NOT NULL,
                sNumTelCel VARCHAR(25) NOT NULL,
		    sNumTelCasa VARCHAR(25) NOT NULL,
                PRIMARY KEY (sCorreo)
);

/*Para crear la tabla empleado*/
CREATE TABLE Empleado (
                sCorreo VARCHAR(100) NOT NULL,
                sNombreCompleto VARCHAR(150) NOT NULL,
                nTurno SMALLINT NOT NULL,
                sPerfil CHAR(1) NOT NULL,
                PRIMARY KEY (sCorreo)
);

/*Para crear la tabla Compra*/
CREATE TABLE Compra (
                nIdCompra INT AUTO_INCREMENT NOT NULL,
                dFecCompra DATE NOT NULL,
                dFecEnvio DATE,
                sClaveFormaPago CHAR(2) NOT NULL,
                sOrigen CHAR(1) NOT NULL,
                sCorreo VARCHAR(100) NOT NULL,
                PRIMARY KEY (nIdCompra)
);

ALTER TABLE Compra MODIFY COLUMN sOrigen CHAR(1) COMMENT 'e=en lÃ­nea, s=en sucursal';

/*Para crear la tabla Detalle Compra*/
CREATE TABLE DetalleCompra (
                nIdCompra INT NOT NULL,
                nClaveProducto INT NOT NULL,
                nCant SMALLINT NOT NULL,
                PRIMARY KEY (nIdCompra, nClaveProducto)
);

ALTER TABLE Empleado MODIFY COLUMN nTurno SMALLINT COMMENT '1=Matutino, 2=Vespertino';

ALTER TABLE Empleado MODIFY COLUMN sPerfil CHAR(1) COMMENT 'c=cajero, a=almacenista, g=administrador';

ALTER TABLE Empleado ADD CONSTRAINT usuario_empleado_fk
FOREIGN KEY (sCorreo)
REFERENCES Usuario (sCorreo);

ALTER TABLE Cliente ADD CONSTRAINT usuario_cliente_fk
FOREIGN KEY (sCorreo)
REFERENCES Usuario (sCorreo);

/*Para insertar empleados*/

insert into usuario (sCorreo, sContrasenia, bActivo) values ('abc123@gmail.com', 'abc__123', true);
insert into usuario (sCorreo, sContrasenia, bActivo) values ('abc124@gmail.com', 'abc__124', true);
insert into usuario (sCorreo, sContrasenia, bActivo) values ('abc125@gmail.com', 'abc__125', true);
insert into empleado (sCorreo, sNombreCompleto, nTurno, sPerfil) values ('abc123@gmail.com', 'Peter Parker', 1, 'g');
insert into empleado (sCorreo, sNombreCompleto, nTurno, sPerfil) values ('abc124@gmail.com', 'Bruce Barner', 1, 'c');
insert into empleado (sCorreo, sNombreCompleto, nTurno, sPerfil) values ('abc125@gmail.com', 'Tony Stark', 2, 'a');

/*Para insertar Clientes*/

insert into usuario (sCorreo, sContrasenia, bActivo) values ('abc126@gmail.com', 'abc__126', false);
insert into usuario (sCorreo, sContrasenia, bActivo) values ('abc127@gmail.com', 'abc__127', true);
insert into usuario (sCorreo, sContrasenia, bActivo) values ('abc128@gmail.com', 'abc__128', true);
insert into cliente (sCorreo, sNombre, calle, numero, colonia, ciudad, estado, sNumTelCel, sNumTelCasa)
 values ('abc126@gmail.com', 'Pupis Aguilar', 'Av. Sherman', 30, 'Las Lomas', 'San Andrés', 'Veracruz', '2711234567', '2734567898');
insert into cliente (sCorreo, sNombre, calle, numero, colonia, ciudad, estado, sNumTelCel, sNumTelCasa)
 values ('abc127@gmail.com', 'Viktor Aguilar', 'Av. Sherman', 30, 'Las Lomas', 'San Andrés', 'Veracruz', '2711234567', '2734567898');
insert into cliente (sCorreo, sNombre, calle, numero, colonia, ciudad, estado, sNumTelCel, sNumTelCasa)
 values ('abc128@gmail.com', 'Carmen Moya', 'Av. Veracruz', 18, 'Unidad Peñuela', 'Peñuela', 'Veracruz', '2713456712', '2790897656');


/*Para insertar Productos*/

INSERT INTO Productos (nClaveProducto,sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES (1,'Cheese cake', 1, 1, 'Pastel de queso y galletas oreo', 'Oreo',
'ck1.jpg', 300);
INSERT INTO Productos (sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES ('Galletas M&M´s', 2, 1, 'Paquete de galletas con chispas de M&M´s', 'M&M´s',
'gm1.jpg', 50);
INSERT INTO Productos (sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES ('Gelatina de piña con zanahoria', 3, 2, 'Gelatina de agua sabor piña con trozos de zanahoria',
'piña', 'gpz1.jpg', 72.50);
INSERT INTO Productos (sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES ('Mantecada de nuez', 4,1, 'Mantecada con nuez encima', 'Nuez',
'mn1.jpg', 25);
INSERT INTO Productos (sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES ('Pastel seco de vainilla', 1, 2, 'Pastel seco de sabor vainilla',
'Vainilla', 'pv1.jpg', 235.99);
INSERT INTO Productos (sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES ('Gelatina de fresa', 3, 3, 'Gelatina de fresa sin azúcar para diabéticos', 'Fresa',
'gsaf.jpg', 70);
INSERT INTO Productos (sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES ('Panqué de Chocolate', 4, 3, 'Panqué de chocolate sin azúcar', 'Chocolate',
'pcsa.jpg', 85);
INSERT INTO Productos (sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES ('Galleta de mantequilla', 2, 4, 'Galleta de mantequilla vegana', 'Mantequilla',
'gveman.jpg', 40);
INSERT INTO Productos (sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES ('Panqué sabor vainilla', 4, 2, 'Panqué sabor vainilla bajo en azúcar', 'Vainilla',
'pdiet.jpg', 87);
INSERT INTO Productos (sNombre, nLinea, nTipo, sDescripcion, sSabor, sImagen,
sPrecio) VALUES ('Panqué sabor fresa', 4, 2, 'Panqué sabor fresa bajo en azúcar', 'Fresa',
'pdiete.jpg', 87);

/*Creación de usuario y otorgar permisos*/

CREATE USER 'pasteleria2022'@'localhost' IDENTIFIED BY 'pasteleria2022pwd';

GRANT select, insert, delete, update ON usuario TO 'pasteleria2022'@'localhost';
GRANT select, insert, delete, update ON empleado TO 'pasteleria2022'@'localhost';
GRANT select, insert, delete, update ON cliente TO 'pasteleria2022'@'localhost';
GRANT select, insert, delete, update ON compra TO 'pasteleria2022'@'localhost';
GRANT select, insert, delete, update ON detallecompra TO 'pasteleria2022'@'localhost';
GRANT select, insert, delete, update ON productos TO 'pasteleria2022'@'localhost';
