<?php

namespace solution2\Items;

require_once __DIR__ . '../../vendor/Items/DefaultAgingInventoryItem.php';

use solution2\vendor\Items\DefaultAgingInventoryItem;


class FryingPan extends DefaultAgingInventoryItem
{
    public function __construct($name, $value, $sellIn)
    {
        $this->name = $name;
        $this->value = $value;
        $this->sellIn = $sellIn;
    }
}
