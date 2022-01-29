<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AlbertMage\Sms\Api\Data;

/**
 * Interface for sms message search results.
 * @api
 * @since 100.0.2
 */
interface SmsMessageSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get sms message list.
     *
     * @return \AlbertMage\Sms\Api\Data\SocialInterface[]
     */
    public function getItems();

    /**
     * Set sms message list.
     *
     * @param \AlbertMage\Sms\Api\Data\SocialInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
