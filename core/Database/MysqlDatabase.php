<?php


namespace Core\Database;

use PDO;

class MysqlDatabase implements DatabaseInterface
{
    private $pdo;

    public function __construct(string $dsn, string $user, string $password)
    {
        $this->pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function query(string $statement, array $params = [], bool $one = false)
    {
        $query = $this->pdo->prepare($statement);
        $query->execute($params);
        if ($one) {
            return $query->fetch();
        }
        return $query->fetchAll();
    }

    public function execute(string $statement, array $params = [])
    {
        $query = $this->pdo->prepare($statement);
        $query->execute($params);
    }
}