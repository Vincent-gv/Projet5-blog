<?php

namespace Core\Database\Entity;

class ColumnInfos
{
    const STRING = 'string';
    const DATETIME = 'datetime';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $paramName;

    /**
     * ColumnInfos constructor.
     * @param string $name
     * @param string $type
     * @param string $paramName
     */
    public function __construct(string $name, string $type, string $paramName = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->paramName = $paramName;

        if ($this->paramName === null) {
            $this->paramName = $name;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getParamName(): string
    {
        return $this->paramName;
    }
}
