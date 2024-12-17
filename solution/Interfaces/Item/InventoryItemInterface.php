<?php

namespace solution\Interfaces\Item;

/**
 * Default interface that all inventory items need to implement it.
 */
interface InventoryItemInterface
{
    public function getName(): string;
    public function getValue(): string;
}
