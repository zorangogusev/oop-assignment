<?php

namespace solution\Enums;

use Exception;

enum ItemEnum
{
    case HAT;
    case FRYING_PAN;
    case VINTAGE_WINE;
    case WORLD_CUP_TICKETS;
    case MILK;
    case GOLD_BAR;

    /**
     * Get the name of the enum case.
     *
     * @return string
     */
    public function getName(): string
    {
        return match($this) {
            self::HAT => 'Hat',
            self::FRYING_PAN => 'Frying Pan',
            self::VINTAGE_WINE => 'Vintage Wine',
            self::WORLD_CUP_TICKETS => 'World Cup Tickets',
            self::MILK => 'Milk',
            self::GOLD_BAR => 'Gold Bar',
        };
    }

    /**
     * Get the full qualified class name.
     *
     * @return string
     */
    public function getFullyClassName(): string
    {
        return match($this) {
            self::HAT => 'solution\Items\Hat',
            self::FRYING_PAN => 'solution\Items\FryingPan',
            self::VINTAGE_WINE => 'solution\Items\VintageWine',
            self::WORLD_CUP_TICKETS => 'solution\Items\WorldCupTickets',
            self::MILK => 'solution\Items\Milk',
            self::GOLD_BAR => 'solution\Items\GoldBar',
        };
    }

    /**
     * Find the full class qualified name by given name.
     * If the name doesn't exist return exception.
     *
     * @throws Exception
     */
    public static function getFullyQualifiedClassName(string $name): string
    {

        foreach (self::cases() as $case) {
            if ($case->getName() == $name) {
                return $case->getFullyClassName();
            }
        }

        throw new Exception('Unknown Item Name: ' . $name);
    }

    /**
     * Check if the inventory item is aging.
     *
     * @return bool
     */
    public function isAging(): bool
    {
        return match($this) {
            self::HAT => true,
            self::FRYING_PAN => true,
            self::VINTAGE_WINE => true,
            self::WORLD_CUP_TICKETS => true,
            self::MILK => true,
            self::GOLD_BAR => false,
        };
    }

    /**
     * Check if inventory item is aging by given/its name.
     *
     * @param string $name
     * @return bool
     * @throws Exception
     */
    public static function checkIfIsAgingByGivenName(string $name): bool
    {
        foreach (self::cases() as $case) {
            if ($case->getName() == $name) {
                return $case->isAging();
            }
        }

        throw new Exception('Unknown Item Name: ' . $name);
    }
}
