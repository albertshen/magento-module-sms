<?php
/**
 * Customer social entity resource model
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class SmsMessage
 * @author Albert Shen(albert.shen@phpdigital.com)
 */
class SmsMessage extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('sms_message', 'id');
    }
}
