<?php

$db = [
    'host' => 'localhost',
    'port' => '5432',
    'user' => 'revenoir',
    'password' => 'revenoir',
    'dbname' => 'guestbook',
];

$db_options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "pgsql:host={$db['host']};dbname={$db['dbname']}";

try {
    $conn = new PDO($dsn, $db['user'], $db['password'], $db_options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
