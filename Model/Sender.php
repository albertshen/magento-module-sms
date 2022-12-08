<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Model\MessageInterface;
use AlbertMage\Sms\Model\Container\Gateway;
use AlbertMage\Sms\Model\Gateway\Result;
use Magento\Framework\Exception\LocalizedException;
use AlbertMage\Notification\Api\Data\NotificationInterface;
use AlbertMage\Notification\Model\NotificationRepository;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Sender
{
    /**
     * @var string
     */
    private $gateway;

    /**
     * @var Gateway
     */
    private $gatewayContainer;

    /**
     * @var MessageInterface
     */
    private $message;

    /**
     * @var NotificationInterface
     */
    protected $notification;

    /**
     * @var NotificationRepository
     */
    protected $notificationRepository;

    /**
     * @param string $gateway
     * @param Gateway $gatewayContainer
     * @param MessageInterface $message
     * @param NotificationInterface $notification
     * @param NotificationRepository $notificationRepository
     */
    public function __construct(
        $gateway,
        Gateway $gatewayContainer,
        MessageInterface $message,
        NotificationInterface $notification,
        NotificationRepository $notificationRepository
    )
    {
        $this->gateway = $gateway;
        $this->gatewayContainer = $gatewayContainer;
        $this->message = $message;
        $this->notification = $notification;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Send message
     * 
     * @return NotificationInterface
     */
    public function send()
    {
        $transport = $this->gatewayContainer->get($this->gateway);
        $response = $transport->send($this->message);

        $this->notification->setStatus($response->getStatus());
        $this->notification->setSid($response->getSid());
        $this->notification->setResponse($response->getBody());

        //save action
        $this->notificationRepository->save($this->notification);

        return $this->notification;
    }

}
