<?php

namespace Etakeaway\Entity\Partner\Order;

/**
 * Order item.
 */
class Item
{
    /**
     * Item name.
     *
     * @var string
     */
    private $name;

    /**
     * Item amount.
     *
     * @var int
     */
    private $amount;

    /**
     * Constructor.
     *
     * @param string $name   Item name.
     * @param int    $amount Item amount. Defaults to 1.
     */
    public function __construct($name, $amount = 1)
    {
        $this->name = $name;
        // Ensure the amount is at least 1.
        $this->amount = max(1, (int) $amount);
    }

    /**
     * Returns a formatted string representing this item as '<amount>x<name>'.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->amount . 'x' . $this->name;
    }

    /**
     * Creates an Item entity from the provided string in the expected format '<amount>x<name>'.
     *
     * @param string $str
     *
     * @return Item
     */
    public static function createFromString($str)
    {
        list($amount, $name) = explode('x', $str, 2);

        return new Item($name, $amount);
    }
}
