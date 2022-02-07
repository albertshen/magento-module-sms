<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Api\Data\SmsSalesQueueSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with SmsSalesQueue search results.
 */
class SmsSalesQueueSearchResults extends SearchResults implements SmsSalesQueueSearchResultsInterface
{
}
