<?php

namespace AlbertMage\Sms\Model\Config;

interface ConfigInterface
{
    /*
     * Config paths for SMS config fields
     */
    const XML_PATH_TRANSACTIONAL_SMS_ENABLED = 'transactional_sms/sms_settings/enabled';
    const XML_PATH_TRANSACTIONAL_SMS_DEFAULT_FROM_NAME = 'transactional_sms/sms_settings/default_sms_from_name';
    const XML_PATH_TRANSACTIONAL_SMS_ALPHANUMERIC_FROM_NAME = 'transactional_sms/sms_settings/alphanumeric_from_name';
    const XML_PATH_SMS_PHONE_NUMBER_VALIDATION = 'transactional_sms/sms_settings/phone_number_validation';
    const XML_PATH_TRANSACTIONAL_SMS_BATCH_SIZE = 'transactional_sms/sms_settings/batch_size';

    const XML_PATH_SMS_NEW_ORDER_ENABLED = 'albert_sales_sms/setting/new_order_confirmation_enabled';
    const XML_PATH_SMS_NEW_ORDER_TEMPLATE = 'new_order_confirmation_template';

    const XML_PATH_SMS_NEW_INVOICE_ENABLED = 'albert_sales_sms/setting/new_invoice_enabled';
    const XML_PATH_SMS_NEW_INVOICE_TEMPLATE = 'new_invoice_template';

    const XML_PATH_SMS_ORDER_UPDATE_ENABLED = 'albert_sales_sms/setting/order_update_enabled';
    const XML_PATH_SMS_ORDER_UPDATE_TEMPLATE = 'order_update_template';

    const XML_PATH_SMS_NEW_SHIPMENT_ENABLED = 'albert_sales_sms/setting/new_shipment_enabled';
    const XML_PATH_SMS_NEW_SHIPMENT_TEMPLATE = 'new_shipment_template';

    const XML_PATH_SMS_SHIPMENT_UPDATE_ENABLED = 'albert_sales_sms/setting/shipment_update_enabled';
    const XML_PATH_SMS_SHIPMENT_UPDATE_TEMPLATE = 'shipment_update_template';

    const XML_PATH_SMS_NEW_CREDIT_MEMO_ENABLED = 'albert_sales_sms/setting/new_credit_memo_enabled';
    const XML_PATH_SMS_NEW_CREDIT_MEMO_TEMPLATE = 'new_credit_memo_template';

    const SMS_TYPE_NEW_ORDER = 'new_order';
    const SMS_TYPE_UPDATE_ORDER = 'update_order';
    const SMS_TYPE_NEW_INVOICE = 'new_invoice';
    const SMS_TYPE_NEW_SHIPMENT = 'new_shipment';
    const SMS_TYPE_UPDATE_SHIPMENT = 'update_shipment';
    const SMS_TYPE_NEW_CREDIT_MEMO = 'new_credit_memo';

    const ALBERT_SMS_MESSAGE_TYPES_MAP = [
        self::SMS_TYPE_NEW_ORDER => self::XML_PATH_SMS_NEW_ORDER_TEMPLATE,
        self::SMS_TYPE_UPDATE_ORDER => self::XML_PATH_SMS_ORDER_UPDATE_TEMPLATE,
        self::SMS_TYPE_NEW_SHIPMENT => self::XML_PATH_SMS_NEW_SHIPMENT_TEMPLATE,
        self::SMS_TYPE_UPDATE_SHIPMENT => self::XML_PATH_SMS_SHIPMENT_UPDATE_TEMPLATE,
        self::SMS_TYPE_NEW_CREDIT_MEMO => self::XML_PATH_SMS_NEW_CREDIT_MEMO_TEMPLATE
    ];
}
