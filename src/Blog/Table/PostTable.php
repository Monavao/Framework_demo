<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 12/01/19
 * Time: 17:43
 */

namespace App\Blog\Table;

class PostTable
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * PostTable constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Pagine les articles
     * @return \stdClass[]
     */
    public function findPaginated(): array
    {
        return $this->pdo->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 10')->fetchAll();
    }

    /**
     * Récupère un article à partir de son ID
     * @param int $id
     * @return \stdClass
     */
    public function find(int $id): \stdClass
    {
        $query = $this->pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $query->execute([$id]);

        return $query->fetch();
    }
}
