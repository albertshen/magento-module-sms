<?php

namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Api\SmsSalesQueueRepositoryInterface;
use AlbertMage\Sms\Model\Config\SalesSms;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Stdlib\DateTime;
use Magento\Store\Model\StoreManagerInterface;

class SmsSalesQueueManager
{
    const SMS_STATUS_PENDING = 'pending';
    const SMS_STATUS_IN_PROGRESS = 'in_progress';
    const SMS_STATUS_SENT = 'sent';
    const SMS_STATUS_DELIVERED = 'delivered';
    const SMS_STATUS_FAILED = 'failed';
    const SMS_STATUS_EXPIRED = 'expired';
    const SMS_STATUS_UNKNOWN = 'unknown';

    /**
     * @var SmsSalesQueueRepositoryInterface
     */
    private $smsSalesQueueRepository;

    /**
     * @var SalesSms
     */
    private $salesSmsConfig;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * OrderQueueManager constructor.
     * @param SmsSalesQueueRepositoryInterface $smsSalesQueueRepository
     * @param SalesSms $salesSmsConfig
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        SmsSalesQueueRepositoryInterface $smsSalesQueueRepository,
        SalesSms $salesSmsConfig,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StoreManagerInterface $storeManager,
        DateTime $dateTime
    ) {
        $this->smsSalesQueueRepository = $smsSalesQueueRepository;
        $this->salesSmsConfig = $salesSmsConfig;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->storeManager = $storeManager;
        $this->dateTime = $dateTime;
    }

    /**
     * The pending queue limits by batch size and filters out rows with no phone number.
     *
     * @param array $storeIds
     * @return \Magento\Framework\Api\SearchResults
     */
    public function getPendingQueue(array $storeIds)
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('status', self::SMS_STATUS_PENDING)
            ->addFilter('store_id', [$storeIds], 'in')
            ->addFilter('phone_number', null, 'neq')
            ->setPageSize($this->salesSmsConfig->getBatchSize());

        return $this->smsSalesQueueRepository->getList($searchCriteria->create());
    }

    /**
     * @param array $storeIds
     * @return \Magento\Framework\Api\SearchResults
     */
    public function getInProgressQueue(array $storeIds)
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('status', self::SMS_STATUS_IN_PROGRESS)
            ->addFilter('store_id', [$storeIds], 'in');

        return $this->smsSalesQueueRepository->getList($searchCriteria->create());
    }

    public function batchConsume($queues)
    {
        foreach($queues as $queue) {
            $queue->setStatus(self::SMS_STATUS_IN_PROGRESS);
            $this->smsSalesQueueRepository->save($queue);
        }

        foreach($queues as $queue) {
            var_dump($queue->getId());
            $this->consume($queue);
        }exit;
    }

    public function consume($queue)
    {
        $senderBuilder = ObjectManager::getInstance()->get(\AlbertMage\Sms\Model\SenderBuilder::class);
        $msg = $senderBuilder
            ->setStore($this->storeManager->getStore($queue->getStoreId()))
            ->setTemplatePath($this->salesSmsConfig->getTemplatePathByEvent($queue->getEvent()))
            ->setTemplateVars(json_decode($queue->getMessageData(), true))
            ->setPhoneNumber($queue->getPhoneNumber())
            ->getSender()
            ->send();
        $queue->setSentAt($this->dateTime->formatDate(new \DateTime()));
        $queue->setMessageId($msg->getId());
        if ($msg->getStatus() == 'success') {
            $queue->setStatus(self::SMS_STATUS_SENT);
        } else {
            $queue->setStatus(self::SMS_STATUS_FAILED);
        }
        $this->smsSalesQueueRepository->save($queue);
    }

}
