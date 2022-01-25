<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Container;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Container
 *
 * @api
 * @since 100.0.2
 */
abstract class Container implements IdentityInterface
{

    /**
     * Configuration paths
     */
    const XML_PATH_SMS_ENABLED = 'albert_sms/setting/active';
    const XML_PATH_SMS_GATEWAY = 'albert_sms/setting/gateway';
    const XML_PATH_PREFIX = 'albert_sms';

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Core store config
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var Store
     */
    protected $store;

    /**
     * @var string
     */
    protected $customerPhoneNumber;

    /**
     * @var string
     */
    protected $gateway;

    /**
     * @var string
     */
    protected $customerEmail;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * Return store configuration value
     *
     * @param string $path
     * @param int $storeId
     * @return mixed
     */
    protected function getConfigValue($path, $storeId)
    {
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Is sms enable
     *
     * @return @return bool
     */
    public function isSmsEnable()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SMS_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStore()->getStoreId()
        );
    }

    /**
     * Get gateway
     *
     * @return string
     */
    public function getGateway()
    {
        if ($this->gateway) {
            return $this->gateway;
        }
        return $this->gateway = $this->getConfigValue(self::XML_PATH_SMS_GATEWAY, $this->getStore()->getStoreId());
    }

    /**
     * Set gateway
     *
     * @param string $gateway
     * @return void
     */
    public function setGateway($gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Get gateway base path
     *
     * @return string
     */
    public function getGatewayBasePath()
    {
        return self::XML_PATH_PREFIX . '/' . $this->getGateway();
    }

    /**
     * Get gateway
     *
     * @param string $gateway
     * @return void
     */
    public function getGatewayConifgValue($path)
    {
        return $this->getConfigValue($this->getGatewayBasePath().'/'.$path, $this->getStore()->getStoreId());
    }

    /**
     * Set current store
     *
     * @param Store $store
     * @return void
     */
    public function setStore(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Return store
     *
     * @return Store
     */
    public function getStore()
    {
        //current store
        if ($this->store instanceof Store) {
            return $this->store;
        }
        return $this->storeManager->getStore();
    }
}
