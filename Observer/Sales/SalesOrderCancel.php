<?php

namespace AlbertMage\Sms\Observer\Sales;

use AlbertMage\Sms\Model\Config;

class SalesOrderCancel extends AbstractSalesObserver
{

    const QUEUE_TOPIC = 'sms.order.cancel';

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
        return Config::EVENT_CANCEL_ORDER;
    }

    /**
     * @inheritDoc
     */
    public function getQueueTopic()
    {
        return self::QUEUE_TOPIC;
    }

}
