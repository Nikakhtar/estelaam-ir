<?php
namespace Domain;

class InvoiceFormItem {
    private $id;
    private $invoiceForm;
    private $article;
    private $quantity;
    private $unitPrice;
    private $unit;
    private $deliveryState;
    private $deliveryTime;
    private $description;

    public function __construct($id, $invoiceForm, $article, $quantity, $unitPrice, $unit, $deliveryState, $deliveryTime, $description) {
        $this->id = $id;
        $this->invoiceForm = $invoiceForm;
        $this->article = $article;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->unit = $unit;
        $this->deliveryState = $deliveryState;
        $this->deliveryTime = $deliveryTime;
        $this->description = $description;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getInvoiceForm() { return $this->invoiceForm; }
    public function getArticle() { return $this->article; }
    public function getQuantity() { return $this->quantity; }
    public function getUnitPrice() { return $this->unitPrice; }
    public function getUnit() { return $this->unit; }
    public function getDeliveryState() { return $this->deliveryState; }
    public function getDeliveryTime() { return $this->deliveryTime; }
    public function getDescription() { return $this->description; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setInvoiceForm($invoiceForm) { $this->invoiceForm = $invoiceForm; }
    public function setArticle($article) { $this->article = $article; }
    public function setQuantity($quantity) { $this->quantity = $quantity; }
    public function setUnitPrice($unitPrice) { $this->unitPrice = $unitPrice; }
    public function setUnit($unit) { $this->unit = $unit; }
    public function setDeliveryState($deliveryState) { $this->deliveryState = $deliveryState; }
    public function setDeliveryTime($deliveryTime) { $this->deliveryTime = $deliveryTime; }
    public function setDescription($description) { $this->description = $description; }
}
