<?php
namespace Domain\VendorAnnouncementForm;

class VendorAnnouncementFormItem {
    private $id;
    private $vendorAnnouncementForm;
    private $article;
    private $price;
    private $availableQuantity;
    private $unit;
    private $description;

    public function __construct($id, $vendorAnnouncementForm, $article, $price, $availableQuantity, $unit, $description) {
        $this->id = $id;
        $this->vendorAnnouncementForm = $vendorAnnouncementForm;
        $this->article = $article;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
        $this->unit = $unit;
        $this->description = $description;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getVendorAnnouncementForm() { return $this->vendorAnnouncementForm; }
    public function getArticle() { return $this->article; }
    public function getPrice() { return $this->price; }
    public function getAvailableQuantity() { return $this->availableQuantity; }
    public function getUnit() { return $this->unit; }
    public function getDescription() { return $this->description; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setVendorAnnouncementForm($vendorAnnouncementForm) { $this->vendorAnnouncementForm = $vendorAnnouncementForm; }
    public function setArticle($article) { $this->article = $article; }
    public function setPrice($price) { $this->price = $price; }
    public function setAvailableQuantity($availableQuantity) { $this->availableQuantity = $availableQuantity; }
    public function setUnit($unit) { $this->unit = $unit; }
    public function setDescription($description) { $this->description = $description; }
}
