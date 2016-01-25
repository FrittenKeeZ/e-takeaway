<?php

namespace Etakeaway\Entity\Partner;

use Etakeaway\Entity\DataInterface;

/**
 * ExternalOrderBase.
 *
 * @implements DataInterface
 */
class ExternalOrderBase implements DataInterface
{
    /**
     * Unique ID for the partner in the e-takeaway database.
     *
     * @var int
     */
    private $partnerId;

    /**
     * Unique ID for the partner's selected restaurant in the e-takeaway database, where the order was made.
     *
     * @var int
     */
    private $restaurantId;

    /**
     * Unique ID for the original order in the partner's database.
     *
     * @var string
     */
    private $orderId;

    /**
     * Constructor.
     *
     * @param int    $partnerId    Unique partner ID.
     * @param int    $restaurantId Unique restaurant ID.
     * @param string $orderId      Unique order ID.
     */
    public function __construct($partnerId, $restaurantId, $orderId)
    {
        $this->partnerId = (int) $partnerId;
        $this->restaurantId = (int) $restaurantId;
        $this->orderId = (string) $orderId;
    }

    /**
     * Get partner ID.
     *
     * @return int
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * Get restaurant ID.
     *
     * @return int
     */
    public function getRestaurantId()
    {
        return $this->restaurantId;
    }

    /**
     * Get order ID.
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Returns a proper ExternalOrderBase instance even for derived classes.
     *
     * @return ExternalOrderBase
     */
    public function getBase()
    {
        // If this object is an actual ExternalOrderBase instance, just return it.
        if (get_class() === get_class($this)) {
            return $this;
        }

        // Create a new ExternalOrderBase.
        return new self($this->partnerId, $this->restaurantId, $this->orderId);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $json = [
            'PartnerID'    => $this->partnerId,
            'RestaurantID' => $this->restaurantId,
            'OrderID'      => $this->orderId,
        ];

        // Sort array by key for testing consistency.
        ksort($json);

        return $json;
    }
}
