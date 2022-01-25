<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Sms\Model;

/**
 * Interface for sms message.
 * @api
 * @since 100.0.2
 */
class Message implements MessageInterface
{

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var array
     */
    protected $data;

    /**
     * @inheritdoc
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber ;
    }

    /**
     * @inheritdoc
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @inheritdoc
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @inheritdoc
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }
}