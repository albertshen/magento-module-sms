<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Sender\Sales;

use Magento\Sales\Model\Order;

/**
 * Interface for sms sender.
 * @api
 * @since 100.0.2
 */
interface SenderInterface
{
    /**
     * Send order sms if it is enabled in configuration.
     *
     * @param Order $order
     * @return bool
     */
    public function send(Order $order);

}