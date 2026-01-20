<?php

return [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'port' => getenv('DB_PORT') ?: 3306,
    'database' => getenv('DB_NAME') ?: 'product_db',
    'username' => getenv('DB_USER') ?: 'php',
    'password' => getenv('DB_PASSWORD') ?: 'php',
    'charset' => 'utf8mb4',
];
