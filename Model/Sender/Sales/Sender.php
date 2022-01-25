<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Sender\Sales;

use AlbertMage\Sms\Model\Container\Template;
use AlbertMage\Sms\Model\Container\IdentityInterface;
use AlbertMage\Sms\Model\senderBuilderFactory;


/**
 * Interface for sms sender.
 * @api
 * @since 100.0.2
 */
class Sender
{
    /**
     * @var Template
     */
    protected $templateContainer;

    /**
     * @var IdentityInterface
     */
    protected $identityContainer;

    /**
     * @var senderBuilderFactory
     */
    protected $senderBuilderFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param SenderOptions $options
     */
    public function __construct(
        Template $templateContainer,
        IdentityInterface $identityContainer,
        senderBuilderFactory $senderBuilderFactory,
        \Psr\Log\LoggerInterface $logger,
    )
    {
        $this->templateContainer = $templateContainer;
        $this->identityContainer = $identityContainer;
        $this->senderBuilderFactory = $senderBuilderFactory;
        $this->logger = $logger;
    }

    /**
     * Send order sms if it is enabled in configuration.
     *
     * @param Order $order
     * @return bool
     */
    public function checkAndSend(Order $order)
    {

        if (!$this->identityContainer->isEnabled()) {
            return false;
        }

        $sender = $this->getSenderBuilder()
            ->setStore($order->getStore())
            ->setTemplateVars($this->templateContainer->getTemplateVars())
            ->setTemplateIdentifier($this->identityContainer->getTemplateIdentifier())
            ->setPhoneNumber('1111111')
            ->getSender();

        try {
            $sender->send();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return false;
        }
        return true;
    }

    /**
     * Create Sender object using appropriate template and identity.
     *
     * @return Sender
     */
    public function getSenderBuilder()
    {
        return $this->senderBuilderFactory->create();
    }
}