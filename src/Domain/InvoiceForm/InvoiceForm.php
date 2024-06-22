<?php
namespace Domain\InvoiceForm;

class InvoiceForm {
    public $id;
    public $application;
    public $billForm;
    public $byPerson;
    public $type;
    public $submitDate;
    public $description;
    public $items; // Array of InvoiceItem

    public function __construct($id, $application, $bill_form, $by_person, $type, $submit_date, $description, array $items = array()) {
        $this->id = $id;
        $this->application = $application;
        $this->billForm = $bill_form;
        $this->byPerson = $by_person;
        $this->type = $type;
        $this->submitDate = $submit_date;
        $this->description = $description;
        $this->items = $items;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getApplication() { return $this->application; }
    public function getBillForm() { return $this->billForm; }
    public function getByPerson() { return $this->byPerson; }
    public function getType() { return $this->type; }
    public function getSubmitDate() { return $this->submitDate; }
    public function getDescription() { return $this->description; }
    public function getItems() { return $this->items; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setApplication($application) { $this->application = $application; }
    public function setBillForm($billForm) { $this->billForm = $billForm; }
    public function setByPerson($byPerson) { $this->byPerson = $byPerson; }
    public function setType($type) { $this->type = $type; }
    public function setSubmitDate($submitDate) { $this->submitDate = $submitDate; }
    public function setDescription($description) { $this->description = $description; }
    public function setItems($items) { $this->items = $items; }
}
