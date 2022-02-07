<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

/**
 * Interface for sms gateway.
 * @api
 * @since 100.0.2
 */
interface GatewayInterface
{
    /**
     * Get sms getway config.
     * 
     * @return string
     */
    public function getConfig();

    /**
     * Get sms message result.
     * 
     * @return array
     */
    public function getResult($result);

    /**
     * @return int
     */ 
    public function getTimeout();

    /**
     * @param int $timeout
     * @return $this
     */ 
    public function setTimeout($timeout);

    /**
     * @return sting
     */ 
    public function getLogPath();

    /**
     * @param int $logPath
     * @return $this
     */ 
    public function setLogPath($logPath);
   
}