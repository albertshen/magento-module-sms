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

    /**
     * @inheritdoc
     */
    public function getResult($result)
    {
        if (isset($result['aliyun']['result'])) {
            $re = $result['aliyun']['result'];
            $this->result->setSid($re['BizId']);
            $this->result->setStatus(ResultInterface::SMS_RESULT_STATUS_SUCCESS);
            $this->result->setResponse(json_encode($re));
        } else {
            $this->result->setStatus(ResultInterface::SMS_RESULT_STATUS_FAILURE);
            $this->result->setResponse(json_encode($result['aliyun']['exception']->raw));
        }
        return $this->result;
    }
}