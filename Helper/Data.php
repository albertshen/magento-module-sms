<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AlbertMage\Sms\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * @var null $storeId
     */
    protected $storeId = null;

    /**
     * @var string $gateway
     */
    protected $gateway;

    /**
     * @param null $store_id
     * @return bool
     */
    public function isActive($store_id = null)
    {
        return $this->scopeConfig->isSetFlag(
            'system/albertsms/active',
            ScopeInterface::SCOPE_STORE,
            $store_id
        );
    }

    /**
     * Get Provider name
     *
     * @return string
     */
    public function getConfigProvider()
    {
        if ($this->provider) {
            return $this->provider;
        }
        return $this->provider = $this->getScopeConfigValue('system/albertsms/provider');
    }

    /**
     * Set Provider name
     *
     * @param string $provider
     * @return $this
     */
    public function setConfigProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * Get system config
     *
     * @param String path
     * @param ScopeInterface::SCOPE_STORE $store
     * @return string
     */
    public function getConfigValue($path)
    {
        $provider = $this->getProvider();
        //return value from core config
        return $this->getScopeConfigValue(
            "system/albertsms/{$provider}/{$path}"
        );
    }

    /**
     * @param String path
     * @param ScopeInterface::SCOPE_STORE $store
     * @return mixed
     */
    public function getScopeConfigValue($path)
    {

        //return value from core config
        return $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE,
            $this->storeId
        );
    }

    /**
     * @return string
     */
    public function setGateway()
    {
        return $this->gateway;
    }

    /**
     * @param string $gateway
     */
    public function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @return int/null
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param int/null $storeId
     */
    public function setStoreId($storeId = null)
    {
        $this->storeId = $storeId;
    }

}
