<?php

namespace Core\Database\Entity;

class TableInfos
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ColumnInfos[]
     */
    private $columns;

    /**
     * TableInfos constructor.
     * @param string $name
     * @param array $columns
     */
    public function __construct(string $name, array $columns)
    {
        $this->name = $name;
        $this->columns = $columns;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ColumnInfos[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }
}
