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
class Result implements ResultInterface
{

    /**
     * @var string
     */
    private $sid;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $response;

    /**
     * @inheritdoc
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * @inheritdoc
     */
    public function setSid($sid)
    {
        $this->sid = $sid;
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritdoc
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @inheritdoc
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}