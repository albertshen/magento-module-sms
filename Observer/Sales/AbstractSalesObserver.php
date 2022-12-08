<?php

namespace AlbertMage\Sms\Observer\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\ManagerInterface as EventManagerInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use AlbertMage\Sms\Model\Config;
use AlbertMage\Sms\Api\Data\SmsQueueInterfaceFactory;

abstract class AbstractSalesObserver implements ObserverInterface, SalesObserverInterface
{

    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * @var Config
     */
    private $config;

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
     * @param Config $config
     * @param SmsQueueInterfaceFactory $smsQueueFactory
     * @param EventManagerInterface $eventManager
     */
    public function __construct(
        PublisherInterface $publisher,
        Config $config,
        SmsQueueInterfaceFactory $smsQueueFactory,
        EventManagerInterface $eventManager
    ) {
        $this->publisher = $publisher;
        $this->config = $config;
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

        $order = $observer->getEvent()->getOrder();

        // if (!$this->config->isEnabled($this->getEvent(), $order->getStore()->getId())) {
        //     return;
        // }

        //prepare template data
        $messageObject = new DataObject(['increment_id' => $order->getIncrementId()]);
        $this->eventManager->dispatch(
            Config::GATEWAY_TYPE . '_' . $this->getEvent() . '_set_template_vars_before',
            ['order' => $order, 'message_object' => $messageObject]
        );
        
        $smsQueue = $this->smsQueueFactory->create();
        $smsQueue->setStoreId($order->getStore()->getId());
        $smsQueue->setCustomerId($order->getCustomerId());
        $smsQueue->setIncrementId($order->getIncrementId());
        $smsQueue->setEvent($this->getEvent());
        $smsQueue->setPhoneNumber($order->getShippingAddress()->getTelephone());
        $smsQueue->setMessageData($messageObject->toJson());
        $this->publisher->publish($this->getQueueTopic(), $smsQueue);
    }

}