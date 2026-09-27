<?php
require_once 'conexion/conexion.php';

$mensaje = "";

// Guardar/Actualizar Perfil
if (isset($_POST['guardar_perfil'])) {
    $nombre = $_POST['nombre_completo'];
    $desc_corta = $_POST['descripcion_corta'];
    $presentacion = $_POST['presentacion'];
    $bio = $_POST['bio_amplia'];
    $intereses = $_POST['intereses'];
    $habilidades = $_POST['habilidades'];
    $experiencia = $_POST['experiencia'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $redes = $_POST['redes_sociales'];

    // Manejo de foto de perfil
    $foto_sql = "";
    if (!empty($_FILES['foto_perfil']['name'])) {
        $ruta_foto = 'uploads/' . time() . '_' . $_FILES['foto_perfil']['name'];
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $ruta_foto);
        $foto_sql = ", foto_perfil='$ruta_foto'";
    }

    $sql = "UPDATE perfil SET 
            nombre_completo='$nombre', 
            descripcion_corta='$desc_corta', 
            presentacion='$presentacion', 
            bio_amplia='$bio', 
            intereses='$intereses', 
            habilidades='$habilidades', 
            experiencia='$experiencia', 
            email='$email', 
            telefono='$telefono', 
            redes_sociales='$redes' 
            $foto_sql WHERE id=1";

    if ($conexion->query($sql)) {
        $mensaje = "Perfil actualizado correctamente.";
    }
}

// Agregar Atestado
if (isset($_POST['agregar_atestado'])) {
    $titulo = $_POST['titulo'];
    $inst = $_POST['institucion'];
    $anio = $_POST['anio'];
    $desc = $_POST['descripcion'];
    
    $img_ruta = "";
    if (!empty($_FILES['imagen']['name'])) {
        $img_ruta = 'uploads/' . time() . '_' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], $img_ruta);
    }

    $conexion->query("INSERT INTO atestados (titulo, institucion, anio, descripcion, imagen) VALUES ('$titulo', '$inst', '$anio', '$desc', '$img_ruta')");
    $mensaje = "Atestado agregado con éxito.";
}

// Agregar a Galería
if (isset($_POST['agregar_galeria'])) {
    $titulo_g = $_POST['titulo_galeria'];
    $cat = $_POST['categoria'];

    if (!empty($_FILES['imagen_galeria']['name'])) {
        $img_g_ruta = 'uploads/' . time() . '_' . $_FILES['imagen_galeria']['name'];
        move_uploaded_file($_FILES['imagen_galeria']['tmp_name'], $img_g_ruta);
        $conexion->query("INSERT INTO galeria (titulo, imagen, categoria) VALUES ('$titulo_g', '$img_g_ruta', '$cat')");
        $mensaje = "Imagen agregada a la galería.";
    }
}

$perfil = $conexion->query("SELECT * FROM perfil WHERE id=1")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="assets/estilos.css">
</head>
<body>

<header>
    <h1>Panel de Administración</h1>
    <a href="index.php" style="color: #a3e635;">← Volver al sitio público</a>
</header>

<div class="container">
    <?php if ($mensaje): ?>
        <p style="background: #22c55e; color: white; padding: 10px; border-radius: 6px; margin-bottom: 20px;"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <!-- Editar Perfil -->
    <section>
        <h2>Editar Información Personal</h2>
        <form method="POST" enctype="multipart/form-data" class="admin-form">
            <label>Nombre Completo:</label>
            <input type="text" name="nombre_completo" value="<?php echo $perfil['nombre_completo']; ?>" required>

            <label>Foto de Perfil:</label>
            <input type="file" name="foto_perfil" accept="image/*">

            <label>Descripción Corta:</label>
            <input type="text" name="descripcion_corta" value="<?php echo $perfil['descripcion_corta']; ?>">

            <label>Presentación:</label>
            <textarea name="presentacion" rows="3"><?php echo $perfil['presentacion']; ?></textarea>

            <label>Biografía Amplia:</label>
            <textarea name="bio_amplia" rows="4"><?php echo $perfil['bio_amplia']; ?></textarea>

            <label>Intereses:</label>
            <input type="text" name="intereses" value="<?php echo $perfil['intereses']; ?>">

            <label>Habilidades:</label>
            <input type="text" name="habilidades" value="<?php echo $perfil['habilidades']; ?>">

            <label>Experiencia / Conocimientos:</label>
            <textarea name="experiencia" rows="3"><?php echo $perfil['experiencia']; ?></textarea>

            <label>Correo Electrónico:</label>
            <input type="email" name="email" value="<?php echo $perfil['email']; ?>">

            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?php echo $perfil['telefono']; ?>">

            <label>Redes Sociales:</label>
            <input type="text" name="redes_sociales" value="<?php echo $perfil['redes_sociales']; ?>">

            <button type="submit" name="guardar_perfil" class="btn">Guardar Perfil</button>
        </form>
    </section>

    <!-- Agregar Atestado -->
    <section>
        <h2>Agregar Atestado Académico</h2>
        <form method="POST" enctype="multipart/form-data" class="admin-form">
            <label>Título / Certificación:</label>
            <input type="text" name="titulo" required>

            <label>Institución:</label>
            <input type="text" name="institucion" required>

            <label>Año:</label>
            <input type="text" name="anio" required>

            <label>Descripción:</label>
            <textarea name="descripcion" rows="3"></textarea>

            <label>Imagen del comprobante:</label>
            <input type="file" name="imagen" accept="image/*">

            <button type="submit" name="agregar_atestado" class="btn">Agregar Atestado</button>
        </form>
    </section>

    <!-- Agregar Galería -->
    <section>
        <h2>Agregar Foto a Galería</h2>
        <form method="POST" enctype="multipart/form-data" class="admin-form">
            <label>Título / Descripción de la foto:</label>
            <input type="text" name="titulo_galeria">

            <label>Categoría:</label>
            <select name="categoria">
                <option value="personal">Personal</option>
                <option value="academica">Académica</option>
                <option value="proyecto">Proyecto</option>
            </select>

            <label>Imagen:</label>
            <input type="file" name="imagen_galeria" accept="image/*" required>

            <button type="submit" name="agregar_galeria" class="btn">Subir a Galería</button>
        </form>
    </section>
</div>

</body>
</html>