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
    die(json_encode(['success' => false, 'message' => "Error en la conexión: " . $e->getMessage()]));
}

// Obtener datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$descripcion = $_POST['descripcion'];

// Actualizar datos en la base de datos
$stmt = $pdo->prepare("UPDATE personas SET nombre = ?, email = ?, descripcion = ? WHERE id = ?");
try {
    $stmt->execute([$nombre, $email, $descripcion, $id]);
    echo json_encode(['success' => true]);
} catch (\PDOException $e) {
    echo json_encode(['success' => false, 'message' => "Error al actualizar usuario: " . $e->getMessage()]);
}
?>