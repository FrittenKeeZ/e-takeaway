<?php

namespace Etakeaway\Entity\Partner;

use Etakeaway\Entity\DataInterface;
use Etakeaway\Entity\Utils\TimeFormatTrait;

/**
 * DeliveryInfo.
 *
 * @see http://api.e-takeaway.com/V1/Documentation/?p=O_DeliveryInfo
 *
 * @implements DataInterface
 *
 * @uses TimeFormatTrait
 */
class DeliveryInfo implements DataInterface
{
    use TimeFormatTrait;

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
     * The customer's location that can be used for location lookup in the e-takeaway database.
     *
     * @var string
     */
    private $location;

    /**
     * The date and time when the order should be picked up by the delivery driver.
     *
     * @var \DateTime
     */
    private $pickupDate;

    /**
     * The date and time when the order should be delivered to the customer.
     *
     * @var \DateTime
     */
    private $deliveryDate;

    /**
     * The system-wide delivery delay time in minutes.
     *
     * @var int
     */
    private $deliveryDelayTime;

    /**
     * The calculated delivery time in minutes, including DeliveryDelayTime.
     *
     * @var int
     */
    private $deliveryTime;

    /**
     * The calculated delivery fee in the country's default currency.
     *
     * @var float
     */
    private $deliveryFee;

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
     * Set location.
     *
     * @param string $location
     *
     * @return DeliveryInfo
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Set pickup date.
     *
     * @param \DateTime $pickupDate
     *
     * @return DeliveryInfo
     */
    public function setPickupDate($pickupDate)
    {
        $this->pickupDate = $pickupDate;

        return $this;
    }

    /**
     * Get pickup date.
     *
     * @return \DateTime
     */
    public function getPickupDate()
    {
        return $this->pickupDate;
    }

    /**
     * Set delivery date.
     *
     * @param \DateTime $deliveryDate
     *
     * @return DeliveryInfo
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    /**
     * Get delivery date.
     *
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * Get delivery delay time.
     *
     * @return int
     */
    public function getDeliveryDelayTime()
    {
        return $this->deliveryDelayTime;
    }

    /**
     * Get delivery time.
     *
     * @return int
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     * Get delivery fee.
     *
     * @return float
     */
    public function getDeliveryFee()
    {
        return $this->deliveryFee;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $json = array(
            'PartnerID' => $this->partnerId,
            'RestaurantID' => $this->restaurantId,
            'Location' => $this->location,
        );

        if ($this->pickupDate) {
            $json['PickupDate'] = $this->formatTime($this->pickupDate);
        }

        if ($this->deliveryDate) {
            $json['DeliveryDate'] = $this->formatTime($this->deliveryDate);
        }

        return $json;
    }

    /**
     * Create a DeliveryInfo instance from a standard data object.
     *
     * @param \stdClass $data
     *
     * @return DeliveryInfo
     */
    public static function createFromData(\stdClass $data)
    {
        $deliveryInfo = new DeliveryInfo($data->PartnerID, $data->RestaurantID);
        $deliveryInfo
            ->setPickupDate(new \DateTime($data->PickupDate))
            ->setDeliveryDate(new \DateTime($data->DeliveryDate))
        ;

        // Create the reflection class.
        $refClass = new \ReflectionClass($deliveryInfo);
        // Get reflection property for deliveryDelayTime and set value.
        $refProperty = $refClass->getProperty('deliveryDelayTime');
        $refProperty->setAccessible(true);
        $refProperty->setValue($deliveryInfo, $data->DeliveryDelayTime);
        // Get reflection property for deliveryTime and set value.
        $refProperty = $refClass->getProperty('deliveryTime');
        $refProperty->setAccessible(true);
        $refProperty->setValue($deliveryInfo, $data->DeliveryTime);
        // Get reflection property for deliveryFee and set value.
        $refProperty = $refClass->getProperty('deliveryFee');
        $refProperty->setAccessible(true);
        $refProperty->setValue($deliveryInfo, $data->DeliveryFee);

        return $deliveryInfo;
    }
}
