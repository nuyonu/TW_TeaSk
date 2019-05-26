<?php


class LocationModel
{
    private $db;

    /**
     * LocationModel constructor.
     * @param $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function save(string $user, string $place, string $lat, string $long): void
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $stmt->execute();
        $id = $stmt->fetch();

        $stmt = $this->db->prepare("SELECT ID_user from user_location where id_user=:id");

        $stmt->bindValue(":id", $id[0]);
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $stmt->execute();
        $result=$stmt->fetch();

        if (!$result) {

            $stmt = $this->db->prepare("INSERT INTO user_location values(:id,:id_user,:place,:lat,:lon)");
            $stmt->bindValue(":id", 1);
            $stmt->bindValue(":id_user", $id[0]);
            $stmt->bindValue(":place", $place);
            $stmt->bindValue(":lat", $lat);
            $stmt->bindValue(":lon", $long);
            $stmt->execute();
        } else {

            $stmt = $this->db->prepare("UPDATE user_location SET place=:place,lat=:lat,lon=:lon WHERE id_user=:id");
            $stmt->bindValue(":place", $place);
            $stmt->bindValue(":lat", $lat);
            $stmt->bindValue(":lon", $long);
            $stmt->bindValue(":id", $id[0]);
            $stmt->execute();
        }
    }

    public function getLocationUser(string $user)
    {
        $stmt = $this->db->prepare("SELECT * FROM user_location where id_user=(select id from users where username=:user)");
        $stmt->bindValue(":user", $user);
        $stmt->setFetchMode(PDO::FETCH_CLASS,"LocationEntity");
        $stmt->execute();
        $result=$stmt->fetch();
        if(!$result){
            return NULL;
        }
        return $result;


    }

}