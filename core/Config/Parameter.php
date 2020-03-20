<?php

namespace Core\Config;

class Parameter
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var mixed
     */
    private $value;

    /**
     * Parameter constructor.
     * @param string $key
     * @param mixed $value
     */
    public function __construct(string $key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Parameter
     */
    public function setKey(string $key): Parameter
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Parameter
     */
    public function setValue($value): Parameter
    {
        $this->value = $value;
        return $this;
    }
}