<?php

namespace solution2;

require_once __DIR__ . '/Enums/ItemEnum.php';
require_once __DIR__ . '/Items/Hat.php';
require_once __DIR__ . '/Items/FryingPan.php';
require_once __DIR__ . '/Items/VintageWine.php';
require_once __DIR__ . '/Items/WorldCupTickets.php';
require_once __DIR__ . '/Items/Milk.php';
require_once __DIR__ . '/Items/GoldBar.php';
require_once __DIR__ . '/Interfaces/Item/InventoryItemInterface.php';
require_once __DIR__ . '/Interfaces/Item/InventoryItemWithNoMaxValueConstraintInterface.php';
require_once __DIR__ . '/vendor/Items/AgingInventoryItem.php';

use Exception;
use solution2\Enums\ItemEnum;
use solution2\Interfaces\Item\InventoryItemInterface;
use solution2\Interfaces\Item\InventoryItemWithNoMaxValueConstraintInterface;
use solution2\vendor\Items\AgingInventoryItem;

class InventoryItemFactory
{
    /**
     * Create instance of the inventory item specific class using given item name.
     *
     * @param string $name
     * @param int $price
     * @param int|null $sellIn
     * @return mixed|InventoryItemInterface|InventoryItemWithNoMaxValueConstraintInterface
     * @throws Exception
     */
    public function createInventoryItem(string $name, int $price, ?int $sellIn = null): mixed
    {
        // check for selling days to be above or equal to 0.
        if ($sellIn < 0)
            throw new Exception('The selling days must be above 0 for item ' . $name);

        $itemFullyQualifiedClassName = ItemEnum::getFullyQualifiedClassName($name);
        $itemClass = new $itemFullyQualifiedClassName($name, $price, $sellIn);

        // check for price to not be below 0 and above 50(except for class that implement InventoryItemWithNoMaxValueConstraintInterface).
        if ($price < AgingInventoryItem::ITEM_MINIMUM_PRICE
            || ($price > AgingInventoryItem::ITEM_MAXIMUM_PRICE && !$itemClass instanceof InventoryItemWithNoMaxValueConstraintInterface)
        )
            throw new Exception('The price must be above 0 and below 50 for item ' . $name);

        // the item class if is not implementing the interface InventoryItemInterface trow exception
        if (!$itemClass instanceof InventoryItemInterface)
            throw new Exception('Class ' . $itemFullyQualifiedClassName . ' must implement ' . InventoryItemInterface::class );

        return new $itemClass($name, $price, $sellIn);
    }
}
