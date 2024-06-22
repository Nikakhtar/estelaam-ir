<?php
namespace Infrastructure\Repositories;

use Infrastructure\Database\DatabaseConnection;
use pdo;
use Domain\InvoiceForm\InvoiceForm;

class InvoiceFormRepository {
    private $pdo;

    public function __construct() {
        //$this->initializePDO();
        $this->pdo = DatabaseConnection::getPDO();
    }

    /*private function initializePDO() {
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
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }*/

    public function findById($id) {
        // Assume PDO is set up and available as $this->pdo
        $stmt = $this->pdo->prepare("SELECT * FROM invoice_form WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        //fetch items alsoooooooooooooooooooooooooo and add to data
        return $invoice = new InvoiceForm(
          $data['id'],
          $data['application'],
          $data['bill_form'],
          $data['by_person'],
          $data['type'],
          $data['submit_date'],
          $data['description'],
          $data
        );

        //return new InvoiceForm(...$data); // Assuming InvoiceForm constructor can handle this array
    }

    public function update($id, $data) {
        // Example: updating description, adjust based on actual data structure
        $stmt = $this->pdo->prepare("UPDATE invoice_form SET description = :description WHERE id = :id");
        $stmt->execute(['id' => $id, 'description' => $data['description']]);
        return $this->findById($id);  // Return updated invoice
    }
}
