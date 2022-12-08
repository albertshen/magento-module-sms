<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

/**
 * Interface for sms gateway.
 * 
 * @author Albert Shen <albertshen1206@gmail.com>
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
     * @return \AlbertMage\Notification\Api\ResponseInterface
     */
    public function getResponse($result);

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