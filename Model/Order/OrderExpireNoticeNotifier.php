<?php

namespace AlbertMage\Sms\Model\Order;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Framework\DataObject;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\ManagerInterface as EventManagerInterface;
use AlbertMage\Sms\Model\Config;
use AlbertMage\Notification\Model\Order\NotifierInterface;
use AlbertMage\Notification\Api\Data\QueueInterfaceFactory;

class OrderExpireNoticeNotifier implements NotifierInterface
{

    /**
     * @var string
     */
    private $event;

    /**
     * @var QueueInterfaceFactory
     */
    private $queueFactory;

    /**
     * @param Config $config
     * @param EventManagerInterface $eventManager
     * @param QueueInterfaceFactory $queueFactory
     * @param string $event
     */
    public function __construct(
        Config $config,
        EventManagerInterface $eventManager,
        QueueInterfaceFactory $queueFactory,
        $event
    ) {
        $this->config = $config;
        $this->eventManager = $eventManager;
        $this->queueFactory = $queueFactory;
        $this->event = $event;
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
        $messageObject = new DataObject();
        $this->eventManager->dispatch(
            Config::GATEWAY_TYPE . '_' . $this->event . '_set_template_vars_before',
            ['order' => $order, 'message_object' => $messageObject]
        );

        $senderBuilder = ObjectManager::getInstance()->get(\AlbertMage\Sms\Model\SenderBuilder::class);

        $queue = $this->queueFactory->create();
        $queue->setStoreId($order->getStore()->getId());
        $queue->setCustomerId($order->getCustomerId());
        $queue->setIncrementId($order->getIncrementId());
        $queue->setEvent($this->event);
        $queue->setTouser($order->getShippingAddress()->getTelephone());
        $queue->setMessageData($messageObject->toJson());

        $response = $senderBuilder
            ->setQueue($queue)
            ->getSender()
            ->send();
    }

}