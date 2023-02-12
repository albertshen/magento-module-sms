<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use AlbertMage\Sms\Model\MessageInterfaceFactory;
use AlbertMage\Sms\Model\Config;
use AlbertMage\Notification\Api\Data\NotificationInterface;

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
     * @var NotificationInterface
     */
    protected $notification;

    /**
     * @var int
     */
    protected $storeId;  

    /**
     * @var string
     */
    protected $phoneNumber;  

    /**
     * @var string
     */
    protected $event; 

    /**
     * @var DataObject
     */
    protected $messageData; 

    /**
     * @param Config $config
     * @param MessageInterfaceFactory $messageInterfaceFactory
     */
    public function __construct(
        Config $config,
        MessageInterfaceFactory $messageInterfaceFactory,
    )
    {
        $this->config = $config;
        $this->message = $messageInterfaceFactory->create();
    }

    /**
     * Set Notification.
     * 
     * @param NotificationInterface $notification
     * @return $this
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
        return $this;
    }

    /**
     * Set Store ID.
     * 
     * @param string $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
        return $this;
    }

    /**
     * Set Phone Number.
     * 
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * Set Event.
     * 
     * @param string $event
     * @return $this
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * Set Message Data.
     * 
     * @param DataObject $messageData
     * @return $this
     */
    public function setMessageData(DataObject $messageData)
    {
        $this->messageData = $messageData;
        return $this;
    }

    /**
     * Prepare message.
     * 
     * @return $this
     */
    public function prepareMessage()
    {
        $this->config->setStore($this->storeId);
        $this->message->setPhoneNumber($this->phoneNumber);
        $this->message->setTemplate(
            $this->config->getTemplateIdentifier(
                $this->event,
                $this->storeId
            )
        );
        $this->message->setData($this->messageData->toArray());
        return $this;
    }

    /**
     * Prepare message.
     * 
     * @return $this
     */
    public function prepareStorageNotification()
    {
        
        $this->notification
            ->setTouser($this->phoneNumber)
            ->setStoreId($this->storeId)
            ->setType(Config::GATEWAY_TYPE)
            ->setEvent($this->event)
            ->setTemplateId($this->message->getTemplate())
            ->setMessageData($this->messageData->toJson())
            ->setGateway($this->config->getGateway());
        return $this;
    }

    /**
     * 
     * @return Sender
     */
    public function getSender()
    {
        $this->prepareMessage();

        if ($this->notification) {
            $this->prepareStorageNotification();
        }

        return ObjectManager::getInstance()->create(
            Sender::class,
            [
                'gateway' => $this->config->getGateway(),
                'message' => $this->message
            ]
        );
    }

}