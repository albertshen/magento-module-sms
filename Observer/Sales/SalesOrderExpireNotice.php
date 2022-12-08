<?php

namespace AlbertMage\Sms\Observer\Sales;

use AlbertMage\Sms\Model\Config;
use Magento\Framework\Event\Observer;
use Magento\Framework\DataObject;
use Magento\Framework\App\ObjectManager;

class SalesOrderExpireNotice extends AbstractSalesObserver
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
        return Config::EVENT_ORDER_EXPIRE_NOTICE;
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

        $order = $observer->getEvent()->getOrder();

        // if (!$this->config->isEnabled($this->getEvent(), $order->getStore()->getId())) {
        //     return;
        // }

        //prepare template data
        $messageObject = new DataObject();
        $this->eventManager->dispatch(
            Config::GATEWAY_TYPE . '_' . $this->getEvent() . '_set_template_vars_before',
            ['order' => $order, 'message_object' => $messageObject]
        );

        $senderBuilder = ObjectManager::getInstance()->get(\AlbertMage\Sms\Model\SenderBuilder::class);
        // $msg = $senderBuilder
        //     ->setStore($order->getStore())
        //     ->setTemplatePath($this->salesSmsConfig->getTemplatePathByEvent($this->getEvent()))
        //     ->setTemplateVars($messageObject->getData())
        //     ->setPhoneNumber($order->getShippingAddress()->getTelephone())
        //     ->getSender()
        //     ->send();

        var_dump('sendSmsExpireNotice', $messageObject);
    }

}
