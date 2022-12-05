<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Model\MessageInterface;
use AlbertMage\Sms\Model\Gateway\ResultInterface;

/**
 * Interface for sms transport.
 * @api
 * @since 100.0.2
 */
interface TransportInterface
{

    /**
     * Send message
     * @return ResultInterface
     */
    public function send(MessageInterface $message);
}