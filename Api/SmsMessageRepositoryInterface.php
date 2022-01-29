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
interface SmsMessageRepositoryInterface
{
    /**
     * Save sms message.
     *
     * @param \AlbertMage\Sms\Api\Data\SmsMessageInterface $smsMessage
     * @return \AlbertMage\Sms\Api\Data\SmsMessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\AlbertMage\Sms\Api\Data\SmsMessageInterface $smsMessage);

    /**
     * Retrieve sms message.
     *
     * @param int $smsMessageId
     * @return \AlbertMage\Sms\Api\Data\SmsMessageInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($smsMessageId);

    /**
     * Retrieve sms message matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AlbertMage\Sms\Api\Data\SmsMessageSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
