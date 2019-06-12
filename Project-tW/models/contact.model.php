<?php
declare(strict_types=1);

class ContactModel extends Database
{
    private $db;

    /**
     * ContactModel constructor.
     * @param $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function save(ContactDao $contact)
    {
        $stmt = $this->db->prepare("INSERT INTO contact (name, email, type, problem) VALUES (:name,:email,:type,:problem)");
        $stmt->bindValue(":name", $contact->getName());
        $stmt->bindValue(":email", $contact->getEmail());
        $stmt->bindValue(":type", $contact->getType());
        $stmt->bindValue(":problem", $contact->getProblem());
        $stmt->execute();

    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT id,name,email,type,problem FROM contact");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "ContactEntity");
        return $stmt->fetchAll();
    }

    public function deleteById($id)
    {
        $stmt = $this->db->prepare("DELETE FROM contact where id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }


}

