<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Gateway;

use AlbertMage\Sms\Model\Container\IdentityInterface;
use AlbertMage\Sms\Model\TransportInterface;
use AlbertMage\Sms\Model\GatewayInterface;
use AlbertMage\Sms\Model\MessageInterface;
use Overtrue\EasySms\EasySms;

abstract class Gateway implements TransportInterface, GatewayInterface
{
    /**
     * @var IdentityInterface
     */
    protected $identityContainer;

    /**
     * @var string
     */
    private $timeout;

    /**
     * @var string
     */
    private $logPath;

    /**
     * @param IdentityInterface
     * @param array
     */
    public function __construct(
        IdentityInterface $identityContainer
    )
    {
        $this->identityContainer = $identityContainer;
    }

    /**
     * @inheritdoc
     */
    public function send(MessageInterface $message)
    {
        $easySms = new EasySms($this->getOptions());
//var_dump($this->getOptions(),$message->getPhoneNumber(), $message->getTemplate(), $message->getData());exit;
        $a = $easySms->send($message->getPhoneNumber(), [
            'template' => $message->getTemplate(),
            'data' => $message->getData()
        ]);
        var_dump($a);exit;
    }

    /**
     * @return IdentityInterface
     */
    public function getData()
    {
        return $this->identityContainer;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        $gateway = $this->identityContainer->getGateway();
        $options = [
            'timeout' => $this->getTimeout() ?? 5,
            'default' => [
                'gateways' => [$gateway]
            ],
            'gateways' => [
                'errorlog' => $this->getLogPath() ?? '/tmp/easy-sms.log',
                $gateway => $this->getConfig()
            ]
        ];
        return $options;
    }

    /**
     * @inheritdoc
     */ 
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @inheritdoc
     */ 
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @inheritdoc
     */ 
    public function getLogPath()
    {
        return $this->logPath;
    }

    /**
     * @inheritdoc
     */ 
    public function setLogPath($logPath)
    {
        $this->logPath = $logPath;
        return $this;
    }
}
