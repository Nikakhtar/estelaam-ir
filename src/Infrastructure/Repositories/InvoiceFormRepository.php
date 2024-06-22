<?php
namespace Infrastructure\Repositories;

use Domain\InvoiceForm\InvoiceForm;

class InvoiceFormRepository {
    public function findById($id) {
        // Assume PDO is set up and available as $this->pdo
        $stmt = $this->pdo->prepare("SELECT * FROM invoice_forms WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        return new InvoiceForm(...$data); // Assuming InvoiceForm constructor can handle this array
    }

    public function update($id, $data) {
        // Example: updating description, adjust based on actual data structure
        $stmt = $this->pdo->prepare("UPDATE invoice_forms SET description = :description WHERE id = :id");
        $stmt->execute(['id' => $id, 'description' => $data['description']]);
        return $this->findById($id);  // Return updated invoice
    }
}
