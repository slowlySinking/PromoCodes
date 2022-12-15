<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\DB\DatabaseConnector;

$prefix = strtoupper($argv[1] ?? generatePrefix());
$promoCodesCnt = $argv[2] ?? 500000;

$dbConnector = DatabaseConnector::getInstance();

$startTime = microtime(true);

insertPromoCodes($dbConnector);

$endTime = microtime(true);

echo PHP_EOL;
echo 'Execution time: ' . $endTime - $startTime . 'seconds';
echo PHP_EOL;
echo 'Memory peak: ' . (memory_get_peak_usage(true) / 1024 / 1024) . 'MB';
echo PHP_EOL;

function generatePrefix(): string
{
    $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = str_shuffle($string);

    return substr($string, 0, 4);
}

function insertPromoCodes(DatabaseConnector $connector): void
{
    $fileName = 'promo_codes.csv';
    $file = fopen($fileName, 'w');

    fputcsv($file, ['id', 'code', 'issue_date']);

    foreach (generatePromoRows() as $row) {
        fputcsv($file, $row);
    }

    fclose($file);

    $sql = "LOAD DATA LOCAL INFILE 'promo_codes.csv' INTO TABLE promo_code
        FIELDS TERMINATED BY ','
        ENCLOSED BY '\"'
        LINES TERMINATED BY '\n'
        IGNORE 1 LINES
        (id, code)";

    $connector->execute($sql);

    unlink($fileName);
}

function generatePromoRows(): Generator
{
    global $prefix, $promoCodesCnt;

    for ($i = 1; $i <= $promoCodesCnt; $i++) {
        $k = (string)$i;
        yield [
            null,
            $prefix . substr_replace('000000', $k, -(strlen($k))),
            null
        ];
    }
}
