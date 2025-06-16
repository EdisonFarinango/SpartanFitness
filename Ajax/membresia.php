<?php
// Mostrar errores durante desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '../Modelo/cliente.php';
require_once '../Modelo/membresia.php';

$cliente = new Cliente();
$membresia = new Membresia();

if ($_GET['op'] == 'tipos_membresia') {
    $result = $membresia->obtenerTiposMembresia();

    if (!$result) {
        http_response_code(500);
        echo json_encode(['error' => 'Error en consulta SQL']);
        exit;
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_GET['op'] == 'registrar') {
    // Datos del cliente
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'] ?? null;
    $correo = $_POST['correo'] ?? null;

    // Verificar si el cliente existe
    $clienteData = $cliente->buscarClientePorCedula($cedula);
    if (!$clienteData) {
        // Registrar cliente si no existe
        $resultado = $cliente->registrar($cedula, $nombres, $apellidos, $telefono, $correo);
        if (!$resultado) {
            echo json_encode(["status" => "error", "message" => "No se pudo registrar al cliente"]);
            exit;
        }
        $clienteId = $cliente->ultimoInsertado();
    } else {
        $clienteId = $clienteData['id'];
    }

    // Datos de membresía
    $tipoMembresiaId = $_POST['tipo_membresia'];
    $cantidadMeses = $_POST['cantidad_meses'];
    $metodoPago = $_POST['metodo_pago'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = date('Y-m-d', strtotime($fechaInicio . " + " . ($cantidadMeses * 30) . " days"));
    $usuarioId = $_SESSION['id'] ?? 1; // Asegúrate de tener esta variable de sesión

    // Obtener precio usado
    $tipoMem = $membresia->obtenerTipoMembresia($tipoMembresiaId);
    $precioUsado = $tipoMem['precio'] * $cantidadMeses;

    // Registrar membresía
    $resultadoMembresia = $membresia->registrar(
        $clienteId,
        $tipoMembresiaId,
        $fechaInicio,
        $fechaFin,
        $cantidadMeses,
        $metodoPago,
        $precioUsado,
        $usuarioId
    );

    if ($resultadoMembresia) {
        echo json_encode(["status" => "success", "message" => "Membresía registrada correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se pudo registrar la membresía"]);
    }
    exit;
}