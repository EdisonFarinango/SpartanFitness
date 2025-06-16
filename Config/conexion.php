<?php
require_once "global.php";

// Función para obtener la conexión
function Fn_getConnect() {
    $conexion1 = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conexion1->connect_error) {
        die("Connection failed: " . $conexion1->connect_error);
    }
    return $conexion1;
}

// Función para ejecutar consultas sin cerrar la conexión automáticamente
function ejecutarConsultaSP($sql) {
    global $conn; // Usamos una variable global para mantener la conexión abierta
    if (!isset($conn)) {
        $conn = Fn_getConnect();
    }
    $query = $conn->query($sql);
    if (!$query) {
        die("Error en la consulta: " . $conn->error); // Mostrar errores de consulta
    }
    return $query;
}

// Función para cerrar la conexión manualmente cuando sea necesario
function cerrarConexion() {
    global $conn;
    if (isset($conn)) {
        $conn->close();
    }
}
?>