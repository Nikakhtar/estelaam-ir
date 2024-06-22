<?php
namespace Domain;

class BillFormItem {
    private $id;
    private $billForm;
    private $article;
    private $quantity;
    private $unitPrice;
    private $unit;
    private $description;

    public function __construct($id, $billForm, $article, $quantity, $unitPrice, $unit, $description) {
        $this->id = $id;
        $this->billForm = $billForm;
        $this->article = $article;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->unit = $unit;
        $this->description = $description;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getBillForm() { return $this->billForm; }
    public function getArticle() { return $this->article; }
    public function getQuantity() { return $this->quantity; }
    public function getUnitPrice() { return $this->unitPrice; }
    public function getUnit() { return $this->unit; }
    public function getDescription() { return $this->description; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setBillForm($billForm) { $this->billForm = $billForm; }
    public function setArticle($article) { $this->article = $article; }
    public function setQuantity($quantity) { $this->quantity = $quantity; }
    public function setUnitPrice($unitPrice) { $this->unitPrice = $unitPrice; }
    public function setUnit($unit) { $this->unit = $unit; }
    public function setDescription($description) { $this->description = $description; }
}
