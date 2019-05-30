<?php

use Arrayy\Arrayy as Arrayy;
use LinkedIn\AccessToken;

class UserModel
{
    private $db;

    /**
     * UserModel constructor.
     * @param $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getUsers()
    {
        $stmt = $this->db->query("SELECT id,username,e_mail,last_name,first_name,linkedln_token ,github_token  FROM users");
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "UserAdmin");
        return $result;
    }

    public function getUsersSearch(string $search)
    {
        $stmt = $this->db->prepare("SELECT id,username,e_mail,last_name,first_name,linkedln_token ,github_token
                                                FROM users where username like :usern" );
        $stmt->bindParam(":usern", $search);
//        $stmt->bindParam(":email", $search);
//        $stmt->bindParam(":lastn", $search);
//        $stmt->bindParam(":firstn", $search);
        $result = $stmt->fetch();
        var_dump($result);
//        if (!$result) {
//            return array();
//        }
        return $result;
    }

    public function deleteById($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users where id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }


    public function getTokenGithub(string $user)
    {

        $stmt = $this->db->prepare("SELECT * FROM users WHERE username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserEntity");
        $result = $stmt->fetch();
        if ($result == FALSE) {
            return NULL;
        }
        return $result->getGithubToken();
    }

    public function updateContact(ContactSettings $settings)
    {
        $stmt = $this->db->prepare("UPDATE users SET password=:new where  username=:user and password=:passw");
        $stmt->bindValue(":new", $settings->getNewPassword());
        $stmt->bindValue(":user", $settings->getUsername());
        $stmt->bindValue(":passw", $settings->getOldPassword());
        $stmt->execute();
    }

    public function addToken(string $user, string $token)
    {
        $stmt = $this->db->prepare("UPDATE users SET github_token=:token where username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->bindValue(":token", $token);
        $stmt->execute();
    }

    public function addTokenLinkedln(string $user, AccessToken $token)
    {
        $stmt = $this->db->prepare("UPDATE users SET linkedln_token=:token,linkedln_exp=:exp where username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->bindValue(":token", $token->getToken());
        $stmt->bindValue(":exp", $token->getExpiresAt());
        $stmt->execute();
    }

    public function isConnectedWithGithub(string $user): bool
    {
        $stmt = $this->db->prepare("SELECT github_token FROM users where username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $stmt->execute();
        $result = $stmt->fetch();
        if (!$result) {
            return FALSE;
        }
        return TRUE;
    }

    public function isConnectedWithLinkedln(string $user): bool
    {
        $stmt = $this->db->prepare("SELECT linkedln_token FROM users where username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $stmt->execute();
        $result = $stmt->fetch();
        if (!$result) {
            return FALSE;
        }
        return TRUE;
    }

    public function getLinkedlnToken(string $user): TokenLinkedln
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserEntity");
        $stmt->execute();
        $result = $stmt->fetch();
        if (strlen($result->getLinkedinToken()) != 0) {
            return new TokenLinkedln($result->getLinkedinToken(), $result->getLinkedlnExp);
        }
        return new TokenLinkedln(NULL, NULL);
    }

    public function deleteLinkedln(string $user)
    {
        $stmt = $this->db->prepare("UPDATE users SET linkedln_exp=null, linkedln_token=null WHERE username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->execute();
    }

    public function deleteGithub(string $user)
    {
        $stmt = $this->db->prepare("UPDATE users SET github_token=null WHERE username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->execute();
    }


    public function updatePerson(Personal $personal)
    {
        $stmt = $this->db->prepare("UPDATE users SET first_name=:first, last_name=:last,  e_mail=:email where  username=:user ");
        $stmt->bindValue(":first", $personal->getFname());
        $stmt->bindValue(":last", $personal->getName());
        $stmt->bindValue(":email", $personal->getEmail());
        $stmt->bindValue(":user", $personal->getUsername());
        $stmt->execute();
    }


    public function getUser(UserDAO $user): bool
    {
        $stmt = $this->db->prepare("SELECT id,username,e_mail,password,first_name,last_name,github_token,linkedln_token,linkedln_exp FROM users where username=:user and password=:password");
        $stmt->bindValue(":user", $user->getUsername());
        $stmt->bindValue(":password", $user->getPassword());
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserEntity");
        $result = $stmt->fetch();
        return $result == FALSE ? FALSE : TRUE;
    }

    public function getUserDb(string $username): UserEntity
    {
        $stmt = $this->db->prepare("SELECT id,username,e_mail,password,first_name,last_name,github_token,linkedln_token,linkedln_exp FROM users where username=:user ");
        $stmt->bindValue(":user", $username);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserEntity");
        $result = $stmt->fetch();
        if (!$result) {
            return UserEntity::default();
        }
        return $result;

    }

    public function saveUser(Register $user)
    {
        $stmt = $this->db->prepare("INSERT INTO users VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->bindValue(1, 1);
        $stmt->bindValue(2, $user->getUsername());
        $stmt->bindValue(3, $user->getEmail());
        $stmt->bindValue(4, $user->getPassword());
        $stmt->bindValue(5, $user->getName());
        $stmt->bindValue(6, $user->getLastName());
        $stmt->bindValue(7, NULL);
        $stmt->bindValue(8, NULL);
        $stmt->bindValue(9, NULL);
        $stmt->execute();
    }

}