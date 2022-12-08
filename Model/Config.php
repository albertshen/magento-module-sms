<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
use AlbertMage\Notification\Model\AbstractConfig;

/**
 * Class Config
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Config extends AbstractConfig
{

    const GATEWAY_TYPE = 'sms';

    /**
     * Configuration paths
     */
    const XML_PATH_PREFIX = 'albert_sms';

    /**
     * @inheritdoc
     */
    public function getXmlPathPrefix()
    {
        return self::XML_PATH_PREFIX;
    }
}