<?php
require_once '../Config/conexion.php';

class Usuario {
    public function __construct() {}

    public function login($correo) {
        $sql = "SELECT u.id, u.nombre, u.clave, r.nombre AS rol 
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id
                WHERE u.correo = ?";

        $conn = Fn_getConnect();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        $conn->close();

        return $result;
    }
}
?>
