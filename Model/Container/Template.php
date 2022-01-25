<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model\Container;

class Template
{
    /**
     * @var array
     */
    protected $vars;

    /**
     * @var string
     */
    protected $templateId;

    /**
     * @var int
     */
    protected $id;

    /**
     * Set sms template variables
     *
     * @param array $vars
     * @return void
     */
    public function setTemplateVars(array $vars)
    {
        $this->vars = $vars;
    }

    /**
     * Get sms template variables
     *
     * @return array
     */
    public function getTemplateVars()
    {
        return $this->vars;
    }

    /**
     * Set sms template id
     *
     * @param int $id
     * @return void
     */
    public function setTemplateId($id)
    {
        $this->id = $id;
    }

    /**
     * Get sms template id
     *
     * @return int
     */
    public function getTemplateId()
    {
        return $this->id;
    }
}
