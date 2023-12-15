<?php
session_start();
if (isset($_SESSION['id_usuario']) && $_SESSION['nivel'] == 2) {
    $u_id = $_SESSION['id_usuario'];
    $usuario = $_SESSION['usuario'];
} else {
    header("location:index.php");
}
?>