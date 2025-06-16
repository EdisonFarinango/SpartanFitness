<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Membresía - GymTech</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"  rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> 

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f0f2f5;
        }

        .card {
            border: none;
            border-radius: 1rem;
        }

        .btn-danger {
            background-color: #d63384;
            border-color: #d63384;
        }

        .btn-danger:hover {
            background-color: #ad2869;
            border-color: #ad2869;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(214, 51, 132, 0.25);
            border-color: #d63384;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">



<!-- Contenido Principal -->
<main class="flex-grow-1 py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white text-center">
                        <h4 class="mb-0"><i class="fas fa-id-card"></i> Registrar Membresía</h4>
                    </div>
                    <div class="card-body p-4">

                        <!-- Formulario -->
                        <form id="formRegistrarMembresia" class="needs-validation" novalidate>
                            <div class="row g-3">

                                <!-- Datos del Cliente -->
                                <div class="col-md-6">
                                    <label for="cedula" class="form-label">Cédula <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                        <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ej: 1234567890" required>
                                        <div class="invalid-feedback">Ingrese una cédula válida.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej: 0987654321">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="nombres" class="form-label">Nombres <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ej: Juan" required>
                                        <div class="invalid-feedback">Ingrese los nombres del cliente.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ej: Pérez" required>
                                        <div class="invalid-feedback">Ingrese los apellidos del cliente.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="correo" class="form-label">Correo Electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="correo" name="correo" placeholder="ejemplo@dominio.com">
                                    </div>
                                </div>

                                <!-- Datos de Membresía -->
                                <div class="col-md-6">
                                    <label for="tipo_membresia" class="form-label">Tipo de Membresía <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                        <select class="form-select" id="tipo_membresia" name="tipo_membresia" required>
                                            <option value="">Seleccione...</option>
                                            <!-- Opciones cargadas dinámicamente -->
                                        </select>
                                        <div class="invalid-feedback">Seleccione un tipo de membresía.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="precio_membresia" class="form-label">Precio por Mes</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" id="precio_membresia" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="cantidad_meses" class="form-label">Cantidad de Meses <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="number" class="form-control" id="cantidad_meses" name="cantidad_meses" min="1" value="1" required>
                                        <div class="invalid-feedback">Ingrese la cantidad de meses.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="total_pagar" class="form-label">Total a Pagar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" id="total_pagar" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="metodo_pago" class="form-label">Método de Pago <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
                                        <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                                            <option value="">Seleccione...</option>
                                            <option value="efectivo">Efectivo</option>
                                            <option value="transferencia">Transferencia</option>
                                        </select>
                                        <div class="invalid-feedback">Seleccione un método de pago.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="fecha_inicio" class="form-label">Fecha de Inicio <span class="text-danger">*</span></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                        <div class="invalid-feedback">Seleccione una fecha de inicio.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                        <input type="text" class="form-control" id="fecha_fin" readonly>
                                    </div>
                                </div>

                                <!-- Botón de registro -->
                                <div class="col-12 mt-4 d-grid gap-2">
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        <i class="fas fa-save me-2"></i> Registrar Membresía
                                    </button>
                                </div>

                            </div>
                        </form>
                        <!-- Fin del Formulario -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Pie de página -->
<footer class="bg-light py-3 mt-auto text-center">
    <p class="mb-0">© 2025 GymTech - Sistema de Gestión de Membresías</p>
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<!-- Script Personalizado -->
<script src="../Vista/Js/membresia.js"></script>

</body>
</html>