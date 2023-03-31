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
class Yunpian extends AbstractGateway
{

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return [
            'api_key' => $this->config->getGatewayConfigValue('api_key')
        ];
    }

    /**
     * @inheritdoc
     */
    public function getResponse($result)
    {
        $result = $result['yunpian']['result'];
        $response = $this->responseInterfaceFactory->create();
        $response->setSid($result['sid']);
        return $response;
    }

}