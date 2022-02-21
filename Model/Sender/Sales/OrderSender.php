<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Sender\Sales;

use Magento\Sales\Model\Order;
use Magento\Framework\DataObject;

/**
 * Interface for sms sender.
 * @api
 * @since 100.0.2
 */
class OrderSender extends Sender
{

    /**
     * Send order sms if it is enabled in configuration.
     *
     * @param Order $order
     * @return bool
     */
    public function send(Order $order)
    {

        if (!$this->smsGatewayConfig->isEnabled() || !$this->salesSmsConfig->isEnabled($this->getEvent())) {
            return false;
        }

        $transport = [
            'order_id' => $order->getId()
        ];

        //prepare template data
        $transportObject = new DataObject($transport);
        $this->eventManager->dispatch(
            $this->getEvent() . '_set_template_vars_before',
            ['sender' => $this, 'order' => $order, 'transport' => $transportObject]
        );

        $this->queue($order, $transportObject);
    }


}