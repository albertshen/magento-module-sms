<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use Magento\Framework\App\ObjectManager;
use AlbertMage\Notification\Api\Data\QueueInterface;
use Magento\Store\Model\StoreManagerInterface;
use AlbertMage\Sms\Model\SenderBuilderFactory;
use AlbertMage\Notification\Api\ResponseInterface;
use AlbertMage\Notification\Model\NotificationFactory;
use AlbertMage\Notification\Model\NotificationRepository;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Consumer
{
    
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var SenderBuilderFactory
     */
    protected $senderBuilderFactory;

    /**
     * @param StoreManagerInterface $storeManager
     * @param SenderBuilderFactory $senderBuilderFactory
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        SenderBuilderFactory $senderBuilderFactory
    )
    {
        $this->storeManager = $storeManager;
        $this->senderBuilderFactory = $senderBuilderFactory;
    }

    /**
     * @param QueueInterface $queue
     * @return void
     * @throws \Exception
     */
    public function process(QueueInterface $queue): void
    {
        $senderBuilder = $this->senderBuilderFactory->create();
        $response = $senderBuilder
            ->setQueue($queue)
            ->getSender()
            ->send();
    }


}