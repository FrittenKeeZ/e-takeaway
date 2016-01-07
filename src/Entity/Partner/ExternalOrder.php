<?php

namespace Etakeaway\Entity\Partner;

/**
 * ExternalOrder.
 *
 * @see http://api.e-takeaway.com/V1/Documentation/?p=O_ExternalOrder
 *
 * @extends ExternalOrderBase
 */
class ExternalOrder extends ExternalOrderBase
{
    /**
     * External Order ID, a unique identifier in the e-takeaway database.
     *
     * @var int
     */
    private $id;

    /**
     * Shows when the external order was created in the e-takeaway database.
     *
     * @var \DateTime
     */
    private $createDate;

    /**
     * The e-takeaway delivery fee for this order.
     * In normal situations you don't know this value, so you don't have to send it, the API will calculate it.
     * However, if you send anything other than 0, it will be used as delivery fee.
     *
     * @var float
     */
    private $deliveryFee;

    /**
     * The price of the original order, without delivery fee added.
     *
     * @var float
     */
    private $orderPrice;

    /**
     * The total price of the original order, with e-takeaway's delivery fee added.
     *
     * @var float
     */
    private $totalPrice;

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
     * The customer's name.
     *
     * @var string
     */
    private $recipientName;

    /**
     * The customer's address, with street name and number.
     *
     * @var string
     */
    private $recipientAddress;

    /**
     * Additional information for the address.
     *
     * @var string
     */
    private $recipientAddressNotes;

    /**
     * The customer's phone number, where the delivery driver can reach them.
     *
     * @var string
     */
    private $recipientPhone;

    /**
     * The customer's company name, if it's known. Useful when the order goes to an office.
     *
     * @var string
     */
    private $recipientCompany;

    /**
     * The customer's location that can be used for location lookup in the e-takeaway database.
     *
     * @var string
     */
    private $recipientLocation;

    /**
     * The customer's zip code, based on what was sent in RecipientLocation.
     * It's string for non-numeric zip code support.
     *
     * @var string
     */
    private $recipientZip;

    /**
     * The number of people who will eat the ordered food.
     * It's an indicator for restaurants about how many utensils, chopsticks and napkins they should pack.
     *
     * @var int
     */
    private $recipientCount;

    /**
     * The customer's comments for the order, that will be read by the delivery driver too.
     *
     * @var string
     */
    private $orderComments;

    /**
     * Details about the ordered items. You can use \r\n as new line character.
     *
     * @var string
     */
    private $orderDetails;

    /**
     * List of Order\Item entities.
     *
     * @var array<Order\Item>
     */
    private $orderItems = array();

    /**
     * Adds an Order\Item entity to the list.
     *
     * @param Order\Item $item
     */
    public function addOrderItem(Order\Item $item)
    {
        $this->orderItems[] = $item;
    }

    /**
     * Clears the list of Order\Item entities.
     */
    public function clearOrderItems()
    {
        $this->orderItems = array();
    }

    /**
     * Get the list of Order\Item entities.
     *
     * @return array<Order\Item>
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $json = parent::jsonSerialize() + array(
            'OrderDetails' => implode('\r\n', $this->orderItems),
        );

        if ($this->pickupDate) {
            $json['PickupDate'] = $this->formatTime($this->pickupDate);
        }

        if ($this->deliveryDate) {
            $json['DeliveryDate'] = $this->formatTime($this->deliveryDate);
        }

        return $json;
    }
}
