<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Container;

use Magento\Store\Model\Store;

/**
 * Interface \AlbertMage\Sms\Model\Container\IdentityInterface
 *
 */
interface IdentityInterface
{
    /**
     * @return bool
     */
    public function isEnabled();

    /**
     * @return mixed
     */
    public function getTemplateIdentifier();

    /**
     * @return Store
     */
    public function getStore();

    /**
     * @param Store $store
     * @return mixed
     */
    public function setStore(Store $store);

}
