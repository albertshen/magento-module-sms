<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Gateway;

class Aliyun extends Gateway
{

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return [
            'access_key_id' => $this->getData()->getGatewayConifgValue('access_key_id'),
            'access_key_secret' => $this->getData()->getGatewayConifgValue('access_key_secret'),
            'sign_name' => $this->getData()->getGatewayConifgValue('sign_name')
        ];
    }

}