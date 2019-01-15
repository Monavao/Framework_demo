<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 15/01/19
 * Time: 22:36
 */

namespace Framework\Database;

use Pagerfanta\Adapter\AdapterInterface;

class PaginatedQuery implements AdapterInterface
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $countQuery;

    /**
     * PaginatedQuery constructor.
     * @param \PDO   $pdo
     * @param string $query Requête permettant de récupérer les résultats
     * @param string $countQuery Requête permettant de compter le nombre de résultats total
     */
    public function __construct(\PDO $pdo, string $query, string $countQuery)
    {
        $this->pdo        = $pdo;
        $this->query      = $query;
        $this->countQuery = $countQuery;
    }

    /**
     * @return int
     */
    public function getNbResults(): int
    {
        return $this->pdo->query($this->countQuery)->fetchColumn();
    }

    /**
     * @param int $offset
     * @param int $length
     * @return array|\Traversable|void
     */
    public function getSlice($offset, $length)
    {
        $statement = $this->pdo->prepare($this->query . ' LIMIT :offset, :length');
        $statement->bindParam('offset', $offset, \PDO::PARAM_INT);
        $statement->bindParam('length', $length, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
