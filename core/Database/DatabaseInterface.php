<?php


namespace Core\Database;


interface DatabaseInterface
{
    public function query(string $statement, array $params = [], bool $one);
}