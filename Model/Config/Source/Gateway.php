<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use AlbertMage\Sms\Model\Container\Gateway as GatewayContainer;

class Gateway implements ArrayInterface
{

    /**
     * @var Gateway
     */
    protected $gatewayContainer;

    /**
     * @param Gateway
     */
    public function __construct(
        GatewayContainer $gatewayContainer
    )
    {
        $this->gatewayContainer = $gatewayContainer;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => 'none', 'label' => __('None')]
        ];
        foreach($this->gatewayContainer->getGateways() as $gateway) {
            array_push($options, ['value' => $gateway, 'label' => __($gateway)]);
        }
        return $options;
    }
}
