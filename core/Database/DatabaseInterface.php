<?php


namespace Core\Database;


interface DatabaseInterface
{
    public function query(string $statement, array $params = [], bool $one=false);
    public function execute(string $statement, array $params = []);
    public function getLastInsertId();
}