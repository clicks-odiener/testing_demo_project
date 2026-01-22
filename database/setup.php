<?php

require_once __DIR__ . '/../vendor/autoload.php';

echo "=== Database Setup ===\n\n";

// Load database configuration
$config = require __DIR__ . '/../config/database.php';

try {
    // Connect to MySQL without specifying a database first
    $dsn = sprintf(
        'mysql:host=%s;port=%d;charset=%s',
        $config['host'],
        $config['port'],
        $config['charset']
    );

    $pdo = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // Create database if it doesn't exist
    echo "Creating database '{$config['database']}' if not exists...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$config['database']}` CHARACTER SET {$config['charset']} COLLATE {$config['charset']}_unicode_ci");

    // Switch to the database
    $pdo->exec("USE `{$config['database']}`");
    echo "Database selected.\n\n";

    // Read and execute migration file
    $migrationFile = __DIR__ . '/migrations/001_create_products_table.sql';
    echo "Running migration: 001_create_products_table.sql...\n";

    $sql = file_get_contents($migrationFile);
    $pdo->exec($sql);

    echo "Migration completed successfully!\n\n";
    echo "=== Setup Complete ===\n";
    echo "Database: {$config['database']}\n";
    echo "Table: products created\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
