CREATE DATABASE tienda_master;

USE tienda_master;

CREATE TABLE usuarios (	
id           int(12) auto_increment not null,
nombre       varchar(100) not null, 
apellidos    varchar(100),
email        varchar(100) not null, 
password     varchar(100) not null,
rol          varchar(20) ,
image        varchar(255),


CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDB;


INSERT INTO usuarios VALUES (NULL,'admin','admin','admin@admin.com','admin','admin',null)

CREATE TABLE categorias (	
id           int(12) auto_increment not null,
nombre        varchar(100) not null,
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDB;

INSERT INTO categorias VALUES(NULL,'Manga corta');

INSERT INTO categorias VALUES(NULL,'Manga larga');

INSERT INTO categorias VALUES(NULL,'Tirantes');

CREATE TABLE productos (	

id              int(12) auto_increment not null,
categoria_id     int(100) not null,
nombre           varchar(100,) not null,
descripcion      text,
precio           float(8,2) not null,
stock            int(100)    not null,
oferta           varchar(2),
fecha            date not null,
image            varchar(255),

CONSTRAINT pk_productos PRIMARY KEY(id),
CONSTRAINT fk_producto_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id)   
)ENGINE=InnoDB;



CREATE TABLE pedidos (	

id           int(12) auto_increment not null,
usuario_id   int(100) not null,
provincia    varchar(100) not null,
localidad    varchar(100) not null,
direccion    varchar(100) not null,
coste        float(200,2) not null,
estado       varchar(20) not null,
fecha        date,
hora         time,


CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedidos_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)   --ON DELETE CACADE  (OPCIONAL)
)ENGINE=InnoDB;



CREATE TABLE lineas_pedidos (	

id           int(12) auto_increment not null,
pedido_id    int(100) not null,
producto_id  int(100) not null,
unidades     int(255) not null,

CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
CONSTRAINT fk_lineas_pedidos_pedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_lineas_pedidos_producto FOREIGN KEY (producto_id) REFERENCES productos(id)   
)ENGINE=InnoDB;






