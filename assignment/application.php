<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/Item.php';

$items = [
    new InventoryItem('Hat', 10, 7),
    new InventoryItem('Frying Pan', 10, 4),
    new InventoryItem('Vintage Wine', 32, 0),
    new InventoryItem('World Cup Tickets', 10, 8),
    new InventoryItem('Milk', 10, 7),
    //new InventoryItem('Gold Bar', 80, 0) not implemented yet
];

for ($i = 0; $i < 10; $i++) {
    echo 'DAY ' . $i . "\n";
    foreach ($items as $item) {
        $item->ageByOneDay();
        echo $item->name() . ': ' . $item->value() . "\n";
    }
    echo "\n";
}
