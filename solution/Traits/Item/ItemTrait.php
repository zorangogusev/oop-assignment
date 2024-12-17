<?php

namespace solution\Traits\Item;

/**
 * Trait for use by classes that implement interface InventoryItemAgeInterface.
 */
trait ItemTrait
{
    public const ITEM_MINIMUM_PRICE = 0;
    public const ITEM_MAXIMUM_PRICE = 50;

    /**
     * Decrement the days for selling by 1 day.
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
    public function calculateDefaultItemPrice(): void
    {
        if ($this->value <= self::ITEM_MINIMUM_PRICE) {
            $this->decrementSellInDays();
            return;
        }

        $valueForDecrement = $this->sellIn > 0 ? 1 : ($this->value == 1 ? 1 : 2);
        $this->value -= $valueForDecrement;

        $this->decrementSellInDays();
    }

    /**
     * Calculate the perishable item price.
     * The price decrease in value by 2 every day, but once the sell-in period has expired
     * they start decreasing in value by 4 every day.
     * Value can never go below 0 and value can never go above 50.
     *
     * @return void
     */
    public function calculatePerishableItemPrice(): void
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
