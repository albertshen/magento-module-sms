<?php

namespace AlbertMage\Sms\Observer\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\ManagerInterface as EventManagerInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use AlbertMage\Sms\Model\Config\SalesSms;
use AlbertMage\Sms\Model\Config\SmsGateway;
use AlbertMage\Sms\Api\Data\SmsQueueInterfaceFactory;

abstract class AbstractSalesObserver implements ObserverInterface, SalesObserverInterface
{

    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * @var SmsGateway
     */
    private $smsGatewayConfig;

    /**
     * @var SalesSms
     */
    private $salesSmsConfig;

    /**
     * @var SmsQueueInterfaceFactory
     */
    private $smsQueueFactory;

    /**
     * Application Event Dispatcher
     *
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * @param PublisherInterface $publisher
     * @param SalesSms $salesSmsConfig
     * @param SmsGateway $smsGatewayConfig
     * @param SmsQueueInterfaceFactory $smsQueueFactory
     * @param EventManagerInterface $eventManager
     */
    public function __construct(
        PublisherInterface $publisher,
        SalesSms $salesSmsConfig,
        SmsGateway $smsGatewayConfig,
        SmsQueueInterfaceFactory $smsQueueFactory,
        EventManagerInterface $eventManager
    ) {
        $this->publisher = $publisher;
        $this->smsGatewayConfig = $smsGatewayConfig;
        $this->salesSmsConfig = $salesSmsConfig;
        $this->smsQueueFactory = $smsQueueFactory;
        $this->eventManager = $eventManager;
    }

    /**
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
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

        $smsQueue = $this->smsQueueFactory->create();
        $smsQueue->setStoreId($order->getStore()->getId());
        $smsQueue->setPhoneNumber($order->getShippingAddress()->getTelephone());
        $smsQueue->setTemplatePath($this->salesSmsConfig->getTemplatePathByEvent($this->getEvent()));
        $smsQueue->setMessageData($messageObject->getData());
        $this->publisher->publish($this->getQueueTopic(), $smsQueue);
    }

}