-- Crear la tabla Marcas
CREATE TABLE Marcas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255)
);

-- Insertar datos de ejemplo
INSERT INTO Marcas (nombre, descripcion, imagen) VALUES
    ('Samsung', ' Innovación y calidad se unen en los productos Samsung, ofreciendo tecnología de vanguardia para satisfacer tus necesidades diarias. ¡Descubre el mundo Samsung!', 'images/Samsung.png'),
    ('Huawei', 'Huawei, sinónimo de innovación, presenta dispositivos tecnológicos de primera calidad que combinan diseño elegante y rendimiento excepcional.', 'images/Huawei.png'),
    ('Apple', 'La excelencia en diseño y tecnología define a Apple. Descubre productos que van más allá de las expectativas, fusionando estilo y funcionalidad.', 'images/Apple.png'),
    ('HP', 'HP, líder en tecnología, proporciona soluciones potentes y confiables para todas tus necesidades informáticas, desde portátiles hasta impresoras de última generación.', 'images/Hp.png'),
    ('Lenovo', 'Lenovo destaca por su compromiso con la innovación y la durabilidad. Descubre productos que impulsan la productividad y la creatividad.', 'images/Lenovo.png'),
    ('Dell', 'Dell ofrece tecnología que impulsa el progreso. Experimenta la potencia de la innovación con portátiles y dispositivos diseñados para el rendimiento.', 'images/Dell.png'),
    ('Asus', 'Asus redefine la excelencia en dispositivos electrónicos, desde portátiles hasta componentes para juegos. Descubre un mundo de posibilidades con Asus.', 'images/AsusL.png');


-- Crear la tabla Categorias
CREATE TABLE Categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255)
);

-- Insertar datos de ejemplo
INSERT INTO Categorias (nombre, descripcion, imagen) VALUES
    ('Celulares', 'Explora la última tecnología en telefonía móvil con nuestra selección de smartphones de vanguardia. Mantente conectado con estilo.', 'images/Telefonos.png'),
    ('Portátiles', 'Potencia y portabilidad se encuentran en nuestra colección de portátiles. Desde ultrabooks elegantes hasta máquinas de juego potentes.', 'images/Portatiles.png'),
    ('Componentes', 'Construye tu propia experiencia informática con nuestros componentes de alta calidad. Desde tarjetas madre hasta tarjetas gráficas, encuentra todo aquí.', 'images/Componentes.png');


-- Crear la tabla Productos
CREATE TABLE Productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    cantidad INT NOT NULL,
    id_marca INT,
    id_categoria INT,
    imagen VARCHAR(255),
    FOREIGN KEY (id_marca) REFERENCES Marcas(id),
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id)
);

-- Crear la tabla Carrito
CREATE TABLE Carrito (
    id INT PRIMARY KEY AUTO_INCREMENT,
    producto_id INT,
    usuario_id INT,
    cantidad INT,
    FOREIGN KEY (producto_id) REFERENCES Productos(id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
);

-- Agrega la columna seleccionados a la tabla Productos
ALTER TABLE Productos
ADD COLUMN seleccionados INT DEFAULT 0;


-- Celulares
INSERT INTO Productos (nombre, descripcion, precio, cantidad, id_marca, id_categoria, imagen) VALUES
    ('Samsung Galaxy S21', 'El Samsung Galaxy S21 es un teléfono inteligente de gama alta con potentes capacidades fotográficas, una pantalla vibrante y un rendimiento excepcional.', 899.99, 10, 1, 1, 'images/S21.png'),
    ('Samsung Galaxy A51', 'El Samsung Galaxy A51 combina un diseño elegante con características avanzadas, ofreciendo una experiencia de usuario equilibrada a un precio atractivo.', 399.99, 15, 1, 1, 'images/A51.png'),
    ('Huawei P40', 'El Huawei P40 presenta una impresionante configuración de cámara Leica, un diseño elegante y un rendimiento potente, ofreciendo una experiencia premium.', 799.99, 8, 2, 1, 'images/P40.png'),
    ('Huawei P30 Lite', ' El Huawei P30 Lite es una opción asequible con un diseño moderno y características sorprendentes, brindando un equilibrio perfecto entre rendimiento y precio.', 299.99, 12, 2, 1, 'images/P30.png'),
    ('iPhone 12', 'El iPhone 12 destaca por su potente chip A14 Bionic, su pantalla Super Retina XDR y su sistema de cámara avanzado, ofreciendo una experiencia de usuario excepcional.', 999.99, 12, 3, 1, 'images/Iphone12.png'),
    ('iPhone SE', 'El iPhone SE combina el icónico diseño del iPhone con un rendimiento potente, siendo una opción accesible para quienes buscan la experiencia iOS.', 499.99, 20, 3, 1, 'images/IphoneSE.png');

-- Portatiles
INSERT INTO Productos (nombre, descripcion, precio, cantidad, id_marca, id_categoria, imagen) VALUES
    ('HP Spectre x360', 'El HP Spectre x360 es un portátil 2 en 1 premium con un diseño elegante, una pantalla táctil de alta resolución y un rendimiento excepcional.', 1299.99, 5, 4, 2, 'images/HPSpectre.png'),
    ('HP Pavilion', 'La serie HP Pavilion ofrece portátiles asequibles sin comprometer el rendimiento, siendo ideales para tareas diarias y entretenimiento.', 799.99, 8, 4, 2, 'images/HPPavilion.png'),
    ('Lenovo ThinkPad X1 Carbon', 'El Lenovo ThinkPad X1 Carbon es conocido por su durabilidad y rendimiento empresarial, con un diseño delgado y ligero perfecto para profesionales en movimiento.', 1499.99, 7, 5, 2, 'images/LenovoTPad.png'),
    ('Lenovo Ideapad', 'El Lenovo Ideapad ofrece un equilibrio entre rendimiento y precio, siendo una opción versátil para usuarios que buscan un portátil funcional.', 599.99, 10, 5, 2, 'images/LenovoIdea.png'),
    ('Dell XPS 13', 'El Dell XPS 13 destaca por su diseño ultradelgado, una pantalla InfinityEdge y un rendimiento potente, ideal para usuarios exigentes.', 1399.99, 6, 6, 2, 'images/DellX.png'),
    ('Dell Inspiron', 'La serie Dell Inspiron ofrece portátiles versátiles y asequibles para una variedad de necesidades, desde tareas cotidianas hasta entretenimiento multimedia.', 899.99, 12, 6, 2, 'images/DellInspiron.png'),
    ('Asus ROG Zephyrus G14', 'El Asus ROG Zephyrus G14 es una potente computadora portátil para juegos con un diseño elegante y especificaciones de alto rendimiento para jugadores exigentes.', 1699.99, 4, 7, 2, 'images/Asus.png'),
    ('Asus VivoBook', 'El Asus VivoBook es una opción asequible con un diseño moderno, ofreciendo un rendimiento sólido para tareas diarias y entretenimiento.', 699.99, 15, 7, 2, 'images/AsusVivo.png');

-- Componentes
INSERT INTO Productos (nombre, descripcion, precio, cantidad, id_marca, id_categoria, imagen) VALUES
    ('Tarjeta madre ASUS ROG Strix B550', 'La tarjeta madre ASUS ROG Strix B550 es una opción premium con características avanzadas, diseñada para construcciones de PC de alto rendimiento.', 199.99, 15, 7, 3, 'images/TarjetaASUS.png'),
    ('Tarjeta madre MSI B450 TOMAHAWK', 'La tarjeta madre MSI B450 TOMAHAWK ofrece un equilibrio entre rendimiento y precio, siendo una opción popular para construcciones de PC de nivel medio.', 129.99, 10, 2, 3, 'images/TarjetaMSI.png'),
    ('Tarjeta de video NVIDIA GeForce RTX 3080', 'La tarjeta de video NVIDIA GeForce RTX 3080 proporciona un rendimiento gráfico excepcional para juegos y aplicaciones intensivas, con tecnologías de vanguardia.', 699.99, 8, 1, 3, 'images/TarjetaNVIDIA.png'),
    ('Tarjeta de video AMD Radeon RX 570', 'La tarjeta de video AMD Radeon RX 570 ofrece un rendimiento sólido para juegos a un precio atractivo, siendo una opción popular para jugadores en presupuestos ajustados.', 249.99, 12, 2, 3, 'images/TarjetaAMD.png'),
    ('Memoria RAM Corsair Vengeance LPX 16GB', 'La memoria RAM Corsair Vengeance LPX 16GB proporciona un rendimiento confiable y rápido, ideal para mejorar la velocidad y la capacidad de respuesta de tu sistema.', 79.99, 20, 1, 3, 'images/MemoriaRAMCorsair.png'),
    ('Memoria RAM Kingston HyperX Fury 8GB', 'La memoria RAM Kingston HyperX Fury 8GB ofrece un rendimiento eficiente a un precio atractivo, siendo una opción popular para actualizaciones de memoria.', 49.99, 25, 2, 3, 'images/MemoriaRAMKingston.png');


-- Crear la tabla Usuarios
CREATE TABLE Usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(50) NOT NULL,
    contrasena_hash VARCHAR(255) NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL,
    rol VARCHAR(20) NOT NULL
);

-- Insertar usuarios
-- Contrasenas 345, 567, 789, 111, 000
INSERT INTO Usuarios (nombre_usuario, contrasena_hash, nombre_completo, correo_electronico, rol)
VALUES ('Jerson Hernández Carvajal', '$2y$10$gFwGFW.Vg5DK0AQTOD9goeG7FFZLSN.8oZbdntJ83cnTvlNYtEQgm', 'Jerson Hernández Carvajal', 'jhernandez70629@ufide.ac.cr', 'admin');

INSERT INTO Usuarios (nombre_usuario, contrasena_hash, nombre_completo, correo_electronico, rol)
VALUES ('José Varela Méndez', '$2y$10$7G.IK8zOu1o5bmkcAzx7feOVgK.PZG/Yzr4vg2gDPfLFXCxEhD6Ra', 'José Varela Méndez', 'Jvarela90675@ufide.ac.cr', 'admin');

INSERT INTO Usuarios (nombre_usuario, contrasena_hash, nombre_completo, correo_electronico, rol)
VALUES ('Leonardo Reyes Vargas', '$2y$10$EBH2IKQzxqz2VgRP7/AIkOhqGyX4YL6efxlY9A8LrrNx8ObYJ3RcS', 'Leonardo Reyes Vargas', 'Lreyes70353@ufide.ac.cr', 'admin');

INSERT INTO Usuarios (nombre_usuario, contrasena_hash, nombre_completo, correo_electronico, rol)
VALUES ('Empleado1', '$2y$10$t4RTBf07MwCoq57WVvI.6OPjdbmTZI04tdcT7kA1cA06J5S2kOW7K', 'Empleado Guzman', 'empleado@ejemplo.com', 'empleado');

INSERT INTO Usuarios (nombre_usuario, contrasena_hash, nombre_completo, correo_electronico, rol)
VALUES ('Usuario1', '$2y$10$PZXJYahwMeA57olAIr7j6e6RLoZC5mFh9v7CMbKbXsZm9OQ31KjgS', 'Usuario Fernandez', 'usuario@ejemplo.com', 'usuario');