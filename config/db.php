<?php
// For college project - using SQLite bootstrapped from SQL scripts instead of a stored .db file
$tempDbFile = sys_get_temp_dir() . '/fashion_hub.sqlite';
$sqlFiles = [
    __DIR__ . '/../database/fashion_hub_sqlite.sql',
    __DIR__ . '/../database/sample_data_sqlite.sql'
];

try {
    $pdo = new PDO("sqlite:$tempDbFile");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if (!file_exists($tempDbFile) || filesize($tempDbFile) === 0) {
        foreach ($sqlFiles as $sqlFile) {
            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                $pdo->exec($sql);
            }
        }
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>