<?php

namespace solution2\vendor\Items;

require_once __DIR__ . '/BaseInventoryItem.php';
require_once __DIR__ . '../../../Interfaces/Item/InventoryItemAgeInterface.php';

use solution2\vendor\Items\BaseInventoryItem;
use solution2\Interfaces\Item\InventoryItemAgeInterface;

class AgingInventoryItem extends BaseInventoryItem implements InventoryItemAgeInterface
{
    public const ITEM_MINIMUM_PRICE = 0;
    public const ITEM_MAXIMUM_PRICE = 50;

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
     * Decrement the days for selling by 1 day.
     *
     * @return void
     */
    public function decrementSellInDays(): void
    {
        if ($this->sellIn > 0) {
            $this->sellIn--;
        }
    }

    /**
     * Calculate the default item price.
     * The price decrease in value by 1 every day, but once the sell-in period has expired
     * they start decreasing in value by 2 every day.
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

        $valueForDecrement = $this->sellIn > 0 ? 1 : ($this->value == 1 ? 1 : 2);
        $this->value -= $valueForDecrement;

        $this->decrementSellInDays();
    }
}
