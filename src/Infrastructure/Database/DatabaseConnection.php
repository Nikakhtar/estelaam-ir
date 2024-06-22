<?php
namespace Infrastructure\Database;

use PDO;

class DatabaseConnection {
    private static $pdo;

    public static function getPDO(): PDO {
        if (!self::$pdo) {
          $host = '127.0.0.1';
          $db   = 'estelaam';
          $user = 'root';
          $pass = '66468516';
          $charset = 'utf8';

          $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
          $options = [
              PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
              PDO::ATTR_EMULATE_PREPARES   => false,
          ];

          try {
              self::$pdo = new PDO($dsn, $user, $pass, $options);
          } catch (\PDOException $e) {
              throw new \PDOException($e->getMessage(), (int)$e->getCode());
          }
      }
      return self::$pdo;
    }
}
