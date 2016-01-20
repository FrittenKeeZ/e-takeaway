<?php

namespace Etakeaway;

use Etakeaway\Entity\Partner\DeliveryInfo;
use Etakeaway\Entity\Partner\ExternalOrder;
use Etakeaway\Entity\Partner\ExternalOrderBase;

/**
 * Implementation of partner functions.
 *
 * @see http://api.e-takeaway.com/V1/Documentation/?p=P_FunctionsPartner
 *
 * @extends Api
 */
class Partner extends Api
{
    /**
     * Creates an external order for e-takeaway delivery.
     * The same function can edit an existing order.
     *
     * @see http://api.e-takeaway.com/V1/Documentation/?p=F_CreateExternalOrder
     *
     * @param Entity\Partner\ExternalOrder $externalOrder External order to create or update.
     *
     * @return Entity\Response
     */
    public function createExternalOrder(ExternalOrder $externalOrder)
    {
        return $this->dispatch('CreateExternalOrder', $externalOrder);
    }

    /**
     * Cancels an existing external order, by marking it as "To be deleted".
     * It will be still visible for e-takeaway administrators, but they will know that it doesn't have to be delivered anymore.
     *
     * @see http://api.e-takeaway.com/V1/Documentation/?p=F_CancelExternalOrder
     *
     * @param Entity\Partner\ExternalOrderBase $externalOrder External order to cancel.
     *
     * @return Entity\Response
     */
    public function cancelExternalOrder(ExternalOrderBase $externalOrder)
    {
        return $this->dispatch('CancelExternalOrder', $externalOrder->getBase());
    }

    /**
     * Calculates delivery information between the selected restaurant and the customer's location.
     *
     * @see http://api.e-takeaway.com/V1/Documentation/?p=F_GetDeliveryInfo
     *
     * @param Entity\Partner\DeliveryInfo $deliveryInfo Delivery info object.
     *
     * @return Entity\Response
     */
    public function getDeliveryInfo(DeliveryInfo $deliveryInfo)
    {
        return $this->dispatch('GetDeliveryInfo', $deliveryInfo);
    }

    /**
     * Converts data returned from 'GetDeliveryInfo' to a DeliveryInfo entity.
     *
     * @param \stdClass $data
     *
     * @return Entity\Partner\DeliveryInfo
     */
    protected function convertGetDeliveryInfoData(\stdClass $data)
    {
        return DeliveryInfo::createFromData($data);
    }
}
