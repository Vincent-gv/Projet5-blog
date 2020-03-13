<?php

namespace Core\Database\Entity;

abstract class AbstractEntity
{
    abstract static public function getTableInfos(): TableInfos;
}