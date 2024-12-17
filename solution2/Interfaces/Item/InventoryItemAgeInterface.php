<?php

namespace solution2\Interfaces\Item;

interface InventoryItemAgeInterface
{

    // for developing, testing and debugging purpose implement getter to get the days for selling.
    public function getSellIn(): int;

    public function calculatePrice(): void;
}
