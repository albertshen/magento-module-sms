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
     * @param Gateway
     * @param MessageInterface
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
        return $transport->send($this->message);
    }

}
