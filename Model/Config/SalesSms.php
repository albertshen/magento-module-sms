<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use AlbertMage\Notification\Api\NotificationEventInterface;

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
    const XML_PATH_ASYNC_SENDING_ENABLED = 'albert_sales_sms/general/async_sending';
    const XML_PATH_PREFIX = 'albert_sales_sms';

    const XML_PATH_NEW_ORDER_ENABLED = 'albert_sales_sms/setting/new_order_confirmation_enabled';
    const XML_PATH_NEW_ORDER_TEMPLATE = 'sales/new_order_confirmation_template';

    const XML_PATH_NEW_INVOICE_ENABLED = 'albert_sales_sms/setting/new_invoice_enabled';
    const XML_PATH_NEW_INVOICE_TEMPLATE = 'sales/new_invoice_template';

    const XML_PATH_ORDER_UPDATE_ENABLED = 'albert_sales_sms/setting/order_update_enabled';
    const XML_PATH_ORDER_UPDATE_TEMPLATE = 'sales/order_update_template';

    const XML_PATH_NEW_SHIPMENT_ENABLED = 'albert_sales_sms/setting/new_shipment_enabled';
    const XML_PATH_NEW_SHIPMENT_TEMPLATE = 'sales/new_shipment_template';

    const XML_PATH_SHIPMENT_UPDATE_ENABLED = 'albert_sales_sms/setting/shipment_update_enabled';
    const XML_PATH_SHIPMENT_UPDATE_TEMPLATE = 'sales/shipment_update_template';

    const XML_PATH_NEW_CREDIT_MEMO_ENABLED = 'albert_sales_sms/setting/new_credit_memo_enabled';
    const XML_PATH_NEW_CREDIT_MEMO_TEMPLATE = 'sales/new_credit_memo_template';

    const XML_PATH_PAYMENT_CAPTURE_ENABLED = 'albert_sales_sms/setting/new_payment_capture_enabled';
    const XML_PATH_PAYMENT_CAPTURE_TEMPLATE = 'sales/new_payment_capture_template';

    const XML_PATH_CANCEL_ORDER_ENABLED = 'albert_sales_sms/setting/cancel_order_enabled';
    const XML_PATH_CANCEL_ORDER_TEMPLATE = 'sales/cancel_order_template';

    const XML_PATH_ORDER_EXPIRE_NOTICE_ENABLED = 'albert_sales_sms/setting/order_expire_notice_enabled';
    const XML_PATH_ORDER_EXPIRE_NOTICE_TEMPLATE = 'sales/order_expire_notice_template';

    const NEW_ORDER = 'new_order';
    const CANCEL_ORDER = 'order_cancel';
    const ORDER_EXPIRE_NOTICE = 'order_expire_notice';
    const PAYMENT_CAPTURE = 'payment_capture';
    const UPDATE_ORDER = 'update_order';
    const NEW_INVOICE = 'new_invoice';
    const NEW_SHIPMENT = 'new_shipment';
    const UPDATE_SHIPMENT = 'update_shipment';
    const NEW_CREDIT_MEMO = 'new_credit_memo';

    const NOTIFICATION_EVENT_TEMPLATE_MAP = [
        self::NEW_ORDER => self::XML_PATH_NEW_ORDER_TEMPLATE,
        self::UPDATE_ORDER => self::XML_PATH_ORDER_UPDATE_TEMPLATE,
        self::NEW_INVOICE => self::XML_PATH_NEW_INVOICE_TEMPLATE,
        self::NEW_SHIPMENT => self::XML_PATH_NEW_SHIPMENT_TEMPLATE,
        self::UPDATE_SHIPMENT => self::XML_PATH_SHIPMENT_UPDATE_TEMPLATE,
        self::NEW_CREDIT_MEMO => self::XML_PATH_NEW_CREDIT_MEMO_TEMPLATE,
        self::PAYMENT_CAPTURE => self::XML_PATH_PAYMENT_CAPTURE_TEMPLATE,
        self::CANCEL_ORDER => self::XML_PATH_CANCEL_ORDER_TEMPLATE,
        self::ORDER_EXPIRE_NOTICE => self::XML_PATH_ORDER_EXPIRE_NOTICE_TEMPLATE
    ];

    const NOTIFICATION_EVENT_ENABLED_MAP = [
        self::NEW_ORDER => self::XML_PATH_NEW_ORDER_ENABLED,
        self::UPDATE_ORDER => self::XML_PATH_ORDER_UPDATE_ENABLED,
        self::NEW_INVOICE => self::XML_PATH_NEW_INVOICE_ENABLED,
        self::NEW_SHIPMENT => self::XML_PATH_NEW_SHIPMENT_ENABLED,
        self::UPDATE_SHIPMENT => self::XML_PATH_SHIPMENT_UPDATE_ENABLED,
        self::NEW_CREDIT_MEMO => self::XML_PATH_NEW_CREDIT_MEMO_ENABLED,
        self::PAYMENT_CAPTURE => self::XML_PATH_PAYMENT_CAPTURE_ENABLED,
        self::CANCEL_ORDER => self::XML_PATH_CANCEL_ORDER_ENABLED,
        self::ORDER_EXPIRE_NOTICE => self::XML_PATH_ORDER_EXPIRE_NOTICE_ENABLED
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
     * Is sales sms async sending
     *
     * @return bool
     */
    public function isAsyncSending()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ASYNC_SENDING_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStore()->getStoreId()
        );
    }

    /**
     * Is sales sms enabled
     *
     * @return bool
     */
    public function isEnabled($event)
    {
        return $this->scopeConfig->isSetFlag(
            self::NOTIFICATION_EVENT_ENABLED_MAP[$event],
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
        return self::NOTIFICATION_EVENT_TEMPLATE_MAP[$event];
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
