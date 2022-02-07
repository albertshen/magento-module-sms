<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Model\MessageInterface;
use AlbertMage\Sms\Model\Config\SmsGateway;
use Magento\Store\Model\Store;
use Magento\Framework\App\ObjectManager;

/**
 * Interface for sms sender.
 * @api
 * @since 100.0.2
 */
class SenderBuilder
{
    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * @param SenderOptions $options
     */
    public function __construct(
        SmsGateway $smsGatewayConfig,
        MessageInterface $message
    )
    {
        $this->smsGatewayConfig = $smsGatewayConfig;
        $this->message = $message;
    }

    /**
     * Set store.
     * 
     * @param Store $store
     * @return $this
     */
    public function setStore(Store $store)
    {
        $this->smsGatewayConfig->setStore($store);
        return $this;
    }

    /**
     * Set template vars.
     * 
     * @param string $vars
     * @return $this
     */
    public function setTemplateVars($vars)
    {
        $this->message->setData($vars);
        return $this;
    }

    /**
     * Set templateId.
     * 
     * @param string $templateId
     * @return $this
     */
    public function setTemplateIdentifier($templateId)
    {
        $this->message->setTemplate($templateId);
        return $this;
    }

    /**
     * Set templatePath.
     * 
     * @param string $templatePath
     * @return $this
     */
    public function setTemplatePath($path)
    {
        $this->smsGatewayConfig->setTemplatePath($path);
        $this->setTemplateIdentifier($this->smsGatewayConfig->getTemplateIdentifier());
        return $this;
    }

    /**
     * Set phoneNumber.
     * 
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->message->setPhoneNumber($phoneNumber);
        return $this;
    }

    /**
     * Set phoneNumber.
     * 
     * @param string $phoneNumber
     * @return $this
     */
    public function getSender()
    {
        return ObjectManager::getInstance()->get(Sender::class);
    }

}