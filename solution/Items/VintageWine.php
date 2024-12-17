<?php

namespace solution\Items;

require_once __DIR__ . '../../Interfaces/Item/InventoryItemInterface.php';
require_once __DIR__ . '../../Interfaces/Item/InventoryItemAgeInterface.php';
require_once __DIR__ . '../../Traits/Item/ItemTrait.php';

use solution\Interfaces\Item\InventoryItemAgeInterface;
use solution\Interfaces\Item\InventoryItemInterface;
use solution\Traits\Item\ItemTrait;

class VintageWine implements InventoryItemInterface, InventoryItemAgeInterface
{
    use ItemTrait;

    public function __construct(
        private readonly string $name,
        private int $value,
        private int $sellIn
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

    /**
     * Get the remaining days for selling of the item.
     *
     * @return int
     */
    public function getSellIn(): int
    {
        return $this->sellIn;
    }

    /**
     * Calculate the price for the item based on the number of remaining selling days.
     * The value increases in value by 2 each day.
     * Value can never go below 0 and value can never go above 50.
     *
     * @return void
     */
    public function calculatePrice(): void
    {
        if ($this->value >= self::ITEM_MAXIMUM_PRICE) {
            $this->decrementSellInDays();
            return;
        }

        $valueForIncrement = $this->value == (self::ITEM_MAXIMUM_PRICE - 1) ? 1 : 2;
        $this->value += $valueForIncrement;

        $this->decrementSellInDays();
    }
}
