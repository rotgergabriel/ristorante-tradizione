<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Accesso al Sistema</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/style/style.css">
</head>

<body class="cuerpo-login">
    <div class="contenedor-principal">
        <div class="caja-login">
            <h1 class="titulo-login">Area Riservata</h1>

            <form action="<?php echo BASE_URL; ?>loginController" method="POST" class="formulario-login">

                <p class="campo-contenedor">
                    <label for="user_name" class="etiqueta-login">Utente</label>
                    <input type="text" name="user_name" id="user_name" class="input-login" required autofocus>
                </p>

                <p class="campo-contenedor">
                    <label for="user_pass" class="etiqueta-login">Password</label>
                    <input type="password" name="user_pass" id="user_pass" class="input-login" required>
                </p>

                <p class="boton-contenedor">
                    <input type="submit" name="wp-submit" class="boton-primario" value="Accedi">
                </p>

                <p class="enlace-olvido">
                    <a href="<?php echo BASE_URL ?>" class="enlace-secundario">← Torna alla Home</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>