<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use Magento\Framework\Model\AbstractModel;
use AlbertMage\Sms\Api\Data\SmsMessageInterface;

/**
 * Class SmsMessage
 * @author Albert Shen(albertshen1206@gmail.com)
 */
class SmsMessage extends AbstractModel implements SmsMessageInterface
{
    
    /**
     * Initialize sms message model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\AlbertMage\Sms\Model\ResourceModel\SmsMessage::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        $this->setData(self::ID, $id);
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
    public function getTemplateId()
    {
        return $this->getData(self::TEMPLATE_ID);
    }
    
    /**
     * @inheritDoc
     */
    public function setTemplateId($templateId)
    {
        $this->setData(self::TEMPLATE_ID, $templateId);
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

    /**
     * @inheritDoc
     */
    public function getGateway()
    {
        return $this->getData(self::GATEWAY);
    }

    /**
     * @inheritDoc
     */
    public function setGateway($gateway)
    {
        $this->setData(self::GATEWAY, $gateway);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSid()
    {
        return $this->getData(self::SID);
    }

    /**
     * @inheritDoc
     */
    public function setSid($sid)
    {
        $this->setData(self::SID, $sid);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRequest()
    {
        return $this->getData(self::REQUEST);
    }

    /**
     * @inheritDoc
     */
    public function setRequest($request)
    {
        $this->setData(self::REQUEST, $request);
        return $this;
    }

}
