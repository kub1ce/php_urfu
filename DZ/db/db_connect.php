<?php
function parse_env($path) {
    $res = [];
    if (!file_exists($path)) return $res;

    $lines = file($path, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line),'#') === 0) continue;
        if (!strpos($line,'=')) continue;
        [$k,$v] = explode('=', $line, 2);
        $res[trim($k)] = trim($v);
    }
    return $res;
}

function connectDB(){
    $env = parse_env(__DIR__ . '/../.env');
    $host = $env['DB_HOST'] ?? '';
    $port = $env['DB_PORT'] ?? '5432';
    $dbname = $env['DB_NAME'] ?? 'wishlist';
    $user = $env['DB_USER'] ?? 'postgres';
    $pass = $env['DB_PASS'] ?? '';
    
    $link = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    
    try {
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    
    return $link;
}