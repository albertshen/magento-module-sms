<?php

namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Api\SmsSalesQueueRepositoryInterface;
use AlbertMage\Sms\Model\Config\SalesSms;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\ObjectManager;

class SmsSalesQueueManager
{
    const SMS_STATUS_PENDING = 0;
    const SMS_STATUS_IN_PROGRESS = 1;
    const SMS_STATUS_DELIVERED = 2;
    const SMS_STATUS_FAILED = 3;
    const SMS_STATUS_EXPIRED = 4;
    const SMS_STATUS_UNKNOWN = 5;

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
     * OrderQueueManager constructor.
     * @param SmsSalesQueueRepositoryInterface $smsSalesQueueRepository
     * @param SalesSms $salesSmsConfig
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        SmsSalesQueueRepositoryInterface $smsSalesQueueRepository,
        SalesSms $salesSmsConfig,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->smsSalesQueueRepository = $smsSalesQueueRepository;
        $this->salesSmsConfig = $salesSmsConfig;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
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

    public function consume($queue)
    {
        $senderBuilder = ObjectManager::getInstance()->get(\AlbertMage\Sms\Model\SenderBuilder::class);
        $sender = $senderBuilder
            ->setTemplatePath($this->salesSmsConfig->getTemplatePathByEvent($queue->getEvent()))
            ->setTemplateVars(json_decode($queue->getMessageData(), true))
            ->setPhoneNumber($queue->getPhoneNumber())
            ->getSender()
            ->send();
        $queue->setMessageId($sender->getId());
        $this->smsSalesQueueRepository->save($queue);
    }

}
