<?php
namespace Infrastructure\Repositories;

use Infrastructure\Database\DatabaseConnection;
use pdo;
use Domain\InvoiceForm\InvoiceForm;

class InvoiceFormRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = DatabaseConnection::getPDO();
    }

    public function findById($id) {
        // Assume PDO is set up and available as $this->pdo
        $stmt = $this->pdo->prepare("SELECT * FROM invoice_form WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $formData = $stmt->fetch();

        $stmt = $this->pdo->prepare("SELECT * FROM invoice_form_item WHERE invoice_form = :id");
        $stmt->execute(['id' => $id]);
        $itemData = $stmt->fetch();

        return $invoice = new InvoiceForm(
          $formData['id'],
          $formData['application'],
          $formData['bill_form'],
          $formData['by_person'],
          $formData['type'],
          $formData['submit_date'],
          $formData['description'],
          $itemData
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
