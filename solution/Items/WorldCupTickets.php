<?php

namespace solution\Items;

require_once __DIR__ . '../../Interfaces/Item/InventoryItemInterface.php';
require_once __DIR__ . '../../Interfaces/Item/InventoryItemAgeInterface.php';
require_once __DIR__ . '../../Traits/Item/ItemTrait.php';

use solution\Interfaces\Item\InventoryItemAgeInterface;
use solution\Interfaces\Item\InventoryItemInterface;
use solution\Traits\Item\ItemTrait;

class WorldCupTickets implements InventoryItemInterface, InventoryItemAgeInterface
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
     *
     * World Cup Ticket increases in value each day according to the following rules:
     *      If there are more than 10 days left, increases by 1 each day
     *      If there are 10-6 days left, increases by 2
     *      If there are 5 days or fewer left, increases by 3
     *      If there are 0 days left, the value of the item drops to 0
     *
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

        if ($this->sellIn > 10) {
            $this->value += 1;
        } elseif ($this->sellIn > 5) {
            $this->value += 2;
        } elseif ( $this->sellIn > 0) {
            $this->value += 3;
        } else {
            $this->value = 0; // the selling days($this->sellIn) are 0
        }

        $this->decrementSellInDays();
    }
}
