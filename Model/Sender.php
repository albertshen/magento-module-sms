<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Model\MessageInterface;
use AlbertMage\Sms\Model\Container\Gateway;
use Magento\Framework\Exception\LocalizedException;
use AlbertMage\Notification\Api\ResponseInterface;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Sender
{
    /**
     * @var string
     */
    private $gateway;

    /**
     * @var Gateway
     */
    private $gatewayContainer;

    /**
     * @var MessageInterface
     */
    private $message;

    /**
     * @param string $gateway
     * @param Gateway $gatewayContainer
     * @param MessageInterface $message
     */
    public function __construct(
        $gateway,
        Gateway $gatewayContainer,
        MessageInterface $message
    )
    {
        $this->gateway = $gateway;
        $this->gatewayContainer = $gatewayContainer;
        $this->message = $message;
    }

    /**
     * Send message
     * 
     * @return ResponseInterface
     */
    public function send()
    {
        $transport = $this->gatewayContainer->get($this->gateway);
        $response = $transport->send($this->message);
        return $response;
    }

}
