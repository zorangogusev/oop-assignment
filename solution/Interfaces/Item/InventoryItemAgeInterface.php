<?php

namespace solution\Interfaces\Item;

/**
 * Must be implemented by inventory items whose prices change over time.
 */
interface InventoryItemAgeInterface
{
    // for developing, testing and debugging purpose implement getter to get the days for selling.
    public function getSellIn(): int;

    public function calculatePrice(): void;
}
