<?php


namespace Core\Database\Repository;


use Core\Database\DatabaseInterface;
use Core\Database\Entity\TableInfos;

abstract class AbstractRepository
{
    /**
     * @var DatabaseInterface
     */
    protected $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    protected function hydrate($datas)
    {
        if (is_object($datas)) {
            return $this->hydrateObj($datas);
        }

        return array_map([$this, 'hydrateObj'], $datas);
    }

    abstract protected function hydrateObj(object $object);

    abstract protected function getEntityClass(): string;

    protected function getEntityTableInfos(): TableInfos
    {
        return $this->getEntityClass()::getTableInfos();
    }

    public function findAll(): array
    {
        return $this->findBy();
    }

    public function countAll(): int
    {
        return $this->countBy();
    }

    public function findBy(array $criterias = [], array $orders = [], int $limit = null, int $offset = null): array
    {
        $query = 'SELECT * FROM ' . $this->getEntityTableInfos()->getName() . $this->getFilters($criterias, $orders, $limit, $offset);

        return $this->hydrate($this->database->query($query));
    }

    public function countBy(array $criterias = [], array $orders = [], int $limit = null, int $offset = null): int
    {
        $query = 'SELECT COUNT(*) AS count FROM ' . $this->getEntityTableInfos()->getName() . $this->getFilters($criterias, $orders, $limit, $offset);

        return intval($this->database->query($query, [], true)->count);
    }

    public function postLimit()
    {
        return $this->hydrate($this->database->query('SELECT * FROM post LIMIT 3'));
    }

    private function getFilters(array $criterias = [], array $orders = [], int $limit = null, int $offset = null)
    {
        $query = '';

        if (count($criterias) > 0) {
            /** Methode 1 */
//            $query .= " WHERE ";
//
//            $keys = array_keys($criterias);
//            for ($i = 0; $i < count($keys); $i++) {
//                $index = $keys[$i];
//                $value = $criterias[$index];
//
//                $query .= "$index = '$value'";
//
//                if ($i < count($keys) - 1) {
//                    $query .= " AND ";
//                }
//            }

            /** Methode 2 */
//            $tempArray = [];
//            foreach ($criterias as $index => $value) {
//                $tempArray[] = "$index = '$value'";
//            }
//
//            $query .= " WHERE " . join(" AND ", $tempArray);

            /** Methode 3 */
            $query .= " WHERE " . join(" AND ", array_map(function ($index, $value) {
                    return "$index = '$value'";
                }, array_keys($criterias), $criterias));
        }
        /*var_dump($query);*/

        if (count($orders) > 0) {
            $query .= " ORDER BY " . join(", ", array_map(function ($index, $value) {
                    return "$index $value";
                }, array_keys($orders), $orders));
        }

        if ($limit !== null && $offset !== null) {
            $query .= " LIMIT $offset, $limit";
        } else if ($limit !== null) {
            $query .= " LIMIT $limit";
        }

        return $query;
    }

    public function find(string $id)
    {
        return $this->hydrate($this->database->query('SELECT * FROM ' . $this->getEntityTableInfos()->getName() . ' WHERE id=:id', [':id' => $id], true));
    }

    public function pagination(int $pageIndex)
    {
        if (!isset($_GET['page']) || $_GET['page']=='0')
        {
            $page=1;
        }
        else
        {
            $page=$_GET['page']; // Sinon lecture de la page
        }
        $countAll = $this->countAll();
        $postNumberPerPage = 1;
        $nbPages = $countAll % $postNumberPerPage == 0
            ? $countAll / $postNumberPerPage
            : (int)floor($countAll / $postNumberPerPage) + 1;
        if ($pageIndex <= 0 || $pageIndex > $nbPages) {
            return null;
        }
        $offset = $postNumberPerPage * ($pageIndex - 1);
        $data = $this->findBy([], ['id' => 'DESC'], $postNumberPerPage, $offset);
        return [
            'page' => $page,
            'data' => $data,
            'currentPage' => $pageIndex,
            'nbPages' => $nbPages,
            'postCount' => $countAll
        ];
        var_dump($page);
    }
}