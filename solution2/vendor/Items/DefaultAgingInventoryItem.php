<?php

namespace solution2\vendor\Items;

require_once __DIR__ . '../../../Interfaces/Item/InventoryItemAgeInterface.php';
require_once __DIR__ . '/AgingInventoryItem.php';

use solution2\vendor\Items\AgingInventoryItem;
use solution2\Interfaces\Item\InventoryItemAgeInterface;

class DefaultAgingInventoryItem extends AgingInventoryItem
{

}
