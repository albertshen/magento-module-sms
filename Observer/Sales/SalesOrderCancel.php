<?php

namespace AlbertMage\Sms\Observer\Sales;

use AlbertMage\Sms\Model\Config\SalesSms;

class SalesOrderCancel extends AbstractSalesObserver
{

    const QUEUE_TOPIC = 'sms.order.cancel';

    /**
     * @inheritDoc
     */
    public function getEvent()
    {
        return SalesSms::CANCEL_ORDER;
    }

    /**
     * @inheritDoc
     */
    public function getQueueTopic()
    {
        return self::QUEUE_TOPIC;
    }

}
