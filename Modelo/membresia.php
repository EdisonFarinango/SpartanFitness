<?php
require_once '../Config/conexion.php';

class Membresia {
    public function __construct() {}

    public function obtenerTiposMembresia() {
        $sql = "SELECT id, nombre, descripcion, duracion_dias, precio FROM tipos_membresia WHERE estado = 1";
        return ejecutarConsultaSP($sql);
    }

    public function obtenerTipoMembresia($id) {
        $sql = "SELECT id, nombre, descripcion, duracion_dias, precio FROM tipos_membresia WHERE id = '$id' AND estado = 1";
        $result = ejecutarConsultaSP($sql);
        return $result->fetch_assoc();
    }

    public function registrar($cliente_id, $tipo_membresia_id, $fecha_inicio, $fecha_fin, $cantidad_meses, $metodo_pago, $precio_usado, $usuario_id) {
        $sql = "INSERT INTO membresias (
                    cliente_id, tipo_membresia_id, fecha_registro, fecha_inicio, fecha_fin, 
                    cantidad_meses, metodo_pago, precio_usado, usuario_id
                ) VALUES (
                    '$cliente_id', '$tipo_membresia_id', NOW(), '$fecha_inicio', '$fecha_fin',
                    '$cantidad_meses', '$metodo_pago', '$precio_usado', '$usuario_id'
                )";
        return ejecutarConsultaSP($sql);
    }

    
}