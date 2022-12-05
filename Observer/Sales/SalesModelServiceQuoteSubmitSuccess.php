<?php

namespace AlbertMage\Sms\Observer\Sales;

use AlbertMage\Sms\Model\Config\SalesSms;

class SalesModelServiceQuoteSubmitSuccess extends AbstractSalesObserver
{

    const QUEUE_TOPIC = 'sms.order.new';

    /**
     * @inheritDoc
     */
    public function getEvent()
    {
        return SalesSms::NEW_ORDER;
    }

    /**
     * @inheritDoc
     */
    public function getQueueTopic()
    {
        return self::QUEUE_TOPIC;
    }

}
