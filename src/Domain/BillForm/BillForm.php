<?php
namespace Domain;

class BillForm {
    private $id;
    private $application;
    private $vendorAnnouncementForm;
    private $byPerson;
    private $type;
    private $submitDate;
    private $expireDate;
    private $description;
    private $items; // Array of BillFormItem

    public function __construct($id, $application, $vendorAnnouncementForm, $byPerson, $type, $submitDate, $expireDate, $description, array $items) {
        $this->id = $id;
        $this->application = $application;
        $this->vendorAnnouncementForm = $vendorAnnouncementForm;
        $this->byPerson = $byPerson;
        $this->type = $type;
        $this->submitDate = $submitDate;
        $this->expireDate = $expireDate;
        $this->description = $description;
        $this->items = $items;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getApplication() { return $this->application; }
    public function getVendorAnnouncementForm() { return $this->vendorAnnouncementForm; }
    public function getByPerson() { return $this->byPerson; }
    public function getType() { return $this->type; }
    public function getSubmitDate() { return $this->submitDate; }
    public function getExpireDate() { return $this->expireDate; }
    public function getDescription() { return $this->description; }
    public function getItems() { return $this->items; }

    // Setters
    public function setId($id) { $this->id = $id; }
    public function setApplication($application) { $this->application = $application; }
    public function setVendorAnnouncementForm($vendorAnnouncementForm) { $this->vendorAnnouncementForm = $vendorAnnouncementForm; }
    public function setByPerson($byPerson) { $this->byPerson = $byPerson; }
    public function setType($type) { $this->type = $type; }
    public function setSubmitDate($submitDate) { $this->submitDate = $submitDate; }
    public function setExpireDate($expireDate) { $this->expireDate = $expireDate; }
    public function setDescription($description) { $this->description = $description; }
    public function setItems($items) { $this->items = $items; }
}
