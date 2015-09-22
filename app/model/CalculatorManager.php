<?php

namespace App\Model;


use Nette\Object;

/**
 * Model operácii kalkulačky.
 * @package App\Model
 */
class CalculatorManager extends Object
{
    /** Definícia konštant pre operácie. */
    const
        ADD = 1,
        SUBTRACT = 2,
        MULTIPLY = 3,
        DIVIDE = 4;

    /**
     * Sčíta dané dáta a vráti výsledok.
     * @param int $x prvé číslo
     * @param int $y druhé číslo
     * @return int výsledok po ščítaní
     */
    public function add($x, $y)
    {
        return $x + $y;
    }

    /**
     * Odčíta dané dáta a vráti výsledok.
     * @param int $x prvé číslo
     * @param int $y druhé číslo
     * @return int výsledok po ščítaní
     */
    public function subtract($x, $y)
    {
        return $x - $y;
    }

    /**
     * Vynásobí dané dáta a vráti výsledok.
     * @param int $x prvé číslo
     * @param int $y druhé číslo
     * @return int výsledok po ščítaní
     */
    public function multiply($x, $y)
    {
        return $x * $y;
    }

    /**
     * Vzdelí dané dáta a vráti výsledok.
     * @param int $x prvé číslo
     * @param int $y druhé číslo
     * @return int výsledok po ščítaní
     */
    public function divide($x, $y)
    {
        return round($x / $y);
    }
    
    public function getOperations()
    {
        return array(
            self::ADD => 'Sčítanie',
            self::SUBTRACT => 'Odčítanie',
            self::MULTIPLY => 'Násobenie',
            self::DIVIDE => 'Delenie'
        );
    }

    /**
     * Zavolá zadanú operáciu a vráti jej výsledok.
     * @param int $operation zadaná operácia
     * @param int $x         prvé číslo pre operáciu
     * @param int $y         druhé číslo pro operáciu
     * @return int|null výsledok operácie alebo null, pokiaľ zadaná operácia neexistuje
     */
    public function calculate($operation, $x, $y)
    {
        switch ($operation) {
            case self::ADD:
                return $this->add($x, $y);
            case self::SUBTRACT:
                return $this->subtract($x, $y);
            case self::MULTIPLY:
                return $this->multiply($x, $y);
            case self::DIVIDE:
                return $this->divide($x, $y);
            default:
                return null;
        }
    }
    
}

