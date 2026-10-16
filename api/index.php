<?php

// Prepare /tmp/storage folders for serverless Lambda execution
$dirs = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Copy pre-populated SQLite database to writable /tmp if using SQLite
if (getenv('DB_CONNECTION') === 'sqlite' || !getenv('DB_CONNECTION')) {
    $sqliteSource = __DIR__ . '/../database/database.sqlite';
    $sqliteTarget = '/tmp/database.sqlite';
    if (!file_exists($sqliteTarget) && file_exists($sqliteSource)) {
        @copy($sqliteSource, $sqliteTarget);
    }
}

// Forward Vercel serverless requests to Laravel's public entry point
require __DIR__ . '/../public/index.php';
