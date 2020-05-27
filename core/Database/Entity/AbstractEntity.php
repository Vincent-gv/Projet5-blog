<?php

namespace Core\Database\Entity;

abstract class AbstractEntity
{
    abstract public static function getTableInfos(): TableInfos;
}
