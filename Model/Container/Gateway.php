<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Container;

use Magento\Framework\App\ObjectManager;
use AlbertMage\Sms\Model\GatewayInterface;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
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
        $this->gateways = $gateways;
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
            $instance = ObjectManager::getInstance()->get($this->gateways[$gateway]);
            if (!$instance instanceof GatewayInterface) {
                throw new \InvalidArgumentException(
                    __('gateway should be an instance of GatewayInterface.')
                );
            }
            return $instance;
        }
    }
}
