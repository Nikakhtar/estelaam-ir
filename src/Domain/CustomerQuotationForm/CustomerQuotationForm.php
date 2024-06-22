<?php
namespace Domain;

class CustomerQuotationForm {
    private $id;
    private $application;
    private $byPerson;
    private $submitDate;
    private $expireDate;
    private $description;
    private $items; // Array of CustomerQuotationFormItem

    public function __construct($id, $application, $byPerson, $submitDate, $expireDate, $description, array $items) {
        $this->id = $id;
        $this->application = $application;
        $this->byPerson = $byPerson;
        $this->submitDate = $submitDate;
        $this->expireDate = $expireDate;
        $this->description = $description;
        $this->items = $items;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getApplication() { return $this->application; }
    public function getByPerson() { return $this->byPerson; }
    public function getSubmitDate() { return $this->submitDate; }
    public function getExpireDate() { return $this->expireDate; }
    public function getDescription() { return $this->description; }
    public function getItems() { return $this->items; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setApplication($application) { $this->application = $application; }
    public function setByPerson($byPerson) { $this->byPerson = $byPerson; }
    public function setSubmitDate($submitDate) { $this->submitDate = $submitDate; }
    public function setExpireDate($expireDate) { $this->expireDate = $expireDate; }
    public function setDescription($description) { $this->description = $description; }
    public function setItems($items) { $this->items = $items; }
}
