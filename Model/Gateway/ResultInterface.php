<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Gateway;

/**
 * Interface for sms result.
 * @api
 * @since 100.0.2
 */
interface ResultInterface
{

    const SMS_RESULT_STATUS_SUCCESS = 'success';

    const SMS_RESULT_STATUS_FAILURE = 'failure';

    /**
     * Get sid.
     * 
     * @return string
     */
    public function getSid();

    /**
     * Set sid.
     * 
     * @param string $sid
     * @return $this
     */
    public function setSid($sid);

    /**
     * Get status.
     * 
     * @return string
     */
    public function getStatus();

    /**
     * Set status.
     * 
     * @param string $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get response.
     * 
     * @return string
     */
    public function getResponse();

    /**
     * Set response.
     * 
     * @param string $response
     * @return $this
     */
    public function setResponse($response);
}