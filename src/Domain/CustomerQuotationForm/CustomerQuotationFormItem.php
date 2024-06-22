<?php
namespace Domain\CustomerQuotationForm;

class CustomerQuotationFormItem {
    private $id;
    private $customerQuotationForm;
    private $article;
    private $quantity;
    private $unit;
    private $articleNamePlace;
    private $description;

    public function __construct($id, $customerQuotationForm, $article, $quantity, $unit, $articleNamePlace, $description) {
        $this->id = $id;
        $this->customerQuotationForm = $customerQuotationForm;
        $this->article = $article;
        $this->quantity = $quantity;
        $this->unit = $unit;
        $this->articleNamePlace = $articleNamePlace;
        $this->description = $description;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getCustomerQuotationForm() { return $this->customerQuotationForm; }
    public function getArticle() { return $this->article; }
    public function getQuantity() { return $this->quantity; }
    public function getUnit() { return $this->unit; }
    public function getArticleNamePlace() { return $this->articleNamePlace; }
    public function getDescription() { return $this->description; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setCustomerQuotationForm($customerQuotationForm) { $this->customerQuotationForm = $customerQuotationForm; }
    public function setArticle($article) { $this->article = $article; }
    public function setQuantity($quantity) { $this->quantity = $quantity; }
    public function setUnit($unit) { $this->unit = $unit; }
    public function setArticleNamePlace($articleNamePlace) { $this->articleNamePlace = $articleNamePlace; }
    public function setDescription($description) { $this->description = $description; }
}
