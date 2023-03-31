<?php

namespace AlbertMage\Sms\Model\Order;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Framework\DataObject;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\ManagerInterface as EventManagerInterface;
use AlbertMage\Sms\Model\Config;
use AlbertMage\Notification\Model\Order\NotifierInterface;
use AlbertMage\Notification\Api\Data\NotificationInterface;

class Notifier implements NotifierInterface
{

    /**
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param EventManagerInterface $eventManager
     * @param Config $config
     */
    public function __construct(
        EventManagerInterface $eventManager,
        Config $config
    ) {
        $this->eventManager = $eventManager;
        $this->config = $config;
    }

    /**
     * @param OrderInterface $order
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @return void
     */
    public function notify(OrderInterface $order, string $event, NotificationInterface $notification)
    {

        if (!$this->config->isEnabled($event, $order->getStore()->getId())) {
            return $notification;
        }

        //prepare template data
        $messageObject = new DataObject(['increment_id' => $order->getIncrementId()]);
        $this->eventManager->dispatch(
            Config::GATEWAY_TYPE . '_' . $event . '_set_template_vars_before',
            ['order' => $order, 'message_object' => $messageObject]
        );

        $senderBuilder = ObjectManager::getInstance()->get(\AlbertMage\Sms\Model\SenderBuilder::class);

        $response = $senderBuilder
            ->setNotification($notification)
            ->setStoreId($order->getStore()->getId())
            ->setPhoneNumber($order->getShippingAddress()->getTelephone())
            ->setEvent($event)
            ->setMessageData($messageObject)
            ->getSender()
            ->send();

        $notification
            ->setCustomerId($order->getCustomerId())
            ->setIncrementId($order->getIncrementId())
            ->setStatus($response->getStatus())
            ->setSid($response->getSid())
            ->setResponse($response->getBody());

        return $notification;
    }

}