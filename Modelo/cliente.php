<?php
require_once '../Config/conexion.php';

class Cliente {
    public function __construct() {}

    public function buscarClientePorCedula($cedula) {
        $sql = "SELECT id, cedula, nombres, apellidos FROM clientes WHERE cedula = '$cedula' LIMIT 1";
        $result = ejecutarConsultaSP($sql);
        return $result->num_rows > 0 ? $result->fetch_assoc() : false;
    }

    public function registrar($cedula, $nombres, $apellidos, $telefono, $correo) {
        $sql = "INSERT INTO clientes (cedula, nombres, apellidos, telefono, correo) 
                VALUES ('$cedula', '$nombres', '$apellidos', '$telefono', '$correo')";
        return ejecutarConsultaSP($sql);
    }

    public function ultimoInsertado() {
        global $conn;
        return $conn->insert_id;
    }
}