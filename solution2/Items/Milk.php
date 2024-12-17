<?php

namespace solution2\Items;

require_once __DIR__ . '../../vendor/Items/PerishableAgingInventoryItem.php';

use solution2\vendor\Items\PerishableAgingInventoryItem;

class Milk extends PerishableAgingInventoryItem
{
    public function __construct($name, $value, $sellIn)
    {
        $this->name = $name;
        $this->value = $value;
        $this->sellIn = $sellIn;
    }
}
