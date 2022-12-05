<?php

namespace AlbertMage\Sms\Observer\Sales;

use AlbertMage\Sms\Model\Config\SalesSms;

class SalesOrderPaymentCatpure extends AbstractSalesObserver
{

    const QUEUE_TOPIC = 'sms.payment.capture';

    /**
     * @inheritDoc
     */
    public function getEvent()
    {
        return SalesSms::PAYMENT_CAPTURE;
    }

    /**
     * @inheritDoc
     */
    public function getQueueTopic()
    {
        return self::QUEUE_TOPIC;
    }

}
