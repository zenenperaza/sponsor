<?php
// Configuración de la base de datos
$host = 'localhost';
$db   = 'd3';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Obtener todas las personas
$stmt = $pdo->query("SELECT id, nombre, padre_id, foto, email, descripcion FROM usuarios"); // Incluir email y descripcion
$usuarios = $stmt->fetchAll();

// Indexar por id
$indexed = [];
foreach ($usuarios as $usuario) {
    $usuario['children'] = []; // Para D3, los nodos hijos se guardarán en 'children'
    $indexed[$usuario['id']] = $usuario;
}

// Construir el árbol
$root = null;
foreach ($indexed as $id => $usuario) {
    if ($usuario['padre_id'] === null) {
        // Nodo raíz
        $root = &$indexed[$id];
    } else {
        // Agregar como hijo al nodo padre
        $indexed[$usuario['padre_id']]['children'][] = &$indexed[$id];
    }
}

// Enviar el árbol en formato JSON
header('Content-Type: application/json');
echo json_encode($root);
?>