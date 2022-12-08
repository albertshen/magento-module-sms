<?php

namespace AlbertMage\Sms\Observer\Sales;

use AlbertMage\Sms\Model\Config;

class SalesModelServiceQuoteSubmitSuccess extends AbstractSalesObserver
{

    const QUEUE_TOPIC = 'sms.order.new';

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
        return Config::EVENT_NEW_ORDER;
    }

    /**
     * @inheritDoc
     */
    public function getQueueTopic()
    {
        return self::QUEUE_TOPIC;
    }

}
