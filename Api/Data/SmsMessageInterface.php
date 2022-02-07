<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Api\Data;

/**
 * SmsMessage Interface
 * @author Albert Shen(albertshen1206@gmail.com)
 */
interface SmsMessageInterface
{

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'id';
    const PHONE_NUMBER = 'phone_number';
    const TEMPLATE_ID = 'template_id';
    const MESSAGE_DATA = 'message_data';
    const GATEWAY = 'gateway';
    const STATUS = 'status';
    const SID = 'sid';
    const REQUEST = 'request';
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
     * Get Template ID
     *
     * @return string
     */
    public function getTemplateId();

    /**
     * Set Template ID
     *
     * @param string $templateId
     * @return $this
     */
    public function setTemplateId($templateId);

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
     * Get Gateway
     *
     * @return string
     */
    public function getGateway();

    /**
     * Set Gateway
     *
     * @param string $gateway
     * @return $this
     */
    public function setGateway($gateway);

    /**
     * Get Status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set Status
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get Sid
     *
     * @return string
     */
    public function getSid();

    /**
     * Set Status
     *
     * @param string $sid
     * @return $this
     */
    public function setSid($sid);

    /**
     * Get Request
     *
     * @return string
     */
    public function getRequest();

    /**
     * Set Request
     *
     * @param string $request
     * @return $this
     */
    public function setRequest($request);

}
