<?php

use Dotenv\Dotenv;

require_once "../vendor/autoload.php";

Dotenv::createImmutable(__DIR__)->safeLoad();

$db_username = $_ENV['DB_USER'] ?? null;
$db_password = $_ENV['DB_PASSWORD'] ?? null;
$db_name = $_ENV['DB_NAME'] ?? null;
$db_host = $_ENV['DB_HOST'] ?? 'localhost';
$db_port = $_ENV['DB_PORT'] ?? 3306;
$db_driver = $_ENV['DB_DRIVER'] ?? 'mysql';
$db_charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

$app_email = $_ENV['APP_ADMIN_EMAIL'] ?? null;
$app_password = $_ENV['APP_ADMIN_PASSWORD'] ?? null;
$first_name = 'Administrator';
$last_name = $_ENV['APP_NAME'] ?? 'App';

if (!$db_username || !$db_password || !$db_name || !$app_email || !$app_password) {
    return false; // Required env vars missing
}

$hashed_password = password_hash($app_password, PASSWORD_DEFAULT);
$token = 'EXPIRED_TOKEN';

try {
    $dsn = "{$db_driver}:host={$db_host};port={$db_port};dbname={$db_name};charset={$db_charset}";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    $pdo = new PDO($dsn, $db_username, $db_password, $options);

    // Check if user already exists
    $checkSql = "SELECT COUNT(*) FROM users WHERE email = :email";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->bindParam(':email', $app_email);
    $checkStmt->execute();
    $userExists = $checkStmt->fetchColumn();

    if ($userExists) {
        // User already exists, do not create again
        return false;
    }

    // Insert new user
    $sql = "INSERT INTO users (first_name, last_name, email, password, token) 
            VALUES (:first_name, :last_name, :email, :password, :token)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $app_email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':token', $token);

    $stmt->execute();

    return $stmt->rowCount() > 0;
} catch (PDOException $e) {
    // Optionally log error: error_log($e->getMessage());
    return false;
}
