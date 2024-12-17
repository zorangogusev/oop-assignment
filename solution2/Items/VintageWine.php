<?php

namespace solution2\Items;

require_once __DIR__ . '../../vendor/Items/DefaultAgingInventoryItem.php';

use solution2\vendor\Items\DefaultAgingInventoryItem;

class VintageWine  extends DefaultAgingInventoryItem
{
    public function __construct($name, $value, $sellIn)
    {
        $this->name = $name;
        $this->value = $value;
        $this->sellIn = $sellIn;
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
