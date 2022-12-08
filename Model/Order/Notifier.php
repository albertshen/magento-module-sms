<?php

namespace AlbertMage\Sms\Model\Order;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\ManagerInterface as EventManagerInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use AlbertMage\Sms\Model\Config;
use AlbertMage\Notification\Api\Data\QueueInterfaceFactory;
use AlbertMage\Notification\Model\Order\NotifierInterface;

class Notifier implements NotifierInterface
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
     * @var QueueInterfaceFactory
     */
    private $queueFactory;

    /**
     * Application Event Dispatcher
     *
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * @var string
     */
    private $event;

    /**
     * @var string
     */
    private $queueTopic;

    /**
     * @param PublisherInterface $publisher
     * @param Config $config
     * @param QueueInterfaceFactory $queueFactory
     * @param EventManagerInterface $eventManager
     * @param string $event
     * @param string $queueTopic
     */
    public function __construct(
        PublisherInterface $publisher,
        Config $config,
        QueueInterfaceFactory $queueFactory,
        EventManagerInterface $eventManager,
        $event,
        $queueTopic = null
    ) {
        $this->publisher = $publisher;
        $this->config = $config;
        $this->queueFactory = $queueFactory;
        $this->eventManager = $eventManager;
        $this->event = $event;
        $this->queueTopic = $queueTopic;
    }

    /**
     * @param OrderInterface $order
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function notify(OrderInterface $order)
    {

        if (!$this->config->isEnabled($this->event, $order->getStore()->getId())) {
            return;
        }

        //prepare template data
        $messageObject = new DataObject(['increment_id' => $order->getIncrementId()]);
        $this->eventManager->dispatch(
            Config::GATEWAY_TYPE . '_' . $this->event . '_set_template_vars_before',
            ['order' => $order, 'message_object' => $messageObject]
        );
        
        $queue = $this->queueFactory->create();
        $queue->setStoreId($order->getStore()->getId());
        $queue->setCustomerId($order->getCustomerId());
        $queue->setIncrementId($order->getIncrementId());
        $queue->setEvent($this->event);
        $queue->setTouser($order->getShippingAddress()->getTelephone());
        $queue->setMessageData($messageObject->toJson());
        
        $this->publisher->publish($this->queueTopic, $queue);
    }

}