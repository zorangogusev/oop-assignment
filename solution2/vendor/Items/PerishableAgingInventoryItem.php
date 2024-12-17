<?php

namespace solution2\vendor\Items;

require_once __DIR__ . '/AgingInventoryItem.php';

use solution2\vendor\Items\AgingInventoryItem;

class PerishableAgingInventoryItem extends AgingInventoryItem
{
    /**
     * Override the calculatePrice method.
     * Calculate the perishable item price.
     * The price decrease in value by 2 every day, but once the sell-in period has expired
     * they start decreasing in value by 4 every day.
     * Value can never go below 0 and value can never go above 50.
     *
     * @return void
     */
    public function calculatePrice(): void
    {
        if ($this->value <= self::ITEM_MINIMUM_PRICE) {
            $this->decrementSellInDays();
            return;
        }

        if ($this->sellIn > 0) {
            $valueForDecrement = $this->value >= 2 ? 2 : 1;
        } else {
            $valueForDecrement = $this->value >= 4 ? 4 : max($this->value, 0);
        }

        $this->value -= $valueForDecrement;

        $this->decrementSellInDays();
    }
}
