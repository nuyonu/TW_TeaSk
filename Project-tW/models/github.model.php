<?php
declare(strict_types=1);

use Arrayy\Arrayy;

class GithubModel
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

    public function save(Arrayy $data, string $user): void
    {
        $this->delete($user);
        $stmt = $this->db->prepare("INSERT INTO user_github VALUES(:id,(SELECT ID FROM USERS WHERE username=:user),:language,:forked,:repo_name,:created_at,:updated_at,:pushed_at)");
        foreach ($data as $info) {
            $stmt->bindValue(":id", NULL);
            $stmt->bindValue(":user", $user);
            $stmt->bindValue(":language", $info->getLanguage());
            $stmt->bindValue(":forked", $info->isForked());
            $stmt->bindValue(":repo_name", $info->getRepoName());
            $stmt->bindValue(":created_at", $info->getCreatedAt());
            $stmt->bindValue(":updated_at", $info->getUpdatedAt());
            $stmt->bindValue(":pushed_at", $info->getPushedAt());
            $stmt->execute();
        }
        $stmt = $this->db->prepare("UPDATE users set last_update=SYSDATE() where username=:user");
        $stmt->execute([$user]);
    }

    public function update(Arrayy $data, string $user)
    {
        $stmt = $this->db->prepare("DELETE FROM user_github where id_user=(select  id from users where username=:user)");
        $stmt->bindValue(":user", $user);
        $stmt->execute();
        $this->save($data, $user);
    }

    public function delete(string $user)
    {
        $stmt = $this->db->prepare("DELETE FROM user_github where (select id from users WHERE username=:user)");
        $stmt->bindValue(":user", $user);
        $stmt->execute();
    }

}