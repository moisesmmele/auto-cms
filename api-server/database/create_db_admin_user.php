<?php

use Dotenv\Dotenv;

require_once "../vendor/autoload.php";

Dotenv::createImmutable("../.")->load();

$db_username = $_ENV['DB_USER'];
$db_password = $_ENV['DB_PASSWORD'];
$db_name = $_ENV['DB_NAME'];
$db_host = $_ENV['DB_HOST'];
$db_port = $_ENV['DB_PORT'];
$db_driver = $_ENV['DB_DRIVER'];
$db_charset = $_ENV['DB_CHARSET'];
$app_email = $_ENV['APP_ADMIN_EMAIL'];
$app_password = $_ENV['APP_ADMIN_PASSWORD'];
$first_name = 'Administrator';
$last_name = $_ENV['APP_NAME'];

$hashed_password = password_hash($app_password, PASSWORD_DEFAULT);
$token = 'EXPIRED_TOKEN';

$pdo = new PDO("{$db_driver}:host={$db_host};dbname={$db_name}", $db_username, $db_password);

$sql = "insert into users (first_name, last_name, email, password, token) 
            values (:first_name, :last_name, :email, :password, :token)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':first_name', $first_name);
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':email', $app_email);
$stmt->bindParam(':password', $hashed_password);
$stmt->bindParam(':token', $token);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    return true;
} else {
    return false;
}