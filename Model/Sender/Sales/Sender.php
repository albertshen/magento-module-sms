<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Sender\Sales;

use AlbertMage\Sms\Model\Container\IdentityInterface;
use AlbertMage\Sms\Model\SmsSalesQueueManager;
use AlbertMage\Sms\Model\Config\SalesSms;
use AlbertMage\Sms\Model\Config\SmsGateway;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\DataObject;
use Magento\Sales\Model\Order;
use Psr\Log\LoggerInterface;

/**
 * Interface for sms sender.
 * @api
 * @since 100.0.2
 */
abstract class Sender implements SenderInterface
{
    /**
     * Application Event Dispatcher
     *
     * @var ManagerInterface
     */
    protected $eventManager;

    /**
     * @var SmsGateway
     */
    protected $smsGatewayConfig;

    /**
     * @var SalesSms
     */
    protected $salesSmsConfig;

    /**
     * @var SmsSalesQueueManager
     */
    protected $smsSalesQueueManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var string
     */
    protected $event;

    /**
     * @param ManagerInterface $eventManager
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        ManagerInterface $eventManager,
        SalesSms $salesSmsConfig,
        SmsGateway $smsGatewayConfig,
        SmsSalesQueueManager $smsSalesQueueManager,
        LoggerInterface $logger,
        string $event
    )
    {
        $this->eventManager = $eventManager;
        $this->salesSmsConfig = $salesSmsConfig;
        $this->smsGatewayConfig = $smsGatewayConfig;
        $this->smsSalesQueueManager = $smsSalesQueueManager;
        $this->logger = $logger;
        $this->event = $event;

    }

    public function queue(Order $order, DataObject $transportObject)
    {
        $queue = ObjectManager::getInstance()->create(\AlbertMage\Sms\Model\SmsSalesQueue::class);
        $queueRepository = ObjectManager::getInstance()->create(\AlbertMage\Sms\Model\SmsSalesQueueRepository::class);

        $queue->setStoreId($order->getStore()->getId())
            ->setOrderId((int) $order->getId())
            ->setPhoneNumber($order->getShippingAddress()->getTelephone())
            ->setEvent($this->getEvent())
            ->setMessageData(json_encode($transportObject->getData()))
            ->setStatus(SmsSalesQueueManager::SMS_STATUS_PENDING);
        $queueRepository->save($queue);

        $this->salesSmsConfig->setStore($order->getStore());

        if (!$this->salesSmsConfig->isAsyncSending()) {
            try {
                $this->smsSalesQueueManager->consume($queue);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                return false;
            }
            return true;
        }
    }

    public function getEvent()
    {
        return $this->event;
    }

}