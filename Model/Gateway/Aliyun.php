<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Gateway;

use AlbertMage\Notification\Api\Data\ResponseInterface;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Aliyun extends AbstractGateway
{
    
    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return [
            'access_key_id' => $this->config->getGatewayConfigValue('access_key_id'),
            'access_key_secret' => $this->config->getGatewayConfigValue('access_key_secret'),
            'sign_name' => $this->config->getGatewayConfigValue('sign_name')
        ];
    }

    /**
     * @inheritdoc
     */
    public function getResponse($result)
    {
        $response = $this->responseInterfaceFactory->create();
        if (isset($result['aliyun']['result'])) {
            $re = $result['aliyun']['result'];
            $response->setSid($re['BizId']);
            $response->setStatus(ResponseInterface::STATUS_SUCCESS);
            $response->setBody(json_encode($re), JSON_UNESCAPED_UNICODE);
        } else {
            $response->setStatus(ResponseInterface::STATUS_FAILURE);
            $response->setBody(json_encode($result['aliyun']['exception']->raw, JSON_UNESCAPED_UNICODE));
        }
        return $response;
    }
}