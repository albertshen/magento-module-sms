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
        return $this->setData(self::ID, $id);
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
    public function setTemplateId($templateId)
    {
        return $this->setData(self::TEMPLATE_ID, $templateId);
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
    public function setPhoneNumber($phoneNumber)
    {
        return $this->setData(self::PHONE_NUMBER, $phoneNumber);
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
        return $this->setData(self::MESSAGE_DATA, $data);
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
        return $this->setData(self::GATEWAY, $gateway);
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
        return $this->setData(self::STATUS, $status);
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
        return $this->setData(self::SID, $sid);
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
        return $this->setData(self::REQUEST, $request);
    }

}
