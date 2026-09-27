<?php
require_once 'conexion/conexion.php';

// Consultar datos de perfil
$res_perfil = $conexion->query("SELECT * FROM perfil LIMIT 1");
$perfil = $res_perfil->fetch_assoc();

// Consultar atestados
$res_atestados = $conexion->query("SELECT * FROM atestados ORDER BY anio DESC");

// Consultar galería
$res_galeria = $conexion->query("SELECT * FROM galeria");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $perfil['nombre_completo'] ?? 'Portafolio Personal'; ?></title>
    <link rel="stylesheet" href="assets/estilos.css">
</head>
<body>

<header>
    <h1><?php echo $perfil['nombre_completo'] ?? 'Mi Nombre'; ?></h1>
    <p><?php echo $perfil['descripcion_corta'] ?? 'Descripción corta'; ?></p>
</header>

<nav>
    <a href="#inicio">Inicio</a>
    <a href="#acerca">Acerca de mí</a>
    <a href="#atestados">Atestados</a>
    <a href="#galeria">Galería</a>
    <a href="#contacto">Contacto</a>
</nav>

<div class="container">

    <!-- Sección Inicio -->
    <section id="inicio">
        <h2>Inicio</h2>
        <div class="profile-card">
            <img src="<?php echo $perfil['foto_perfil'] ?? 'assets/perfil.jpg'; ?>" alt="Foto de perfil">
            <div>
                <h3><?php echo $perfil['nombre_completo']; ?></h3>
                <p><?php echo $perfil['presentacion']; ?></p>
            </div>
        </div>
    </section>

    <!-- Sección Acerca de mí -->
    <section id="acerca">
        <h2>Acerca de mí</h2>
        <p><strong>Biografía:</strong> <?php echo $perfil['bio_amplia']; ?></p>
        <br>
        <p><strong>Intereses:</strong> <?php echo $perfil['intereses']; ?></p>
        <p><strong>Habilidades:</strong> <?php echo $perfil['habilidades']; ?></p>
        <p><strong>Experiencia / Conocimientos:</strong> <?php echo $perfil['experiencia']; ?></p>
    </section>

    <!-- Sección Atestados Académicos -->
    <section id="atestados">
        <h2>Atestados Académicos</h2>
        <div class="grid">
            <?php if ($res_atestados && $res_atestados->num_rows > 0): ?>
                <?php while ($atestado = $res_atestados->fetch_assoc()): ?>
                    <div class="card">
                        <h3><?php echo $atestado['titulo']; ?></h3>
                        <p><strong>Institución:</strong> <?php echo $atestado['institucion']; ?> (<?php echo $atestado['anio']; ?>)</p>
                        <p><?php echo $atestado['descripcion']; ?></p>
                        <?php if ($atestado['imagen']): ?>
                            <img src="<?php echo $atestado['imagen']; ?>" alt="Certificado">
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No se han registrado atestados aún.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Sección Galería -->
    <section id="galeria">
        <h2>Galería</h2>
        <div class="grid">
            <?php if ($res_galeria && $res_galeria->num_rows > 0): ?>
                <?php while ($item = $res_galeria->fetch_assoc()): ?>
                    <div class="card">
                        <img src="<?php echo $item['imagen']; ?>" alt="<?php echo $item['titulo']; ?>">
                        <p><?php echo $item['titulo']; ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay imágenes en la galería.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Sección Contacto -->
    <section id="contacto">
        <h2>Contacto</h2>
        <p><strong>Email:</strong> <?php echo $perfil['email']; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $perfil['telefono']; ?></p>
        <p><strong>Redes Sociales:</strong> <?php echo $perfil['redes_sociales'] ?? 'No registradas'; ?></p>
    </section>

</div>

</body>
</html>