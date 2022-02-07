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
}