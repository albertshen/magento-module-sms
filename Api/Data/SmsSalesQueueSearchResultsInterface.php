<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AlbertMage\Sms\Api\Data;

/**
 * Interface for sms sales queue search results.
 * @api
 * @since 100.0.2
 */
interface SmsSalesQueueSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get sms message list.
     *
     * @return \AlbertMage\Sms\Api\Data\SmsSalesQueueInterface[]
     */
    public function getItems();

    /**
     * Set sms message list.
     *
     * @param \AlbertMage\Sms\Api\Data\SmsSalesQueueInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
