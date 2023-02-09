<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Model\MessageInterface;
use AlbertMage\Notification\Api\ResponseInterface;

/**
 * Interface for sms transport.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface TransportInterface
{

    /**
     * Send message
     * @return ResponseInterface
     */
    public function send(MessageInterface $message);
}