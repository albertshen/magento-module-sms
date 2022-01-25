<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Container;

/**
 * Identity
 */
class Identity extends Container implements IdentityInterface
{

    /**
     * Is email enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_EMAIL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStore()->getStoreId()
        );
    }

    /**
     * Get template path
     *
     * @return string
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }

    /**
     * Return template id
     *
     * @return mixed
     */
    public function getTemplateIdentifier()
    {
        return $this->getGatewayConifgValue('templates/' . $this->getTemplatePath());
    }

    /**
     * Set template path
     *
     * @return $this
     */
    public function setTemplatePath($path)
    {
        $this->templatePath = $path;
        return $this;
    }

}
