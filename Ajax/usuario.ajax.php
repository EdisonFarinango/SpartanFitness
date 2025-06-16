<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Modelo/usuario.modelo.php';

session_start();
$usuario = new Usuario();

switch ($_GET['op']) {
    case 'login':
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];

        $data = $usuario->login($correo);

        if ($data && $data->num_rows > 0) {
            $user = $data->fetch_assoc();
            // Sin hash, compara directamente
            if ($clave === $user['clave']) {
                $_SESSION['id_usuario'] = $user['id'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['rol'] = $user['rol']; // nombre del rol desde JOIN
                echo $user['rol'];
            } else {
                echo "0";
            }
        } else {
            echo "0";
        }
        break;

    default:
        echo "Operación no soportada.";
        break;
}
?>
