<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use Magento\Framework\Model\AbstractModel;
use AlbertMage\Sms\Api\Data\SmsQueueInterface;

/**
 * Class Notification
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class SmsQueue extends AbstractModel implements SmsQueueInterface
{
    /**
     * @inheritDoc
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setStoreId($storeId)
    {
        $this->setData(self::STORE_ID, $storeId);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPhoneNumber()
    {
        return $this->getData(self::PHONE_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->setData(self::PHONE_NUMBER, $phoneNumber);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTemplatePath()
    {
        return $this->getData(self::TEMPLATE_PATH);
    }

    /**
     * @inheritDoc
     */
    public function setTemplatePath($templatePath)
    {
        $this->setData(self::TEMPLATE_PATH, $templatePath);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMessageData()
    {
        return $this->getData(self::MESSAGE_DATA);
    }

    /**
     * @inheritDoc
     */
    public function setMessageData($messageData)
    {
        $this->setData(self::MESSAGE_DATA, $messageData);
        return $this;
    }
    
}