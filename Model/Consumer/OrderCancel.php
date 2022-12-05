<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Consumer;

use AlbertMage\Sms\Api\Data\SmsQueueInterface;

class OrderCancel
{
    
    /**
     * @param SmsQueueInterface $smsQueue
     * @return void
     * @throws \Exception
     */
    public function process(SmsQueueInterface $smsQueue): void
    {
        var_dump($smsQueue->getPhoneNumber(), $smsQueue->getData());
    }


}