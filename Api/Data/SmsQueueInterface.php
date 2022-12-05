<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Api\Data;

/**
 * SmsQueue Interface
 * @author Albert Shen(albertshen1206@gmail.com)
 */
interface SmsQueueInterface
{

    const STORE_ID = 'store_id';
    const PHONE_NUMBER = 'phone_number';
    const TEMPLATE_PATH = 'template_path';
    const MESSAGE_DATA = 'message_data';

    /**
     * Get Store ID
     *
     * @return int|null
     */
    public function getStoreId();

    /**
     * Set Store ID
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($id);

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
     * Get Template Path
     *
     * @return string
     */
    public function getTemplatePath();

    /**
     * Set Template Path
     *
     * @param string $templatePath
     * @return $this
     */
    public function setTemplatePath($templatePath);

    /**
     * Get Message Data
     * 
     * @return mixed
     */
    public function getMessageData();

    /**
     * Set Message Data
     *
     * @param mixed $messageData
     * @return $this
     */
    public function setMessageData($messageData);


}
