<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Api\Data;

/**
 * SmsSalesQueue Interface
 * @author Albert Shen(albertshen1206@gmail.com)
 */
interface SmsSalesQueueInterface
{

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'id';
    const STORE_ID = 'store_id';
    const ORDER_ID = 'order_id';
    const PHONE_NUMBER = 'phone_number';
    const EVENT = 'event';
    const MESSAGE_DATA = 'message_data';
    const STATUS = 'status';
    const MESSAGE_ID = 'message_id';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get Store ID
     *
     * @return string
     */
    public function getStoreId();

    /**
     * Set store ID
     *
     * @param string $storeId
     * @return $this
     */
    public function setStoreId($storeId);

    /**
     * Get order ID
     *
     * @return string
     */
    public function getOrderId();

    /**
     * Set Order ID
     *
     * @param string $orderId
     * @return $this
     */
    public function setOrderId($orderId);

    /**
     * Get Phone number
     *
     * @return string
     */
    public function getPhoneNumber();

    /**
     * Set Phone number
     *
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent();

    /**
     * Set event
     *
     * @param string $event
     * @return $this
     */
    public function setEvent($event);

    /**
     * Get Message Data
     *
     * @return array
     */
    public function getMessageData();

    /**
     * Set Message Data
     *
     * @param string $messageData
     * @return $this
     */
    public function setMessageData($messageData);

    /**
     * Get Status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set Status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get message id
     *
     * @return int
     */
    public function getMessageId();

    /**
     * Set message id
     *
     * @param int $messageId
     * @return $this
     */
    public function setMessageId($messageId);

}
