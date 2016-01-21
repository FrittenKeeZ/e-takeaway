<?php

namespace Etakeaway\Entity\Partner;

use Etakeaway\Entity\Partner\Order\Item;
use Etakeaway\Entity\Utils\TimeFormatTrait;

/**
 * ExternalOrder.
 *
 * @see http://api.e-takeaway.com/V1/Documentation/?p=O_ExternalOrder
 *
 * @extends ExternalOrderBase
 */
class ExternalOrder extends ExternalOrderBase
{
    use TimeFormatTrait;

    /**
     * External Order ID, a unique identifier in the e-takeaway database.
     *
     * @var int
     */
    private $id = 0;

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
    private $deliveryFee = 0;

    /**
     * The price of the original order, without delivery fee added.
     *
     * @var float
     */
    private $orderPrice = 0;

    /**
     * The total price of the original order, with e-takeaway's delivery fee added.
     *
     * @var float
     */
    private $totalPrice = 0;

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
    private $recipientCount = 0;

    /**
     * The customer's comments for the order, that will be read by the delivery driver too.
     *
     * @var string
     */
    private $orderComments;

    /**
     * List of Order\Item entities.
     *
     * @var array<Order\Item>
     */
    private $orderItems = [];

    /**
     * Get External Order ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get external order created date and time.
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set delivery fee.
     *
     * @param float $deliveryFee
     *
     * @return ExternalOrder
     */
    public function setDeliveryFee($deliveryFee)
    {
        $this->deliveryFee = (float) $deliveryFee;

        return $this;
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
     * Set order price.
     *
     * @param float $orderPrice
     *
     * @return ExternalOrder
     */
    public function setOrderPrice($orderPrice)
    {
        $this->orderPrice = (float) $orderPrice;

        return $this;
    }

    /**
     * Get order price.
     *
     * @return float
     */
    public function getOrderPrice()
    {
        return $this->orderPrice;
    }

    /**
     * Get total order price including e-takeaway's delivery fee.
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set pickup date.
     *
     * @param \DateTime $pickupDate
     *
     * @return ExternalOrder
     */
    public function setPickupDate(\DateTime $pickupDate)
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
     * @return ExternalOrder
     */
    public function setDeliveryDate(\DateTime $deliveryDate)
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
     * Set recipient name.
     *
     * @param string $recipientName
     *
     * @return ExternalOrder
     */
    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;

        return $this;
    }

    /**
     * Get recipient name.
     *
     * @return string
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * Set recipient address.
     *
     * @param string $recipientAddress
     *
     * @return ExternalOrder
     */
    public function setRecipientAddress($recipientAddress)
    {
        $this->recipientAddress = $recipientAddress;

        return $this;
    }

    /**
     * Get recipient address.
     *
     * @return string
     */
    public function getRecipientAddress()
    {
        return $this->recipientAddress;
    }

    /**
     * Set recipient address notes.
     *
     * @param string $recipientAddressNotes
     *
     * @return ExternalOrder
     */
    public function setRecipientAddressNotes($recipientAddressNotes)
    {
        $this->recipientAddressNotes = $recipientAddressNotes;

        return $this;
    }

    /**
     * Get recipient address notes.
     *
     * @return string
     */
    public function getRecipientAddressNotes()
    {
        return $this->recipientAddressNotes;
    }

    /**
     * Set recipient phone.
     *
     * @param string $recipientPhone
     *
     * @return ExternalOrder
     */
    public function setRecipientPhone($recipientPhone)
    {
        $this->recipientPhone = $recipientPhone;

        return $this;
    }

    /**
     * Get recipient phone.
     *
     * @return string
     */
    public function getRecipientPhone()
    {
        return $this->recipientPhone;
    }

    /**
     * Set recipient company.
     *
     * @param string $recipientCompany
     *
     * @return ExternalOrder
     */
    public function setRecipientCompany($recipientCompany)
    {
        $this->recipientCompany = $recipientCompany;

        return $this;
    }

    /**
     * Get recipient company.
     *
     * @return string
     */
    public function getRecipientCompany()
    {
        return $this->recipientCompany;
    }

    /**
     * Set recipient location.
     *
     * @param string $recipientLocation
     *
     * @return ExternalOrder
     */
    public function setRecipientLocation($recipientLocation)
    {
        $this->recipientLocation = $recipientLocation;

        return $this;
    }

    /**
     * Get recipient zip code.
     * This value is based on what is sent in recipient location.
     *
     * @return string
     */
    public function getRecipientZip()
    {
        return $this->recipientZip;
    }

    /**
     * Set recipient count.
     *
     * @param int $recipientCount
     *
     * @return ExternalOrder
     */
    public function setRecipientCount($recipientCount)
    {
        $this->recipientCount = (int) $recipientCount;

        return $this;
    }

    /**
     * Get recipient count.
     *
     * @return int
     */
    public function getRecipientCount()
    {
        return $this->recipientCount;
    }

    /**
     * Set order comments.
     *
     * @param string $orderComments
     *
     * @return ExternalOrder
     */
    public function setOrderComments($orderComments)
    {
        $this->orderComments = $orderComments;

        return $this;
    }

    /**
     * Get order comments.
     *
     * @return string
     */
    public function getOrderComments()
    {
        return $this->orderComments;
    }

    /**
     * Set order details.
     *
     * @param string $orderDetails String representation of order items.
     *                             Expected format is "<amount1>x<name1>\r\n<amount2>x<name2>" etc.
     *                             The item delimiter '\r\n' is litteral and not the ascii codes.
     *
     * @return ExternalOrder
     */
    public function setOrderDetails($orderDetails)
    {
        $this->clearOrderItems();

        $items = explode('\r\n', $orderDetails);
        foreach ($items as $item) {
            $this->orderItems[] = Item::createFromString($item);
        }

        return $this;
    }

    /**
     * Get order details.
     *
     * @return string String representation of order items.
     *                Format is "<amount1>x<name1>\r\n<amount2>x<name2>" etc.
     *                The item delimiter '\r\n' is litteral and not the ascii codes.
     */
    public function getOrderDetails()
    {
        return implode('\r\n', $this->orderItems);
    }

    /**
     * Adds an Order\Item entity to the list.
     *
     * @param Order\Item $item
     */
    public function addOrderItem(Item $item)
    {
        $this->orderItems[] = $item;
    }

    /**
     * Clears the list of Order\Item entities.
     */
    public function clearOrderItems()
    {
        $this->orderItems = [];
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
        $json = parent::jsonSerialize() + [
            'OrderPrice' => $this->orderPrice,
            'RecipientName' => $this->recipientName,
            'RecipientAddress' => $this->recipientAddress,
            'RecipientPhone' => $this->recipientPhone,
            'RecipientLocation' => $this->recipientLocation,
            'OrderDetails' => $this->getOrderDetails(),
        ];

        if ($this->deliveryFee > 0) {
            $json['DeliveryFee'] = $this->deliveryFee;
        }

        if ($this->pickupDate instanceof \DateTime) {
            $json['PickupDate'] = $this->formatTime($this->pickupDate);
        }

        if ($this->deliveryDate instanceof \DateTime) {
            $json['DeliveryDate'] = $this->formatTime($this->deliveryDate);
        }

        if (!empty($this->recipientAddressNotes)) {
            $json['RecipientAddressNotes'] = $this->recipientAddressNotes;
        }

        if (!empty($this->recipientCompany)) {
            $json['RecipientCompany'] = $this->recipientCompany;
        }

        if ($this->recipientCount > 0) {
            $json['RecipientCount'] = $this->recipientCount;
        }

        if (!empty($this->orderComments)) {
            $json['OrderComments'] = $this->orderComments;
        }

        // Sort array by key for testing consistency.
        ksort($json);

        return $json;
    }

    /**
     * Create an ExternalOrder instance from a standard data object.
     *
     * @param \stdClass $data
     *
     * @return ExternalOrder
     */
    public static function createFromData(\stdClass $data)
    {
        $externalOrder = new self($data->PartnerID, $data->RestaurantID, $data->OrderID);
        $externalOrder
            ->setDeliveryFee($data->DeliveryFee)
            ->setOrderPrice($data->OrderPrice)
            ->setPickupDate(new \DateTime($data->PickupDate))
            ->setDeliveryDate(new \DateTime($data->DeliveryDate))
            ->setRecipientName($data->RecipientName)
            ->setRecipientAddress($data->RecipientAddress)
            ->setRecipientAddressNotes($data->RecipientAddressNotes)
            ->setRecipientPhone($data->RecipientPhone)
            ->setRecipientCompany($data->RecipientCompany)
            ->setRecipientCount($data->RecipientCount)
            ->setOrderComments($data->OrderComments)
            ->setOrderDetails($data->OrderDetails)
        ;

        // Create the reflection class.
        $refClass = new \ReflectionClass($externalOrder);
        // Get reflection property for id and set value.
        $refProperty = $refClass->getProperty('id');
        $refProperty->setAccessible(true);
        $refProperty->setValue($externalOrder, $data->ID);
        // Get reflection property for createDate and set value.
        $refProperty = $refClass->getProperty('createDate');
        $refProperty->setAccessible(true);
        $refProperty->setValue($externalOrder, new \DateTime($data->CreateDate));
        // Get reflection property for totalPrice and set value.
        $refProperty = $refClass->getProperty('totalPrice');
        $refProperty->setAccessible(true);
        $refProperty->setValue($externalOrder, $data->TotalPrice);
        // Get reflection property for recipientZip and set value.
        $refProperty = $refClass->getProperty('recipientZip');
        $refProperty->setAccessible(true);
        $refProperty->setValue($externalOrder, $data->RecipientZip);

        return $externalOrder;
    }
}
