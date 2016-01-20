<?php

namespace Etakeaway;

use Etakeaway\Entity\Partner\DeliveryInfo;
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
        return $this->dispatch('CancelExternalOrder', $externalOrder);
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
