<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AlbertMage\Sms\Model\ResourceModel\SmsMessage;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use AlbertMage\Sms\Model\ResourceModel\SmsMessage;

/**
 * Class Collection
 * @author Albert Shen(albertshen1206@gmail.com)
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\AlbertMage\Sms\Model\SmsMessage::class,
            SmsMessage::class);
    }
}