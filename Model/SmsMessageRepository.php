<?php
/**
 * Sms message entity resource model
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use AlbertMage\Sms\Api\Data\SmsMessageInterface;
use AlbertMage\Sms\Api\Data\smsMessageInterfaceFactory;
use AlbertMage\Sms\Api\Data\SmsMessageSearchResultsInterfaceFactory;
use AlbertMage\Sms\Model\ResourceModel\SmsMessage;
use AlbertMage\Sms\Model\ResourceModel\SmsMessage\CollectionFactory;

/**
 * SmsMessage repository.
 */
class SmsMessageRepository implements \AlbertMage\Sms\Api\SmsMessageRepositoryInterface
{

    /**
     * @var \AlbertMage\Sms\Model\SmsMessageFactory
     */
    protected $smsMessageFactory;

    /**
     * @var \AlbertMage\Sms\Model\ResourceModel\SmsMessage
     */
    protected $smsMessageResourceModel;

    /**
     * @var \AlbertMage\Sms\Api\Data\SmsMessageSearchResultsInterfaceFactory
     */
    protected $smsMessageSearchResultsFactory;

    /**
     * @var \AlbertMage\Sms\Model\ResourceModel\SmsMessage\CollectionFactory
     */
    protected $smsMessageCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param \AlbertMage\Sms\Model\SmsMessageFactory $smsMessageFactory
     * @param \AlbertMage\Sms\Model\ResourceModel\SmsMessage $smsMessageResourceModel
     * @param \AlbertMage\Sms\Api\Data\SmsMessageSearchResultsInterfaceFactory $smsMessageSearchResultsFactory
     * @param \AlbertMage\Sms\Model\ResourceModel\SmsMessage\CollectionFactory $smsMessageCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        \AlbertMage\Sms\Model\SmsMessageFactory $smsMessageFactory,
        \AlbertMage\Sms\Model\ResourceModel\SmsMessage $smsMessageResourceModel,
        \AlbertMage\Sms\Api\Data\SmsMessageSearchResultsInterfaceFactory $smsMessageSearchResultsFactory,
        \AlbertMage\Sms\Model\ResourceModel\SmsMessage\CollectionFactory $smsMessageCollectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->smsMessageFactory = $smsMessageFactory;
        $this->smsMessageResourceModel = $smsMessageResourceModel;
        $this->smsMessageSearchResultsFactory = $smsMessageSearchResultsFactory;
        $this->smsMessageCollectionFactory = $smsMessageCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(\AlbertMage\Sms\Api\Data\SmsMessageInterface $smsMessage)
    {
        $this->smsMessageResourceModel->save($smsMessage);
        return $smsMessage;
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $smsMessage = $this->smsMessageInterfaceFactory->create()->load($id, 'id');
        if (!$smsMessage->getId()) {
            throw new NoSuchEntityException(
                __("The sms message that was requested doesn't exist.")
            );
        }
        return $smsMessage;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->smsMessageCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $items = $collection->getItems();

        /** @var \AlbertMage\Sms\Api\Data\SmsMessageSearchResultsInterface $searchResults */
        $searchResults = $this->smsMessageSearchResultsFactory->create();
        $searchResults->setItems($items);
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
