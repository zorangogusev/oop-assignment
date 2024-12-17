<?php


final class InventoryItem
{

    public function __construct(private $name, private $value, private $sellIn)
    {
    }

    public function name()
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

    public function ageByOneDay()
    {
        if ($this->name != 'Vintage Wine' and $this->name != 'World Cup Tickets') {
            if ($this->value > 0) {
                if ($this->name != 'Gold Bar') {
                    $this->value = $this->value - 1;
                }
            }
        } else {
            if ($this->value < 50) {
                $this->value = $this->value + 1;

                if ($this->name == 'World Cup Tickets') {
                    if ($this->sellIn < 11) {
                        if ($this->value < 50) {
                            $this->value = $this->value + 1;
                        }
                    }
                    if ($this->sellIn < 6) {
                        if ($this->value < 50) {
                            $this->value = $this->value + 1;
                        }
                    }
                }
            }
        }

        if ($this->name != 'Gold Bar') {
            $this->sellIn = $this->sellIn - 1;
        }

        if ($this->sellIn < 0) {
            if ($this->name != 'Vintage Wine') {
                if ($this->name != 'World Cup Tickets') {
                    if ($this->value > 0) {
                        if ($this->name != 'Gold Bar') {
                            $this->value = $this->value - 1;
                        }
                    }
                } else {
                    $this->value = $this->value - $this->value;
                }
            } else {
                if ($this->value < 50) {
                    $this->value = $this->value + 1;
                }
            }
        }
    }
}
