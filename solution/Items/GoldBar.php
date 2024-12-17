<?php

namespace solution\Items;

require_once __DIR__ . '../../Interfaces/Item/InventoryItemInterface.php';
require_once __DIR__ . '../../Interfaces/Item/InventoryItemWithNoMaxValueConstraintInterface.php';

use solution\Interfaces\Item\InventoryItemInterface;
use solution\Interfaces\Item\InventoryItemWithNoMaxValueConstraintInterface;

class GoldBar implements InventoryItemInterface, InventoryItemWithNoMaxValueConstraintInterface
{
    public function __construct(
        private readonly string $name,
        private readonly int $value,
    ) {

    }

    /**
     * Get the name of the item.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of the item.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
