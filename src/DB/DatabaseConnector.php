<?php

declare(strict_types=1);

namespace App\DB;

use App\Library\DotenvHelper;
use App\Library\Singleton\SingletonInterface;
use App\Library\Singleton\SingletonTrait;
use PDO;

class DatabaseConnector implements SingletonInterface
{
    use SingletonTrait;

    private ?PDO $connection;

    private function __construct()
    {
        DotenvHelper::loadEnvFiles();

        $dsn = 'mysql:host=' . getenv('DATABASE_CONTAINER_NAME') . ';dbname=' . getenv('DATABASE');

        $this->connection = new PDO(
            $dsn,
            getenv('DATABASE_USER'),
            getenv('DATABASE_PASSWORD'),
            [PDO::MYSQL_ATTR_LOCAL_INFILE => true]
        );
    }

    public function execute(string $query, array $params = []): mixed
    {
        $stmt = $this->connection->prepare($query);

        $result = $stmt->execute($params);
        if (false === $result) {
            return null;
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function executeWithConversionToClass(string $className, string $query, array $params = []): mixed
    {
        $stmt = $this->connection->prepare($query);

        $result = $stmt->execute($params);
        if (false === $result) {
            return null;
        }

        $stmt->setFetchMode(PDO::FETCH_CLASS, $className);

        return $stmt->fetch() ?: null;
    }
}
