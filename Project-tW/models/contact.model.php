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
        $this->db =$db;
    }

    public function save(ContactDao $contact)
    {
        $stmt = $this->db->prepare("INSERT INTO contact (name, email, type, problem) VALUES (:name,:email,:type,:problem)");
        $stmt->bindValue(":name",$contact->getName());
        $stmt->bindValue(":email",$contact->getEmail());
        $stmt->bindValue(":type",$contact->getType());
        $stmt->bindValue(":problem",$contact->getProblem());
        $stmt->execute();

    }


}