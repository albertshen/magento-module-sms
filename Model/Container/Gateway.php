<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Container;

use Magento\Framework\App\ObjectManager;

class Gateway
{

    /**
     * @var array
     */
    protected $gateways;

    /**
     * @param Data
     * @param GatewayInterface[]
     */
    public function __construct(
        array $gateways
    )
    {
        $this->gateways = $gateway;
    }

    public function getGateways()
    {
        return array_keys($this->gateways);
    }

    /**
     * @param sting $gateway
     * @return GatewayInterface
     */
    public function get($gateway)
    {
        if (isset($this->gateways[$gateway])) {
            if (!$gateway instanceof GatewayInterface) {
                throw new \InvalidArgumentException(
                    __('gateway should be an instance of GatewayInterface.')
                );
            }
            return ObjectManager::getInstance()->get($this->gateways[$gateway]);
        }
    }
}
