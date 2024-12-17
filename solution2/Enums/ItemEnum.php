<?php

namespace solution2\Enums;

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
            self::HAT => 'solution2\Items\Hat',
            self::FRYING_PAN => 'solution2\Items\FryingPan',
            self::VINTAGE_WINE => 'solution2\Items\VintageWine',
            self::WORLD_CUP_TICKETS => 'solution2\Items\WorldCupTickets',
            self::MILK => 'solution2\Items\Milk',
            self::GOLD_BAR => 'solution2\Items\GoldBar'
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
}
