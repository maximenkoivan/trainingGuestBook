<?php

namespace App\services;

use PDOException;
use PDO;

/**
 * Wrapper class for working with PDO.
 *
 * - getInstance()      -Returns an instance of the class.
 * - query()            -Processes an SQL query.
 * - getResult()        -Returns the result of an SQL query as an array.
 */
class Database
{
    /**
     * @var object|null
     */
    private static object|null $instance = null;
    /**
     * @var PDO
     */
    private PDO $pdo;
    /**
     * @var array
     */
    private array $result = [];

    private function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=guest_book', 'root', 'root');
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    /**
     * @return object|null
     */
    public static function getInstance(): object|null
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * @param string $sql
     * @param array|null $params
     * @return object
     */
    public function query(string $sql, array $params = null): object
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        $this->result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }
}