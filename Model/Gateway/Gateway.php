<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Gateway;

use AlbertMage\Sms\Model\Config\SmsGateway;
use AlbertMage\Sms\Model\TransportInterface;
use AlbertMage\Sms\Model\GatewayInterface;
use AlbertMage\Sms\Model\MessageInterface;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use Psr\Log\LoggerInterface;

abstract class Gateway implements TransportInterface, GatewayInterface
{
    /**
     * @var SmsGateway
     */
    protected $smsGatewayConfig;

    /**
     * @var ResultInterface
     */
    protected $result;

    /**
     * @var string
     */
    protected $timeout;

    /**
     * @var string
     */
    protected $logPath;

    /**
     * @param SmsGateway
     * @param array
     */
    public function __construct(
        SmsGateway $smsGatewayConfig,
        ResultInterface $result
    )
    {
        $this->smsGatewayConfig = $smsGatewayConfig;
        $this->result = $result;
    }

    /**
     * @inheritdoc
     */
    public function send(MessageInterface $message)
    {
        $easySms = new EasySms($this->getOptions());
        try {
            $result = $easySms->send($message->getPhoneNumber(), [
                'template' => $message->getTemplate(),
                'data' => $message->getData()
            ]);
        } catch (NoGatewayAvailableException $e) {
            $result = $e->getResults();
        }
        //$result = ['aliyun' => ['result' => ['BizId' => '33']]];
        //$result = ['yunpian' => ['result' => ['sid' => '999yunpian']]];
        return $this->getResult($result);
    }

    /**
     * @return IdentityInterface
     */
    public function getData()
    {
        return $this->smsGatewayConfig;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        $gateway = $this->smsGatewayConfig->getGateway();
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
