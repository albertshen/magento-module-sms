<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Model\Config\SmsGateway;
use AlbertMage\Sms\Model\MessageInterface;
use AlbertMage\Sms\Model\Container\Gateway;
use AlbertMage\Sms\Model\Gateway\Result;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;

class Sender
{
    /**
     * @var SmsGateway
     */
    private $smsGatewayConfig;

    /**
     * @var Gateway
     */
    private $gatewayContainer;

    /**
     * @var MessageInterface
     */
    private $message;

    /**
     * @param SmsGateway
     * @param array
     */
    public function __construct(
        SmsGateway $smsGatewayConfig,
        Gateway $gatewayContainer,
        MessageInterface $message
    )
    {
        $this->smsGatewayConfig = $smsGatewayConfig;
        $this->gatewayContainer = $gatewayContainer;
        $this->message = $message;
    }

    /**
     * Send message
     */
    public function send()
    {
        $transport = $this->gatewayContainer->get($this->smsGatewayConfig->getGateway());
        $result = $transport->send($this->message);
        return $this->saveMessage($this->message, $result);
    }

    public function saveMessage(MessageInterface $message, Result $result)
    {
        $smsMessage = ObjectManager::getInstance()->create(\AlbertMage\Sms\Model\SmsMessage::class);
        $smsMessageRepository = ObjectManager::getInstance()->create(\AlbertMage\Sms\Model\SmsMessageRepository::class);
        $smsMessage->setPhoneNumber($message->getPhoneNumber());
        $smsMessage->setMessageData(json_encode($message->getData()));
        $smsMessage->setTemplateId($message->getTemplate());
        $smsMessage->setGateway($this->smsGatewayConfig->getGateway());
        $smsMessage->setSid($result->getSid());
        $smsMessage->setStatus($result->getStatus());
        $smsMessage->setResponse($result->getResponse());
        $smsMessageRepository->save($smsMessage);
        return $smsMessage;
    }

}
