<?php

namespace AlbertMage\Sms\Observer\Sales;

use AlbertMage\Sms\Model\Config;

class SalesOrderPaymentCatpure extends AbstractSalesObserver
{

    const QUEUE_TOPIC = 'sms.payment.capture';

    // /**
    //  * @inheritDoc
    //  */
    // public function getGroup()
    // {
    //     return Config::EVENT_GROUP_ORDER;
    // }
    
    /**
     * @inheritDoc
     */
    public function getEvent()
    {
        return Config::EVENT_PAYMENT_CAPTURE;
    }

    /**
     * @inheritDoc
     */
    public function getQueueTopic()
    {
        return self::QUEUE_TOPIC;
    }

}
