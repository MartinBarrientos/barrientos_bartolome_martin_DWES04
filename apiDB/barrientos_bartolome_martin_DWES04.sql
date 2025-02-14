CREATE DATABASE IF NOT EXISTS barrientos_bartolome_martin_DWES04;
USE barrientos_bartolome_martin_DWES04;
SET FOREIGN_KEY_CHECKS=0;
CREATE TABLE articulos(
    id_articulo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(150),
    precio DECIMAL(10,2) NOT NULL
);
CREATE TABLE specs(
    id_articulo INT PRIMARY KEY,
    stock INT NOT NULL DEFAULT 0,
    categoria VARCHAR(25),
    disponible BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_articulo) REFERENCES articulos(id_articulo) ON DELETE CASCADE
);

INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Teclado Mecánico', 'teclado mecanico retroiluminado NGS', 29.99);
INSERT INTO specs(id_articulo, stock, categoria, disponible)
VALUES(LAST_INSERT_ID(), 15, 'periferico', true);

-- insertamos datos
INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Mouse Inalámbrico', 'Mouse ergonómico y recargable', 15.51);
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 100,'periferico', true);

INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Monitor LED', 'Monitor Full HD 24 pulgadas',120.99);
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 52,'periferico', false);

INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Silla gamer', 'Silla ergonomica ajustable', 230.49 );
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 8, 'confort', true );

INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Microfono USB', 'Microfono condensador Podcast', 123.50);
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 45, 'accesorios', true);

INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Camara Web', 'Camara full HD para videollamadas',29.99);
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 23,'accesorios', true);

INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Cable HDMI', 'cable hdmi 2M', 18.49 );
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 100,'accesorios', true);
INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Xiaomi TV', '65pulgadas 4k',999.99 );
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 25, 'equipos',true );

INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Portatil HP', '256SSD, 8GB ram 15', 1499.99);
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 15,'equipos',true );

INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Torre Acer', 'rtx2060, 16gb ram, i7 8500K',2121.00 );
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 30 , 'equipos', false);
INSERT INTO articulos(nombre, descripcion, precio)
VALUES ('Torre HP', 'rtx4060, 32gb ram, i7 8500K',3000.00 );
INSERT INTO specs(id_articulo, stock,categoria, disponible)
VALUES(LAST_INSERT_ID(), 10 , 'equipos', true);
SET FOREIGN_KEY_CHECKS=1;
