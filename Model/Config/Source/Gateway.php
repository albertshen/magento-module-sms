<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use AlbertMage\Sms\Model\Container\Gateway;

class Gateway implements ArrayInterface
{

    /**
     * @var array
     */
    protected $gateways;

    /**
     * @param Gateway
     */
    public function __construct(
        array $gateways
    )
    {
        $this->gateways = $gateway;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => 'none', 'label' => __('None')]
        ];
        foreach($this->gateways as $gateway) {
            array_push($options, [
                ['value' => $gateway, 'label' => __($gateway)]
            ])
        }
        return $options;
    }
}
