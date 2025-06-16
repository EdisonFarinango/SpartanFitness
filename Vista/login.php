<?php
session_start();

// Si ya hay sesión iniciada, evitar acceso a login
if (isset($_SESSION['id_usuario'])) {
    // Redirigir al dashboard o página principal
    header("Location: index.php");  // Cambia 'dashboard.php' por la ruta real
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - Spartan Fitness</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"  rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> 

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        header {
            background-color: #C62828;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .form-title {
            font-weight: bold;
            color: #0D47A1;
        }

        form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: #C62828;
            color: white;
        }

        .btn-custom:hover {
            background-color: #b71c1c;
        }

        footer {
            background-color: #263238;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: auto;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Encabezado con Logo -->
<header class="text-white py-3 text-center">
    <div class="logo-container mb-2">
        <img src="../Public/logo.png" alt="Logo del Gimnasio" width="60" height="60" class="me-2 rounded-circle">
        <h4 class="mb-0">🏋️ Spartan Fitness</h4>
    </div>
    <p class="mb-0">Sistema de Gestión para Gimnasios</p>
</header>

<!-- Contenido Principal -->
<main class="flex-grow-1 d-flex align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form id="formularioLogin" class="needs-validation" novalidate>
                    <h3 class="text-center form-title mb-4">Iniciar Sesión</h3>

                    <!-- Campo: Correo -->
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" required>
                        <div class="invalid-feedback">Ingrese un correo válido.</div>
                    </div>

                    <!-- Campo: Contraseña -->
                    <div class="input-group mb-3 position-relative">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required>
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                        <div class="invalid-feedback">Ingrese su contraseña.</div>
                    </div>

                    <!-- Botón Ingresar -->
                    <button type="submit" class="btn btn-custom w-100 mt-3">Iniciar Sesión</button>

                    <!-- Registro -->
                    <div class="mt-3 text-center">
                        <a href="register.php" class="text-muted small">¿No tienes cuenta? Regístrate aquí</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Pie de página -->
<footer>
    <p class="mb-0">&copy; 2025 FitEcuador Gym - Todos los derechos reservados</p>
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="../Vista/Js/login.js"></script>

<!-- Script para mostrar/ocultar contraseña -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('clave');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

</body>
</html>