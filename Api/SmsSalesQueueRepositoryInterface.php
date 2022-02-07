<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Api;

/**
 * Sms message CRUD interface.
 * @since 100.0.2
 */
interface SmsSalesQueueRepositoryInterface
{
    /**
     * Save sms message.
     *
     * @param \AlbertMage\Sms\Api\Data\SmsSalesQueueInterface $smsSalesQueue
     * @return \AlbertMage\Sms\Api\Data\SmsSalesQueueInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\AlbertMage\Sms\Api\Data\SmsSalesQueueInterface $smsSalesQueue);

    /**
     * Retrieve sms message.
     *
     * @param int $smsSalesQueueId
     * @return \AlbertMage\Sms\Api\Data\SmsSalesQueueInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($smsSalesQueueId);

    /**
     * Retrieve sms message matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AlbertMage\Sms\Api\Data\SmsSalesQueueSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
