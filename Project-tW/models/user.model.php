<?php

use LinkedIn\AccessToken;

class UserModel
{

    public function testPopulate()
    {
        $stmt = $this->db->prepare("INSERT INTO users(username) values('dasda')");
        for ($i = 1; $i < 1000; $i++) {
            $stmt->execute();
        }
    }

    /**
     * @return int calculeaza in cate paginii se pot incadra toate inregistrarile din tabela fara cautare
     */
    public function getMaxPage(): int
    {
        $stmt = $this->db->prepare("SELECT count(id) from users where  id!=1");
        $stmt->execute();
        $lines = $stmt->fetch(PDO::FETCH_ASSOC)['count(id)'];
        return $lines % Constants::MAX_PAGE > 0 ? ($lines / Constants::MAX_PAGE) + 1 : $lines / Constants::MAX_PAGE;
    }

    /**
     * @param $search cuvantul dupa care se cauta
     * @return int   calculeaza in cate paginii se pot incadra toate inregistrarile din tabela cu cautare
     */
    public function getMaxPageSearch($search): int
    {
        $stmt = $this->db->prepare("SELECT count(id) from users where (username like ? or e_mail like ? or last_name like ? or first_name like ?) and id!=1");
        $stmt->execute([$search, $search, $search, $search]);
        $lines = $stmt->fetch(PDO::FETCH_ASSOC)['count(id)'];
        return $lines % Constants::MAX_PAGE > 0 ? ($lines / Constants::MAX_PAGE) + 1 : $lines / Constants::MAX_PAGE;
    }

    /**
     * @param string $user numele utilizatorului care se doreste sa se afle gradul
     * @return mixed gradul userului
     */
    public function getUserGrade(string $user)
    {
        $stmt = $this->db->prepare("SELECT grade from users where username=?");
        $stmt->execute([$user]);
        return $stmt->fetch();
    }

    public function getUsers(int $page)
    {
        $page = ($page - 1) * Constants::MAX_PAGE;
        $stmt = $this->db->prepare("SELECT id,username,e_mail,last_name,first_name,linkedln_token ,github_token  FROM users where id!=1 LIMIT ?,30");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserAdmin");
        $stmt->execute([$page]);
        return $stmt->fetchAll();
    }

    public function getUsersSearch(string $search, $page)
    {
        $search = '%' . $search . '%';

        $page = ($page - 1) * Constants::MAX_PAGE;
        $stmt = $this->db->prepare("SELECT id,username,e_mail,last_name,first_name,linkedln_token ,github_token
                                                FROM users where (username like ? or e_mail like ? or last_name like ? or first_name like ?) and id!=1 limit ?,30");
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserAdmin");
        $stmt->execute([$search, $search, $search, $search, $page]);
        $result = $stmt->fetchAll();
        return $result ? $result : array();
    }

    public function deleteById($id)
    {
        if ($id != 1) {
            $stmt = $this->db->prepare("DELETE FROM users where id=:id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
        }
    }

    public function getTokenGithub(string $user)
    {
        $stmt = $this->db->prepare("SELECT github_token FROM users WHERE username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserEntity");
        $result = $stmt->fetch();
        return $result ? $result->getGithubToken() : NULL;
    }

    public function lastUpdate(string $user){
        $stmt = $this->db->prepare("SELECT last_update FROM users WHERE username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserEntity");
        $result = $stmt->fetch();
        return $result ? $result->getLastUpdate() : NULL;

    }

    public function updateContact(ContactSettings $settings)
    {
        $stmt = $this->db->prepare("UPDATE users SET password=:new where  username=:user and password=:passw");
        $stmt->bindValue(":new", $settings->getNewPassword());
        $stmt->bindValue(":user", $settings->getUsername());
        $stmt->bindValue(":passw", $settings->getOldPassword());
        $stmt->execute();
    }

    public function addTokenGithub(string $user, string $token)
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
        return $result[0] != NULL;
    }

    public function isConnectedWithLinkedln(string $user): bool
    {
        $stmt = $this->db->prepare("SELECT linkedln_token FROM users where username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[0] != NULL;
    }

    public function getLinkedlnToken(string $user): TokenLinkedln
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username=:user");
        $stmt->bindValue(":user", $user);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserEntity");
        $stmt->execute();
        $result = $stmt->fetch();
        if (strlen($result->getLinkedlnToken()) != 0) {
            return new TokenLinkedln($result->getLinkedlnToken(), $result->getLinkedlnExp());
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
        $stmt = $this->db->prepare("SELECT id,username,e_mail,password,first_name,last_name,github_token,linkedln_token,linkedln_exp FROM users where username=:user ");
        $stmt->bindValue(":user", $user->getUsername());
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "UserEntity");
        $result = $stmt->fetch();
        return $result && password_verify($user->getPassword(), $result->getPassword());
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
        $stmt = $this->db->prepare("INSERT INTO users(username, e_mail, password, first_name, last_name ) VALUES(?,?,?,?,?)");
        $stmt->bindValue(1, $user->getUsername());
        $stmt->bindValue(2, $user->getEmail());
        $stmt->bindValue(3, password_hash($user->getPassword(), PASSWORD_DEFAULT));
        $stmt->bindValue(4, $user->getName());
        $stmt->bindValue(5, $user->getLastName());
        $stmt->execute();
    }

    public function existUsername(string $username): bool
    {
        $stmt = $this->db->prepare("select username from users where username=:username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch() != FALSE;
    }

    public function deleteByUsername($username)
    {
        if (strcmp($username, Config::get("adminUser")) != 0) {
            $stmt = $this->db->prepare("DELETE FROM users where username=:usern");
            $stmt->bindValue(":usern", $username);
            $stmt->execute();
        }
    }

    /**
     * UserModel constructor.
     * @param $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    private $db;

    public function switchRole($username)
    {
        $grade = $this->getUserGrade($username)['grade'];
        $grade = $grade == 3 ? 2 : 3;
        $stmt = $this->db->prepare("UPDATE USERS set grade=? where username=?");
        $stmt->execute([$grade, $username]);
        return $grade;
    }


}