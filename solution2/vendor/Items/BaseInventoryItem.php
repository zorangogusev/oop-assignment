<?php

namespace solution2\vendor\Items;

require_once __DIR__ . '../../../Interfaces/Item/InventoryItemInterface.php';

use solution2\Interfaces\Item\InventoryItemInterface;

abstract class BaseInventoryItem implements InventoryItemInterface
{
    protected string $name;
    protected int $value;
    protected int $sellIn;

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
