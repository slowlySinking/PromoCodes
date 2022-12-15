<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\DB\Config;
use App\DB\DatabaseConnector;

$dbConnector = DatabaseConnector::getInstance();
$databaseSchema = Config::getDatabaseSchema();

dropTables($dbConnector, $databaseSchema);
createTables($dbConnector, $databaseSchema);

function dropTables(DatabaseConnector $dbConnector, array $databaseSchema): void
{
    foreach (array_reverse($databaseSchema) as $table) {
        $dbConnector->execute("DROP TABLE IF EXISTS $table");
    }
}

function createTables(DatabaseConnector $dbConnector, array $databaseSchema): void
{
    foreach ($databaseSchema as $table) {
        $sql = file_get_contents(__DIR__ . '/../DB/tables/' . $table . '.sql');
        $dbConnector->execute($sql);
    }
}
