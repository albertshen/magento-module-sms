<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Api\Data\SmsMessageSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with SmsMessage search results.
 */
class SmsMessageSearchResults extends SearchResults implements SmsMessageSearchResultsInterface
{
}
