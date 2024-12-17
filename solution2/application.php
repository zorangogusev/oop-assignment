<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/InventoryItemFactory.php';
require_once __DIR__ . '/Enums/ItemEnum.php';

use solution2\Interfaces\Item\InventoryItemAgeInterface;
use solution2\InventoryItemFactory;
use solution2\Enums\ItemEnum;


/**
 * To implement new item, need to enter data in solution/Enum/ItemEnum.php
 * and create new class.
 */
$itemsData = [
    [ItemEnum::HAT->getName(), 15, 10],
    [ItemEnum::FRYING_PAN->getName(), 10, 4],
    [ItemEnum::VINTAGE_WINE->getName(), 20, 10],
    [ItemEnum::WORLD_CUP_TICKETS->getName(), 10, 12],
    [ItemEnum::MILK->getName(), 21, 4],
    [ItemEnum::GOLD_BAR->getName(), 80],
];

$inventoryItemFactory = new InventoryItemFactory();
$items = [];
foreach ($itemsData as $itemData) {
    try {
        $items[] = $inventoryItemFactory->createInventoryItem(...$itemData);
    } catch (Exception $e) {
        echo '<b>Exception message:</b> ' . $e->getMessage() . '<br />' . '<b>In file:</b> '
            . $e->getFile() . ' <b>On Line:</b> ' . $e->getLine() . '<br /> <b>Trace:</b> ' . $e->getTraceAsString();
        return;
    }
}

for ($i = 0; $i < 20; $i++) {
    echo 'DAY ' . $i . "\n";
    foreach ($items as $item) {
        echo '<pre>';
        if ($item instanceof InventoryItemAgeInterface) {
            $item->calculatePrice();
        }

        echo $item->getName() . ' Value is: ' . $item->getValue() . "\n";

        // for developing and testing purpose
        if ($item instanceof InventoryItemAgeInterface) {
            echo ' SellIn is: ' . $item->getSellIn();
        }
    }


    echo '<hr>';
    echo "\n";
}
