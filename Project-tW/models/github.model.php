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
        echo $user;
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

    }

}