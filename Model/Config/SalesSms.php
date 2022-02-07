<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Container
 *
 * @api
 * @since 100.0.2
 */
class SalesSms
{

    /**
     * Configuration paths
     */
    const XML_PATH_SMS_ASYNC_SENDING_ENABLED = 'albert_sales_sms/general/async_sending';
    const XML_PATH_SMS_SENDING_LIMIT = 'albert_sales_sms/general/sending_limit';
    const XML_PATH_PREFIX = 'albert_sales_sms';

    const XML_PATH_SMS_NEW_ORDER_ENABLED = 'albert_sales_sms/setting/new_order_confirmation_enabled';
    const XML_PATH_SMS_NEW_ORDER_TEMPLATE = 'sales/new_order_confirmation_template';

    const XML_PATH_SMS_NEW_INVOICE_ENABLED = 'albert_sales_sms/setting/new_invoice_enabled';
    const XML_PATH_SMS_NEW_INVOICE_TEMPLATE = 'sales/new_invoice_template';

    const XML_PATH_SMS_ORDER_UPDATE_ENABLED = 'albert_sales_sms/setting/order_update_enabled';
    const XML_PATH_SMS_ORDER_UPDATE_TEMPLATE = 'sales/order_update_template';

    const XML_PATH_SMS_NEW_SHIPMENT_ENABLED = 'albert_sales_sms/setting/new_shipment_enabled';
    const XML_PATH_SMS_NEW_SHIPMENT_TEMPLATE = 'sales/new_shipment_template';

    const XML_PATH_SMS_SHIPMENT_UPDATE_ENABLED = 'albert_sales_sms/setting/shipment_update_enabled';
    const XML_PATH_SMS_SHIPMENT_UPDATE_TEMPLATE = 'sales/shipment_update_template';

    const XML_PATH_SMS_NEW_CREDIT_MEMO_ENABLED = 'albert_sales_sms/setting/new_credit_memo_enabled';
    const XML_PATH_SMS_NEW_CREDIT_MEMO_TEMPLATE = 'sales/new_credit_memo_template';

    const SMS_TYPE_NEW_ORDER = 'new_order';
    const SMS_TYPE_UPDATE_ORDER = 'update_order';
    const SMS_TYPE_NEW_INVOICE = 'new_invoice';
    const SMS_TYPE_NEW_SHIPMENT = 'new_shipment';
    const SMS_TYPE_UPDATE_SHIPMENT = 'update_shipment';
    const SMS_TYPE_NEW_CREDIT_MEMO = 'new_credit_memo';

    const SMS_TYPES_TEMPLATE_MAP = [
        self::SMS_TYPE_NEW_ORDER => self::XML_PATH_SMS_NEW_ORDER_TEMPLATE,
        self::SMS_TYPE_UPDATE_ORDER => self::XML_PATH_SMS_ORDER_UPDATE_TEMPLATE,
        self::SMS_TYPE_NEW_INVOICE => self::XML_PATH_SMS_NEW_INVOICE_TEMPLATE,
        self::SMS_TYPE_NEW_SHIPMENT => self::XML_PATH_SMS_NEW_SHIPMENT_TEMPLATE,
        self::SMS_TYPE_UPDATE_SHIPMENT => self::XML_PATH_SMS_SHIPMENT_UPDATE_TEMPLATE,
        self::SMS_TYPE_NEW_CREDIT_MEMO => self::XML_PATH_SMS_NEW_CREDIT_MEMO_TEMPLATE
    ];

    const SMS_TYPES_ENABLED_MAP = [
        self::SMS_TYPE_NEW_ORDER => self::XML_PATH_SMS_NEW_ORDER_ENABLED,
        self::SMS_TYPE_UPDATE_ORDER => self::XML_PATH_SMS_ORDER_UPDATE_ENABLED,
        self::SMS_TYPE_NEW_INVOICE => self::XML_PATH_SMS_NEW_INVOICE_ENABLED,
        self::SMS_TYPE_NEW_SHIPMENT => self::XML_PATH_SMS_NEW_SHIPMENT_ENABLED,
        self::SMS_TYPE_UPDATE_SHIPMENT => self::XML_PATH_SMS_SHIPMENT_UPDATE_ENABLED,
        self::SMS_TYPE_NEW_CREDIT_MEMO => self::XML_PATH_SMS_NEW_CREDIT_MEMO_ENABLED
    ];

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
     * Is sms async sending
     *
     * @return bool
     */
    public function isAsyncSending()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SMS_ASYNC_SENDING_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStore()->getStoreId()
        );
    }

    /**
     * Batch size
     *
     * @return string
     */
    public function getBatchSize()
    {
        return $this->getConfigValue(self::XML_PATH_SMS_SENDING_LIMIT, $this->getStore()->getStoreId());
    }

    /**
     * Is sms enabled
     *
     * @return bool
     */
    public function isEnabled($event)
    {
        return $this->scopeConfig->isSetFlag(
            self::SMS_TYPES_ENABLED_MAP[$event],
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStore()->getStoreId()
        );
    }

    /**
     * Get template path
     *
     * @return string
     */
    public function getTemplatePathByEvent($event)
    {
        return self::SMS_TYPES_TEMPLATE_MAP[$event];
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
