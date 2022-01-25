<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Model\MessageInterface;

/**
 * Interface for sms transport.
 * @api
 * @since 100.0.2
 */
interface TransportInterface
{

    /**
     * Send message
     */
    public function send(MessageInterface $message);
}