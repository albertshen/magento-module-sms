<?php

namespace AlbertMage\Sms\Observer\Sales;

use AlbertMage\Sms\Model\Config\SalesSms;
use AlbertMage\Sms\Model\Config\SmsGateway;
use Magento\Framework\Event\Observer;
use Magento\Framework\DataObject;

class SalesOrderExpireNotice extends AbstractSalesObserver
{

    const QUEUE_TOPIC = 'sms.order.cancel';

    /**
     * @inheritDoc
     */
    public function getEvent()
    {
        return SalesSms::ORDER_EXPIRE_NOTICE;
    }

    /**
     * @inheritDoc
     */
    public function getQueueTopic()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {

        if (!$this->smsGatewayConfig->isEnabled() || !$this->salesSmsConfig->isEnabled($this->getEvent())) {
            return false;
        }

        $order = $observer->getEvent()->getOrder();

        //prepare template data
        $messageObject = new DataObject();
        $this->eventManager->dispatch(
            SmsGateway::GATEWAY . '_' . $this->getEvent() . '_set_template_vars_before',
            ['order' => $order, 'message_object' => $messageObject]
        );

        var_dump('sendSmsExpireNotice', $messageObject);
    }

}
