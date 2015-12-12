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
        $this->partnerId = $partnerId;
        $this->restaurantId = $restaurantId;
        $this->orderId = $orderId;
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
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array(
            'PartnerID' => $this->partnerId,
            'RestaurantID' => $this->restaurantId,
            'OrderID' => $this->orderId,
        );
    }
}
