CREATE DATABASE IF NOT EXISTS portafolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portafolio_db;

-- Tabla para información del perfil (Inicio y Acerca de mí)
CREATE TABLE IF NOT EXISTS perfil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(150) NOT NULL,
    foto_perfil VARCHAR(255) DEFAULT 'assets/perfil.jpg',
    descripcion_corta TEXT,
    presentacion TEXT,
    bio_amplia TEXT,
    intereses TEXT,
    habilidades TEXT,
    experiencia TEXT,
    email VARCHAR(100),
    telefono VARCHAR(50),
    redes_sociales TEXT
);

-- Tabla para Atestados Académicos
CREATE TABLE IF NOT EXISTS atestados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    institucion VARCHAR(150) NOT NULL,
    anio VARCHAR(10) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255)
);

-- Tabla para la Galería de Fotos
CREATE TABLE IF NOT EXISTS galeria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    imagen VARCHAR(255) NOT NULL,
    categoria ENUM('personal', 'academica', 'proyecto') DEFAULT 'personal'
);

-- Datos iniciales de prueba para el perfil
INSERT INTO perfil (nombre_completo, descripcion_corta, presentacion, bio_amplia, intereses, habilidades, experiencia, email, telefono) 
VALUES (
    'Tu Nombre Completo',
    'Estudiante de Ingeniería / Desarrollo Web',
    'Bienvenido a mi portafolio personal y blog básico.',
    'Apasionado por la tecnología, desarrollo de software y sistemas.',
    'Programación, Redes, Base de datos',
    'HTML, CSS, PHP, MySQL, Java',
    'Conocimientos en entorno LAMP, desarrollo web y configuración de redes.',
    'correo@ejemplo.com',
    '+506 8888-8888'
);