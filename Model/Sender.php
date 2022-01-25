<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Model\Container\IdentityInterface;
use AlbertMage\Sms\Model\MessageInterface;
use AlbertMage\Sms\Model\Container\Gateway;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;
use Psr\Log\LoggerInterface;

class Sender
{
    /**
     * @var IdentityInterface
     */
    private $identityContainer;

    /**
     * @var Gateway
     */
    private $gatewayContainer;

    /**
     * @var MessageInterface
     */
    private $message;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @param IdentityInterface
     * @param array
     */
    public function __construct(
        IdentityInterface $identityContainer,
        Gateway $gatewayContainer,
        MessageInterface $message,
        LoggerInterface $logger
    )
    {
        $this->identityContainer = $identityContainer;
        $this->gatewayContainer = $gatewayContainer;
        $this->message = $message;
        $this->logger = $logger;
    }

    /**
     * Send message
     */
    public function send()
    {
        $transport = $this->gatewayContainer->get($this->identityContainer->getGateway());
        try {
            $transport->send($this->message);
        } catch (\Exception $e) {
            $this->logger->error($e);
            throw new LocalizedException(new Phrase('Unable to send sms. Please try again later.'));
        }
    }

}
