<?php
session_start(); // 🟢 Iniciamos sesión en todas las páginas

// 🛡️ Validación: si no hay sesión activa y no estás en login o procesar_login → redirige
$page = $_GET['page'] ?? '';

$paginas_sin_login = ['login', 'procesar_login', 'registro', 'guardar'];

$page = $_GET['page'] ?? '';





if (!isset($_SESSION['usuario']) && !in_array($page, $paginas_sin_login)) {
    header("Location: index.php?page=login");
    exit;
}

// 🚦 Cargar el enrutador principal
require_once "router.php";
