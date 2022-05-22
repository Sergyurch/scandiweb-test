<?php

namespace Core;

use Project\Exceptions\DbException;

class Database
{
    private static $dbConnection;

    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/project/config/db.php';

        if (!self::$dbConnection) {
            try {
                self::$dbConnection = new \PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                    DB_USER,
                    DB_PASS
                );
                self::$dbConnection->exec('SET NAMES UTF8');
            } catch (\PDOException $e) {
                throw new DbException('Database connection error');
            }
        }
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $sth = self::$dbConnection->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public function getLastInsertId(): int
    {
        return (int) self::$dbConnection->lastInsertId();
    }
}
