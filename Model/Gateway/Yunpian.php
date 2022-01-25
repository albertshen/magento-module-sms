<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Gateway;

class Yunpian extends Gateway
{

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return [
            'api_key' => $this->getData()->getGatewayConifgValue('api_key')
        ];
    }

}