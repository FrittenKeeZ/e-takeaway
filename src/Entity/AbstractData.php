<?php

namespace Etakeawa\Entity;

/**
 * AbstractData.
 *
 * @implements \JsonSerializable
 */
abstract class AbstractData implements \JsonSerializable
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
     * Constructor.
     *
     * @param int $partnerId    Unique partner ID.
     * @param int $restaurantId Unique restaurant ID.
     */
    public function __construct($partnerId, $restaurantId)
    {
        $this->partnerId = $partnerId;
        $this->restaurantId = $restaurantId;
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
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array(
            'PartnerID' => $this->partnerId,
            'RestaurantID' => $this->restaurantId,
        );
    }
}
