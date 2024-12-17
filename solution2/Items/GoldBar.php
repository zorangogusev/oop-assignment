<?php

namespace solution2\Items;

require_once __DIR__ . '../../vendor/Items/BaseInventoryItem.php';
require_once __DIR__ . '../../Interfaces/Item/InventoryItemWithNoMaxValueConstraintInterface.php';

use solution2\vendor\Items\BaseInventoryItem;
use solution2\Interfaces\Item\InventoryItemWithNoMaxValueConstraintInterface;

class GoldBar extends BaseInventoryItem implements InventoryItemWithNoMaxValueConstraintInterface
{
    public function __construct(
        protected string $name,
        protected int $value,
    ) {

    }
}
