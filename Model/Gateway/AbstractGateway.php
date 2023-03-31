<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Gateway;

use AlbertMage\Sms\Model\Config;
use AlbertMage\Sms\Model\TransportInterface;
use AlbertMage\Sms\Model\GatewayInterface;
use AlbertMage\Sms\Model\MessageInterface;
use AlbertMage\Notification\Api\Data\ResponseInterfaceFactory;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use Psr\Log\LoggerInterface;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
abstract class AbstractGateway implements TransportInterface, GatewayInterface
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var ResponseInterfaceFactory
     */
    protected $responseInterfaceFactory;

    /**
     * @var string
     */
    protected $timeout;

    /**
     * @var string
     */
    protected $logPath;

    /**
     * @param Config $config
     * @param ResponseInterfaceFactory $responseInterfaceFactory
     */
    public function __construct(
        Config $config,
        ResponseInterfaceFactory $responseInterfaceFactory
    )
    {
        $this->config = $config;
        $this->responseInterfaceFactory = $responseInterfaceFactory;
    }

    /**
     * @inheritdoc
     */
    public function send(MessageInterface $message)
    {
        $easySms = new EasySms($this->getOptions());
        try {
            $result = $easySms->send(
                $message->getPhoneNumber(),
                [
                    'template' => $message->getTemplate(),
                    'data' => $message->getData()
                ]
            );
        } catch (NoGatewayAvailableException $e) {
            $result = $e->getResults();
        }
        //$result = ['aliyun' => ['result' => ['BizId' => '33']]];
        //$result = ['yunpian' => ['result' => ['sid' => '999yunpian']]];
        return $this->getResponse($result);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        $gateway = $this->config->getGateway();
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
