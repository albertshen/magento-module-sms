<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use Magento\Framework\App\ObjectManager;
use AlbertMage\Notification\Api\Data\QueueInterface;
use AlbertMage\Sms\Model\MessageInterfaceFactory;
use AlbertMage\Sms\Model\Config;
use AlbertMage\Notification\Api\Data\NotificationInterfaceFactory;

/**
 * Interface for sms sender.
 * 
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class SenderBuilder
{

    /**
     * @var Config
     */
    private $config;

    /**
     * @var MessageInterfaceFactory
     */
    protected $messageInterfaceFactory;

    /**
     * @var NotificationInterfaceFactory
     */
    protected $notificationInterfaceFactory;

    /**
     * @var QueueInterface
     */
    protected $queue;

        /**
     * @var \AlbertMage\Notification\Api\Data\Notification
     */
    protected $notification;

    /**
     * @param SenderOptions $options
     */
    public function __construct(
        MessageInterfaceFactory $messageInterfaceFactory,
        NotificationInterfaceFactory $notificationInterfaceFactory,
        Config $config
    )
    {
        $this->config = $config;
        $this->message = $messageInterfaceFactory->create();
        $this->notificationInterfaceFactory = $notificationInterfaceFactory;
    }

    /**
     * Set Queue.
     * 
     * @param QueueInterface $queue
     * @return $this
     */
    public function setQueue(QueueInterface $queue)
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * Prepare message.
     * 
     * @return $this
     */
    public function prepareMessageFormQueue()
    {
        $this->config->setStore($this->queue->getStoreId());
        $this->message->setPhoneNumber($this->queue->getTouser());
        $this->message->setTemplate(
            $this->config->getTemplateIdentifier(
                $this->queue->getEvent(),
                $this->queue->getStoreId()
            )
        );
        $this->message->setData(json_decode($this->queue->getMessageData(), true));
        return $this;
    }

    /**
     * Prepare message.
     * 
     * @return $this
     */
    public function prepareStorageNotification()
    {
        $this->notification = $this->notificationInterfaceFactory->create();
        $this->notification
            ->setTouser($this->queue->getTouser())
            ->setStoreId($this->queue->getStoreId())
            ->setCustomerId($this->queue->getCustomerId())
            ->setIncrementId($this->queue->getIncrementId())
            ->setType(Config::GATEWAY_TYPE)
            ->setEvent($this->queue->getEvent())
            ->setTemplateId($this->message->getTemplate())
            ->setMessageData($this->queue->getMessageData())
            ->setGateway($this->config->getGateway());

        return $this;
    }

    /**
     * 
     * @return Sender
     */
    public function getSender()
    {

        $this->prepareMessageFormQueue();

        $this->prepareStorageNotification();

        return ObjectManager::getInstance()->create(
            Sender::class,
            [
                'notification' => $this->notification,
                'gateway' => $this->config->getGateway(),
                'message' => $this->message
            ]
        );
    }

}